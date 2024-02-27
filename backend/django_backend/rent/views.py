from django.shortcuts import render
from rest_framework.decorators import api_view
from rest_framework.response import Response
from rest_framework import viewsets, status, views
from .serializers import RentSerializer
from rest_framework.exceptions import NotFound
from rest_framework.permissions import (AllowAny, IsAuthenticated)
from core.utils import check_all_fields
from core.permissions import IsAdmin
from .models import Rent
from stations.models import Bike
from stations.models import Station
from stations.models import Slot
from users.models import User
from users.models import Plan
import uuid
from django.utils import timezone
from core.utils import notifyChangesWebSocket
import os
import requests
from urllib.parse import urlencode
import json
from users.serializers import userSerializer



# Create your views here.
class RentView(viewsets.GenericViewSet):

    def getDataUserAndRents(self, request):
        permission_classes = [IsAuthenticated]
        
        token_username = request.user
        try:
            user = User.objects.get(username=token_username)
        except Exception as e:
            print(f"[ ADD - INCIDENT - USER ] Ocurrio un error: {e}")
            return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        try:
            rents = Rent.objects.filter(uuid_user=user.id).distinct()
        except Exception as e:
            print(f"[ ADD - INCIDENT - USER ] Ocurrio un error: {e}")
            return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        serializer_user = userSerializer.getUserData(context={'username': user.username})

        if not rents:
            return Response({"user": serializer_user, "rents": []}, status=status.HTTP_200_OK)

        serializer = RentSerializer(rents, many=True)

        return Response({"user": serializer_user, "rents": serializer.data}, status=status.HTTP_200_OK)

    def getDataRent(self, request, uuid_rent):
        # Obtenemos el rent
        try: 
            uuid_obj_rent = uuid.UUID(uuid_rent)
            rent = Rent.objects.get(uuid=uuid_obj_rent)
        except Exception as e:
            print(f"[RENT - GET] Ocurrio un error: {e}")
            return Response({"error": "RENT - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        # Obtenemos la bici
        try:
            bike = Bike.objects.get(uuid=rent.uuid_bike.uuid)
        except Exception as e:
            print(f"[RENT - GET] Ocurrio un error: {e}")
            return Response({"error": "RENT - GET BIKE"}, status=status.HTTP_404_NOT_FOUND)
        
        # Unimos los datos del rent y la bici y creamos una respuesta personalizada

        # Restamos la hora datetime_finish - datetime_start para obtener la duración del rent
        duration = rent.datetime_finish - rent.datetime_start
        duration_minutes = round(duration.total_seconds() / 60)

        # ...

        data = {
            "uuid_rent": rent.uuid,
            "uuid_bike": bike.uuid,
            "bike_model": bike.model,
            "bike_brand": bike.brand,
            "duration_rent": duration_minutes,
        }
        
        return Response(data, status=status.HTTP_200_OK)
            

    def checkBikeNotRented(self, request, uuid_bike):
        print("UUID BIKE: " + uuid_bike)
        try:
            uuid_obj_bike = uuid.UUID(uuid_bike)
            bike_exists = Bike.objects.filter(uuid=uuid_obj_bike).exists()
        except Exception as e:
            print(f"[RENT - CREATE] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE BIKE NOT FOUND"}, status=status.HTTP_404_NOT_FOUND)
        
        if (bike_exists == False):
            return Response({"err": f"Bike {uuid_bike} not found."}, status=status.HTTP_404_NOT_FOUND)

        try:
            uuid_obj_bike = uuid.UUID(uuid_bike)
            rent_already_exists = Rent.objects.filter(uuid_bike=uuid_obj_bike, status='RENTED').exists()
        except Exception as e:
            print(f"[RENT - CREATE] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE BIKE ALREADY IN RENT"}, status=status.HTTP_404_NOT_FOUND)

        if (rent_already_exists == True):
            return Response({"err": f"Bike {uuid_bike} already in rent."}, status=status.HTTP_404_NOT_FOUND)
        
        return Response({'available': True}, status=status.HTTP_200_OK)
    
    def getRents(self, request):
        rents = Rent.objects.all()
        serializer = RentSerializer(rents, many=True)
        return Response(serializer.data, status=status.HTTP_200_OK)

    def startRent(self, request):

        permission_classes = [IsAuthenticated]


        data = request.data['rent']
        required_fields = ['uuid_bike'] # 'uuid_user', 'latitude', 'longitude'
        check_all_fields(data, required_fields)

        try:
            username = request.user
            user = User.objects.get(username=username)
        except Exception as e:
            print(f"[RENT - CREATE - 0] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE USER NOT FOUND"}, status=status.HTTP_404_NOT_FOUND)

        # Comprueba que la bici existe

        try: 
            uuid_obj_bike = uuid.UUID(data['uuid_bike'])
            bike_exists = Bike.objects.filter(uuid=uuid_obj_bike).exists()
        except Exception as e:
            print(f"[RENT - CREATE - 1] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE BIKE NOT FOUND"}, status=status.HTTP_404_NOT_FOUND)
        
        if (bike_exists == False):
            return Response({"err": f"Bike {data['uuid_bike']} not found."})


        # Comprueba si la bici no esta en otro Rent con status active

        try:
            uuid_obj_rent = uuid.UUID(data['uuid_bike'])
            rent_already_exists = Rent.objects.filter(uuid_bike=uuid_obj_rent, status='active').exists()
        except Exception as e:
            print(f"[RENT - CREATE - 2] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE BIKE ALREADY IN USE"}, status=status.HTTP_404_NOT_FOUND)

        if (rent_already_exists == True):
            return Response({"err": f"Bike {data['uuid_bike']} already in use."})
        

        # Comprueba que en que slot esta la bici
        
        try:
            uuid_obj_bike = uuid.UUID(data['uuid_bike'])
            slot = Slot.objects.get(uuid_bike__uuid=uuid_obj_bike)
            station = slot.uuid_station
        except Exception as e:
            print(f"[RENT - CREATE - 3] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE SLOT NOT FOUND"}, status=status.HTTP_404_NOT_FOUND)
        
        # Comprueba que el usuario existe
        try:
            # uuid_obj_user = uuid.UUID(data['uuid_user'])
            user_exists = User.objects.filter(uuid=user.uuid).exists()
        except Exception as e:
            print(f"[RENT - CREATE - 4] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE USER NOT FOUND"}, status=status.HTTP_404_NOT_FOUND)
        
        if (user_exists == False):
            return Response({"err": f"User {user.uuid} not found."}, status=status.HTTP_404_NOT_FOUND)
        
        # Comprueba que el usuario no tenga un rent activo
        try:
            # uuid_obj_user = uuid.UUID(data['uuid_user'])
            rent_already_exists = Rent.objects.filter(uuid_user=user, status='active').exists()
        except Exception as e:
            print(f"[RENT - CREATE - 5] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE USER ALREADY IN USE"}, status=status.HTTP_404_NOT_FOUND)

        if (rent_already_exists == True):
            return Response({"err": f"User {user.uuid} already in use."}, status=status.HTTP_404_NOT_FOUND)
        
        # Obtiene la instancia del usuario
        try:
            uuid_obj_user = uuid.UUID(user.uuid)
            user_finally = User.objects.get(uuid=uuid_obj_user)
        except Exception as e:
            print(f"[RENT - CREATE - 6] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE USER NOT FOUND"}, status=status.HTTP_404_NOT_FOUND)
        


        bike_test = Bike.objects.get(uuid=uuid_obj_bike)
    
        serializer_context = {
            'uuid_bike': bike_test,
            'uuid_user': user_finally,
            'uuid_station_origin': station,
            'latitude': station.latitude,
            'longitude': station.longitude,
            'datetime_start': timezone.now(),
            'status': 'active'
        }

        serializer = RentSerializer.create(serializer_context)


        # if serializer.is_valid():
        #     # Si es válido, guarda el objeto Rent creado
        #     rent = serializer.save()

        #     # Devuelve los datos serializados y un estado HTTP 201_CREATED
        #     return Response(serializer.data, status=status.HTTP_201_CREATED)
        # else:
        #     # Si el serializador no es válido, devuelve los errores y un estado HTTP 400 Bad Request
        #     return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)


        # Actualiza el estado de la bici BIKE = RENTED

        try:
            uuid_obj_bike = uuid.UUID(data['uuid_bike'])
            bike = Bike.objects.get(uuid=uuid_obj_bike)
            bike.status = 'RENTED'
            bike.save()
            notifyChangesWebSocket('group_name', 'BIKE')
        except Exception as e:
            print(f"[RENT - CREATE - 4] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE CHANGE STATUS"}, status=status.HTTP_404_NOT_FOUND)
            
        # ELIMINA LA BICI DEL SLOT Y CAMBIA EL ESTADO DEL SLOT A FREE
        try:
            uuid_obj_bike = uuid.UUID(data['uuid_bike'])
            slot = Slot.objects.get(uuid_bike__uuid=uuid_obj_bike)
            slot.uuid_bike = None
            slot.status = 'FREE'
            slot.save()
            notifyChangesWebSocket('group_name', 'SLOT')
        except Exception as e:
            print(f"[RENT - CREATE - 5] Ocurrio un error: {e}")
            return Response({"error": "RENT - CREATE CHANGE SLOT STATUS"}, status=status.HTTP_404_NOT_FOUND)

        return Response(serializer, status=status.HTTP_201_CREATED)
    
    def testArduino(self, request, uuid):
        ## La información ira por url como uuid_bike 
        print("RFID recibido: " + uuid)
        return Response("RFID recibido: " + uuid, status=status.HTTP_200_OK)
    
    def endRent(self, request, rfid, uuid_slot):

        ## Obtener rfid asociado al uuid de la bike asociado en la bike
        try:
            bike = Bike.objects.get(rfid_tag=rfid)
        except Exception as e:
            print(f"[RENT - END - 1] Ocurrio un error: {e}")
            return Response({"error": "RENT - END BIKE NOT FOUND"}, status=status.HTTP_404_NOT_FOUND)

        ## Comprobar la bici esta en un rent activo
        try:
            #bike_obj_uuid = uuid.UUID(bike.uuid)
            rent = Rent.objects.get(uuid_bike=bike, status='active')
        except Exception as e:
            print(f"[RENT - END - 2] Ocurrio un error: {e}")
            return Response({"error": "RENT - END BIKE NOT IN RENT"}, status=status.HTTP_404_NOT_FOUND)
        
        if not rent:
            return Response({"err": f"Bike {rfid} tag not in rent."}, status=status.HTTP_404_NOT_FOUND)
        
        ## Comprobar que el slot esta libre
        try:
            slot_obj_slot = uuid.UUID(uuid_slot)
            slot = Slot.objects.get(uuid=slot_obj_slot, status='FREE')
        except Exception as e:
            print(f"[RENT - END - 3] Ocurrio un error: {e}")
            return Response({"error": "RENT - END SLOT NOT FREE"}, status=status.HTTP_404_NOT_FOUND)
        
        if not slot:
            return Response({"err": f"Slot {slot_obj_slot} not free."})
        
        
        ## Añadir el uuid_station_destination, status a FINISHED y datetime_finish
        try:
            rent = Rent.objects.get(uuid_bike=bike, status='active')
            rent.uuid_station_destination = slot.uuid_station
            rent.status = 'FINISHED'
            rent.datetime_finish = timezone.now()
            rent.save()
            notifyChangesWebSocket('group_name', 'RENT')
        except Exception as e:
            print(f"[RENT - END - 4] Ocurrio un error: {e}")
            return Response({"error": "RENT - END CHANGE RENT STATUS"}, status=status.HTTP_404_NOT_FOUND)
        
        ## Comprobar si tiene plan activo y el tiempo de duración del rent es menor que el tiempo restarte del plan
        try:
            plan = Plan.objects.get(uuid_user=rent.uuid_user, datetime_finish__gte=timezone.now())
        except Plan.DoesNotExist:
            plan = None

        ## Calculem la duració del rent de les dos feches 
        duration = rent.datetime_finish - rent.datetime_start
        duration_minutes = round(duration.total_seconds() / 60)

        if plan:
            # Si el tiempo restante del plan es mayor que la duración del rent
            if plan.available_time > duration_minutes:
                plan.available_time = plan.available_time - duration_minutes
                plan.save()
                duration_minutes = 0
            else:
                plan.available_time = 0
                duration_minutes = duration_minutes - plan.available_time
                plan.save()
        
        try:
            user = User.objects.get(uuid=rent.uuid_user.uuid)
        except User.DoesNotExist:
            raise NotFound('User not found')
        print(duration_minutes)
        if duration_minutes > 0:
            print("uoo")
            ## Petición a fastify_fs para comprobar si tiene última factura y si es valida
            try: 
                token = os.environ.get('CLAVE_API_FS')
                url = f"http://bellidel.eu:3005/factures/lastFactureClient/{user.id}"
                
                headers = {
                    'token': f'{token}',
                }
                
                response = requests.get(url, headers=headers)
                ## Falta pasar el token de la API de FS
                if response.status_code == 200:
                    dataCheckFactura = response.json()
                    print(dataCheckFactura)

                    if dataCheckFactura['isValid'] == False:
                        print("No tiene factura")

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
                            idFactura = facturaFS['data']['idfactura']
                            # print(response.json())
                        else:
                            print(f"Error al crear la factura. Código de estado: {response.status_code}")
                            raise NotFound('Error creating invoice')
                    
                    if dataCheckFactura['isValid'] == True:
                        print("Tiene factura")
                        idFactura = dataCheckFactura['lastFacture']['idfactura']

                if response.status_code == 404:
                    dataCheckFactura = None

                    print("No tiene factura")

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
                        idFactura = facturaFS['data']['idfactura']
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
                    'idfactura': idFactura,
                    'referencia': 'PAS-AS-YOU-GO',
                    'cantidad': duration_minutes,
                    'descripcion': f'Día: {rent.datetime_finish}',
                    'pvpunitario': 0.10
                }

                encoded_data = urlencode(data)
                response = requests.post(url, headers=headers, data=encoded_data)
                    
            except Exception as e:
                print(f"[RENT - FASTIFY ] Ocurrio un error: {e}")
                return Response({"error": "RENT - FASTIFY"}, status=status.HTTP_404_NOT_FOUND)
            


            print("sajdhaskjdh")
        ## Cambiar el status de la bici a NOT_RENTED

        try:
            bike.status = 'NOT_RENTED'
            bike.save()
            notifyChangesWebSocket('group_name', 'BIKE')
        except Exception as e:
            print(f"[RENT - END - 5] Ocurrio un error: {e}")
            return Response({"error": "RENT - END CHANGE BIKE STATUS"}, status=status.HTTP_404_NOT_FOUND)
        
        ## Cambiar el status del slot a OCCUPED
        try:
            slot.status = 'OCCUPED'
            slot.uuid_bike = bike
            slot.save()
            notifyChangesWebSocket('group_name', 'SLOT')
        except Exception as e:
            print(f"[RENT - END - 6] Ocurrio un error: {e}")
            return Response({"error": "RENT - END CHANGE SLOT STATUS"}, status=status.HTTP_404_NOT_FOUND)

        ## Enviar correo al usuario por post
        try:
            url = 'http://bellidel.eu:3010/api/send_mail'
            headers = {
                'Content-Type': 'application/json',
            }

            data = {
                "token": "asdadasdvs6eO1JYwXPvjIfu=cA9uKCJViUDwIzJmLffQWb!i-=DwBcywenAt?VR2CgRamVeIH=y5OJFO9E-I06!3?WFFj9S9AFQvX02gXsfOTI6jawIxcNVW!LqjDi5RfkJ8CRiYmR--??F3=1ZLzYeNPGHs/YArqJ-dInIrE4fv13o?bD0CYx54PK=?zn0C0-a?=wV9fUdmzJ2j8A/IOfjQj?aA44rBCp2H=GDkhKpnSUgqnUW51ITj19Wgb6f",
                "from": "admin@bellidel.eu",
                "to": "miguel.vidal.bell@gmail.com", 
                "subject": "prueba",
                "emailType": "detailsRent", 
                "emailData" : {
                    "name": f'{user.username}',
                    "date": f'{rent.datetime_start}',
                    "station_start": f'{rent.uuid_station_origin.name}',
                    "station_finish": f'{rent.uuid_station_destination.name}',
                }
            }

            data_json = json.dumps(data)
            response = requests.post(url, headers=headers, data=data_json)

            print(response.json())

        except Exception as e:
            print(f"[RENT - SEND MAIL ] Ocurrio un error: {e}")
            return Response({"error": "RENT - SEND MAIL"}, status=status.HTTP_404_NOT_FOUND)
        
        return Response({"msg": "Rent ended successfully."}, status=status.HTTP_200_OK)


    def test(self, request):
        token = os.environ.get('CLAVE_API_FS')
        url = f"http://bellidel.eu:3005/factures/lastFactureClient/20"
                
        headers = {
            'token': f'{token}',
        }
        
        response = requests.get(url, headers=headers)
        ## Falta pasar el token de la API de FS
        if response.status_code == 200:
            dataCheckFactura = response.json()
            print(dataCheckFactura)

            if dataCheckFactura['isValid'] == False:
                print("No tiene factura")

                # Creamos la factura para el usuario en FS
                url = os.environ.get('URL_FS')+ '/facturaclientes'
                headers = {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'token': token,
                }

                data = {
                    'codcliente': 20,
                    'cifnif': 20,
                    'nombrecliente': 'nano'
                }

                encoded_data = urlencode(data)
                response = requests.post(url, headers=headers, data=encoded_data)

                if response.status_code == 200:
                    print("Factura creada con éxito.")
                    facturaFS = response.json()
                    idFactura = facturaFS['data']['idfactura']
                    # print(response.json())
                else:
                    print(f"Error al crear la factura. Código de estado: {response.status_code}")
                    raise NotFound('Error creating invoice')
            
            if dataCheckFactura['isValid'] == True:
                print("Tiene factura")
                idFactura = dataCheckFactura['lastFacture']['idfactura']

        if response.status_code == 404:
            dataCheckFactura = None

            print("No tiene factura")

            # Creamos la factura para el usuario en FS
            url = os.environ.get('URL_FS')+ '/facturaclientes'
            headers = {
                'Content-Type': 'application/x-www-form-urlencoded',
                'token': token,
            }

            data = {
                'codcliente': 20,
                'cifnif': 20,
                'nombrecliente': 'nano'
            }

            encoded_data = urlencode(data)
            response = requests.post(url, headers=headers, data=encoded_data)

            if response.status_code == 200:
                print("Factura creada con éxito.")
                facturaFS = response.json()
                idFactura = facturaFS['data']['idfactura']
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
            'idfactura': idFactura,
            'referencia': 7,
            'cantidad': 100,
            'pvpunitario': 0.10
        }

        encoded_data = urlencode(data)
        response = requests.post(url, headers=headers, data=encoded_data)

        return Response("Test", status=status.HTTP_200_OK)