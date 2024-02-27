from django.shortcuts import render
from .models import Incident
from .serializers import IncidentSerializer
from .models import StagesIncident
from .serializers import StagesIncidentSerializer
from rest_framework.permissions import (IsAuthenticated)
from rest_framework import viewsets, status, views
from rest_framework.response import Response
from stations.models import Station
from core.utils import notifyChangesWebSocket
from core.utils import check_all_fields
import uuid
from django.utils import timezone
from users.models import User
from stations.models import Bike
from stations.models import Slot
from core.permissions import IsAdmin


class IncidentView(viewsets.GenericViewSet):

    def getData(self, request):
        incidents = Incident.objects.all()
        serializer = IncidentSerializer(incidents, many=True)
        return Response(serializer.data)

    def getIncident(self, request, uuid):
        incidents = Incident.objects.get(uuid=uuid)
        serializer = IncidentSerializer(incidents, many=False)
        return Response(serializer.data)

    def addIncident(self, request):

        permission_classes = [IsAuthenticated]

        token_username = request.user
        try:
            user = User.objects.get(username=token_username)
        except Exception as e:
            print(f"[ ADD - INCIDENT - USER ] Ocurrio un error: {e}")
            return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)

        data = request.data['incident']
        required_fields = ['uuid', 'description', 'type']
        check_all_fields(data, required_fields)

        ################################################
        ##               STATIONS
        ################################################
        if data['type'] == 'station':
            
            try: 
                uuid_obj_station = uuid.UUID(data['uuid'])
                station = Station.objects.get(uuid=uuid_obj_station)
            except Exception as e:
                print(f"[ ADD - INCIDENT - STATION ] Ocurrio un error: {e}")
                return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)

            station.status = 'MANTENANCE'
            station.save()

        ################################################
        ##               BIKES
        ################################################
        if data['type'] == 'bike':
            
            try: 
                uuid_obj_bike = uuid.UUID(data['uuid'])
                bike = Bike.objects.get(uuid=uuid_obj_bike)
            except Exception as e:
                print(f"[ ADD - INCIDENT - BIKE ] Ocurrio un error: {e}")
                return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)

            bike.status = 'MANTENANCE'
            bike.save()
        
        ################################################
        ##               SLOT
        ################################################
        if data['type'] == 'slot':
            
            try: 
                uuid_obj_bike = uuid.UUID(data['uuid'])
                bike = Bike.objects.get(uuid=uuid_obj_bike)
            except Exception as e:
                print(f"[ ADD - INCIDENT - BIKE ] Ocurrio un error: {e}")
                return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)
            
            try:
                slot = Slot.objects.get(uuid_bike_id=bike.id)
            except Exception as e:
                print(f"[ ADD - INCIDENT - SLOT ] Ocurrio un error: {e}")
                return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)

            slot.status = 'MANTENANCE'
            slot.save()

        serializer_context = {
            'uuid_user': user,
            'date': timezone.now(),
            'incident_type': data['type'],
            'uuid_type': data['uuid'],
            'description': data['description'],
            'status': 'NUEVA'
        }

        # notifyChangesWebSocket('group_name', 'INCIDENT')

        serializer = IncidentSerializer.create(IncidentSerializer(), serializer_context)

        ################################################
        ##               DEFAULT STAGE
        ################################################
        print(serializer)
        try:
            incident = Incident.objects.get(id=serializer['incident']['id'])
        except Exception as e:
            print(f"[ ADD - STAGEINCIDENT  ] Ocurrio un error: {e}")
            return Response({"error": "ADD STAGEINCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)

        serializer_stage_context = {
            'uuid_incident': incident,
            'date': timezone.now(),
            'status': 'NUEVA',
            'comment': 'Incidencia creada y notificada al administrador',
            'user_confirmation': False
        }

        serializer_stage_default = StagesIncidentSerializer.create(StagesIncidentSerializer(), serializer_stage_context)
        
        
        return Response(serializer, status=status.HTTP_201_CREATED)


class StagesIncidentView(viewsets.GenericViewSet):

    def getData(self, request):
        permission_classes = [IsAuthenticated]

        stagesIncident = StagesIncident.objects.all()
        serializer = StagesIncidentSerializer(stagesIncident, many=True)
        return Response(serializer.data)
    
    def getStagesIncident(self, request, uuid):
        permission_classes = [IsAdmin]

        if not uuid:
            return Response({"error": "UUID NOT FOUND - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        try:
            incident = Incident.objects.get(uuid=uuid)
            stages = StagesIncident.objects.filter(uuid_incident=incident.id).distinct()
        except Exception as e:
            print(f"[ GET - STAGES INCIDENT 2 - STAGES ] Ocurrio un error: {e}")
            return Response({"error": "OBTAINS STAGES - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        serializer = StagesIncidentSerializer(stages, many=True)

        return Response({"incidents": serializer.data}, status=status.HTTP_200_OK)

        

    def getStagesForClient(self, request):
        permission_classes = [IsAuthenticated]

        token_username = request.user

        ## COMPROBAMOS QUE EL USUARIO EXISTE
        try:
            user = User.objects.get(username=token_username)
        except Exception as e:
            print(f"[ ADD - INCIDENT - USER ] Ocurrio un error: {e}")
            return Response({"error": "ADD INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        ## OBTENEMOS LAS INCIDENCIAS DEL USUARIO SI TIENE 
        try:
            incidents = Incident.objects.filter(uuid_user=user.id)
        except Exception as e:
            print(f"[ GET - STAGES INCIDENT 1 - USER ] Ocurrio un error: {e}")
            return Response({"error": "OBTAINS INCIDENT - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        if not incidents:
            return Response({"incidents": []}, status=status.HTTP_200_OK)

        ## OBTENEMOS LOS STAGES DE LAS INCIDENCIAS
        try:
            incident_ids = incidents.values_list('id', flat=True)
            stages = StagesIncident.objects.filter(uuid_incident__in=incident_ids,user_confirmation=False).distinct()
        except Exception as e:
            print(f"[ GET - STAGES INCIDENT 2 - STAGES ] Ocurrio un error: {e}")
            return Response({"error": "OBTAINS STAGES - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        
        serializer = StagesIncidentSerializer(stages, many=True)

        return Response({"incidents": serializer.data}, status=status.HTTP_200_OK)
    
    def addStage(self, request):
        permission_classes = [IsAdmin]

        data = request.data['incident']
        required_fields = ['uuid_incident', 'status', 'comment']
        check_all_fields(data, required_fields)

        if data['status'] not in ['ASIGNADA', 'EN PROCESO', 'EN ESPERA DE PIEZAS', 'RESUELTA']:
            return Response({"error": "STATUS NO VALIDO - POST"}, status=status.HTTP_404_NOT_FOUND)

        ## Buscamos la incidencia para comprobar si existe
        try:
            incident = Incident.objects.get(uuid=data['uuid_incident'])
        except Exception as e:
            print(f"[ ADD - STAGEINCIDENT ] Ocurrio un error: {e}")
            return Response({"error": "ADD - STAGEINCIDENT - POST"}, status=status.HTTP_404_NOT_FOUND)

        if not incident:
            return Response({"error": "LA INCIDENCIA NO EXISTE - POST"}, status=status.HTTP_404_NOT_FOUND)

        ## Creamos el stage
        serializer_stage_context = {
            'uuid_incident': incident,
            'date': timezone.now(),
            'status': data['status'],
            'comment': data['comment'],
            'user_confirmation': False
        }

        serializer = StagesIncidentSerializer.create(StagesIncidentSerializer(), serializer_stage_context)

        ## Cambiamos el status a la incidencia
        
        incident.status = data['status']
        incident.save()
        
        
        return Response(serializer, status=status.HTTP_201_CREATED)


    def updateUserConfirmation(self, request):
        permission_classes = [IsAuthenticated]

        token_username = request.user
        try:
            user = User.objects.get(username=token_username)
        except Exception as e:
            print(f"[ UPDATE - CHECK - USER ] Ocurrio un error: {e}")
            return Response({"error": "UPDATE STAGE CHECK - GET"}, status=status.HTTP_404_NOT_FOUND)

        data = request.data['stageincident']
        required_fields = ['uuid']
        check_all_fields(data, required_fields)

        ## Comprobamos que el stage de la incidencia pertenece al usuario del token

        try:
            stageIncident = StagesIncident.objects.get(uuid=data['uuid'])
        except Exception as e:
            print(f"[ UPDATE - CHECK - USER ] Ocurrio un error: {e}")
            return Response({"error": "INCIDENT ERROR - GET"}, status=status.HTTP_404_NOT_FOUND)

        if not stageIncident:
            return Response({"error": "stageIncident NOT FOUND - GET"}, status=status.HTTP_404_NOT_FOUND)

        ## Modificamos el campo boolean a visto 
        try:
            stageIncident.user_confirmation = True
            stageIncident.save()
        except:
            print(f"[ UPDATE - CHECK - USER ] Ocurrio un error: {e}")
            return Response({"error": "INCIDENT ERROR - GET"}, status=status.HTTP_404_NOT_FOUND)
        
        return Response({'update': 'ok'}, status=status.HTTP_200_OK)

    
