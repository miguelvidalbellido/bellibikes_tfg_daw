from django.shortcuts import render
from rest_framework.decorators import api_view
from rest_framework.response import Response
from rest_framework import viewsets, status, views
from .serializers import userSerializer
from .serializers import PlanSerializer
from rest_framework.exceptions import NotFound
from rest_framework.permissions import (AllowAny, IsAuthenticated)
from core.utils import check_all_fields
from .models import User
from .models import Plan
import os
import requests
from urllib.parse import urlencode
from django.utils import timezone
from django.core import serializers
# Create your views here.

class UserView(viewsets.GenericViewSet):
    #permissions_classes = [AllowAny]

    def register(self, request):
        
        if 'user' not in request.data:
            raise NotFound('User field is required')

        data = request.data['user']

        required_fields = ['username', 'password', 'email']

        check_all_fields(data, required_fields)
    
        serializer_context = {
            'username': data['username'],
            'password': data['password'],
            'email': data['email']
        }

        serializer = userSerializer.register(serializer_context)

        # Damos de alta al usuario en FacturaScripts
        token = os.environ.get('CLAVE_API_FS')
        url = os.environ.get('URL_FS')+ '/clientes'
        test1 = os.environ.get('PG_USER')
        test2 = os.environ.get('PG_PASSWORD')
        print(url)
        print(token)
        print(test1)
        print(test2)
        headers = {
            'Content-Type': 'application/x-www-form-urlencoded',
            'token': token,
        }

        try:
            user = User.objects.get(username=data['username'])
            print(user.uuid)
        except User.DoesNotExist:
            print('Usuario no encontrado')
            user = None

        data = {
            'codcliente': user.id,
            'cifnif': user.id,
            'nombre': user.username,
            'email': user.email,
            'observaciones': f"Cliente creado desde la aplicación web de OntiBike Username: {user.username}"
        }

        encoded_data = urlencode(data)
        response = requests.post(url, headers=headers, data=encoded_data)
        if response.status_code == 200:
            print("Cliente registrado con éxito.")
        else:
            print(f"Error al registrar el cliente. Código de estado: {response.status_code}")

        return Response(serializer, status=status.HTTP_201_CREATED)     

    def login(self, request):

        if 'user' not in request.data:
            raise NotFound('User field is required')
        
        data = request.data['user']

        required_fields = ['username', 'password']

        check_all_fields(data, required_fields)
        
        serializer_context = {
            'username': data['username'],
            'password': data['password']
        }

        serializer = userSerializer.login(serializer_context)
        return Response(serializer, status=status.HTTP_200_OK)

class UserAuthenticatedView(viewsets.GenericViewSet):
    
    permission_classes = [IsAuthenticated]

    def getUserData(self, request):
        username = request.user
        serializer_context = {
            'username': username
        }
        print(username)
        serializer = userSerializer.getUserData(context=serializer_context)
        return Response(serializer, status=status.HTTP_200_OK)
    
    def checkDataPlan(self, request):
        username = request.user

        # Comprobamos si el usuario existe en la base de datos
        try:
            user = User.objects.get(username=username)
        except User.DoesNotExist:
            raise NotFound('User not found')
    
        # Comprobamos si tiene plan activo
        try:
            plan = Plan.objects.get(uuid_user=user, datetime_finish__gte=timezone.now())
        except Plan.DoesNotExist:
            plan = None
        
        if plan:
            ## serializa plan
            serializer_obj = serializers.serialize('json', [plan,])
            ## Necesito obtener el fields en json para poder devolverlo
            return Response(serializer_obj, status=status.HTTP_200_OK)
        else:
            return Response('No plan', status=status.HTTP_204_NO_CONTENT)
    
    def addPlan(self, request):
        username = request.user
        data = request.data['plan']
        print(data)
        # Comprobamos que el usuario existe en la base de datos
        try:
            user = User.objects.get(username=username)
        except User.DoesNotExist:
            raise NotFound('User not found')
        
        # Comprobamos que el usuario no tenga un producto activo
        try:
            plan = Plan.objects.get(uuid_user=user, datetime_finish__gte=timezone.now())
        except Plan.DoesNotExist:
            plan = None
        
        if plan:
            raise NotFound('User already has an active plan')
        
        # Comprobamos que el producto exista en FS y obtenemos los datos
        token = os.environ.get('CLAVE_API_FS')
        url = os.environ.get('URL_FS')+ '/productos' + f'/{data["idproducto"]}'
        headers = {
            'Content-Type': 'application/x-www-form-urlencoded',
            'token': token,
        }

        response = requests.get(url, headers=headers)

        if response.status_code == 200:
            print("Producto encontrado")
            productFS = response.json()
            # print(response.json())
        else:
            print(f"Error al buscar el producto. Código de estado: {response.status_code}")
            raise NotFound('Product not found')
        print("Holaaa")
        print(user)
        # Creamos el plan en la base de datos
        planContext = {
            'uuid_user':user,
            'idproduct':productFS['idproducto'],
            'description':productFS['descripcion'],
            'available_time':productFS['codfamilia'], 
            'datetime_start':timezone.now(),
            'datetime_finish':timezone.now() + timezone.timedelta(days=30)
        }

        serializer = PlanSerializer.create(planContext)

        # Creamos la factura para el usuario en FS
        url = os.environ.get('URL_FS')+ '/facturaclientes'
        headers = {
            'Content-Type': 'application/x-www-form-urlencoded',
            'token': token,
        }

        data = {
            'codcliente': user.id,
            'cifnif': user.id,
            'nombrecliente': user.username
        }

        encoded_data = urlencode(data)
        response = requests.post(url, headers=headers, data=encoded_data)

        if response.status_code == 200:
            print("Factura creada con éxito.")
            facturaFS = response.json()
            # print(response.json())
        else:
            print(f"Error al crear la factura. Código de estado: {response.status_code}")
            raise NotFound('Error creating invoice')

        # Creamos la línea de factura para el usuario en FS
        url = os.environ.get('URL_FS')+ '/lineafacturaclientes'
        headers = {
            'Content-Type': 'application/x-www-form-urlencoded',
            'token': token,
        }

        data = {
            'idfactura': facturaFS['data']['idfactura'],
            'referencia': productFS['referencia'],
            'cantidad': 1,
            'pvpunitario': productFS['precio']
        }

        encoded_data = urlencode(data)
        response = requests.post(url, headers=headers, data=encoded_data)

        # Creamos el Plan en django
        return Response(serializer, status=status.HTTP_201_CREATED)
