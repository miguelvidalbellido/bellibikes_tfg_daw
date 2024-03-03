from django.shortcuts import render
from rest_framework import viewsets, status, views
from rest_framework.response import Response
from .models import AssociatedScanner
from rest_framework.permissions import (AllowAny, IsAuthenticated)
from core.utils import check_all_fields
from .serializers import AssociatedScannerSerializer
from users.models import User
from core.utils import notifyChangesWebSocket

class AssociatedScannerView(viewsets.ModelViewSet):
    
    def addScanner(self, request):

        permissions_classes = [IsAuthenticated]

        token_username = request.user
        data = request.data['scanner']
        required_fields = ['uuid_scanner']
        check_all_fields(data, required_fields)


        try:
            print(token_username)
            user = User.objects.get(username=token_username)
        except Exception as e:
            print(f"[ ADD - SCANNER - USER ] Ocurrio un error: {e}")
            return Response({"error": "ADD SCANNER - POST"}, status=status.HTTP_404_NOT_FOUND)
        
        ## Comprueba si el usuario ya tiene un scanner asociado
        try:
            scanner = AssociatedScanner.objects.get(username=user.username)
            return Response({"error": "USUARIO YA ASOCIADO"}, status=status.HTTP_400_BAD_REQUEST)
        except Exception as e:
            print(f"[ ADD - SCANNER - GET ] Ocurrio un error: {e}")

        try:
            scanner = AssociatedScanner.objects.get(uuid_scanner=data['uuid_scanner'])
            return Response({"error": "SCANNER YA ASOCIADO"}, status=status.HTTP_400_BAD_REQUEST)
        except Exception as e:
            print(f"[ ADD - SCANNER - GET ] Ocurrio un error: {e}")
        
        context = {
            "username": user.username,
            "uuid_scanner": data['uuid_scanner']
        }

        serializer = AssociatedScannerSerializer.create(context)
        
        return Response(serializer, status=status.HTTP_200_OK)
    
    def checkUserScanner(self, request):
        permissions_classes = [IsAuthenticated]

        token_username = request.user

        try:
            user = User.objects.get(username=token_username)
        except Exception as e:
            print(f"[ checkUserScanner - USER ] Ocurrio un error: {e}")
            return Response({"error": "checkUserScanner - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        ## Comprueba si el usuario ya tiene un scanner asociado
        try:
            scanner = AssociatedScanner.objects.get(username=user.username)
            return Response({"scanner": "true"}, status=status.HTTP_200_OK)
        except Exception as e:
            print(f"[ checkUserScanner - GET ] Ocurrio un error: {e}")

        return Response({"scanner": "false"}, status=status.HTTP_200_OK)

class ScannerView(viewsets.ModelViewSet):
    
    def rfidScanning(self, request, rfid, uuid_scanner):

        # Comprobamos si el uuid_scanner se encuentra en la tabla AssociatedScanner
        try:
            scanner = AssociatedScanner.objects.get(uuid_scanner=uuid_scanner)
        except Exception as e:
            print(f"[ RFID - SCANNER - GET ] Ocurrio un error: {e}")
            return Response({"error": "RFID SCANNER - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        if scanner is None:
            return Response({"error": "SCANNER NO ASOCIADO"}, status=status.HTTP_400_BAD_REQUEST)
        
        # Notificamos por WebSocket
        notifyChangesWebSocket('group_name', f'RFID_SCAN_{scanner.username}')

        return Response({"scanner": "true"}, status=status.HTTP_200_OK)