from django.shortcuts import render
from rest_framework.response import Response
from rest_framework.decorators import api_view
from rest_framework import viewsets, status, views
from .models import Station
from .models import Bike
from .models import Slot
from .serializers import StationSerializer
from .serializers import BikeSerializer
from .serializers import SlotSerializer
from rest_framework.exceptions import NotFound
from core.utils import check_all_fields
from core.permissions import IsAdmin

from core.utils import notifyChangesWebSocket

class StationView(viewsets.GenericViewSet):

    def getData(self, request):
        stations = Station.objects.all()
        serializer = StationSerializer(stations, many=True)
        return Response(serializer.data)

    def getStation(self, request, uuid):
        stations = Station.objects.get(uuid=uuid)
        serializer = StationSerializer(stations, many=False)
        return Response(serializer.data)

class StationViewAdmin(viewsets.GenericViewSet):

    permission_classes = [IsAdmin]
    def addStation(self, request):
        data = request.data['station']
    
        required_fields = ['name', 'description', 'longitude', 'latitude', 'status', 'img']
        
        check_all_fields(data, required_fields)

        serializer_context = {
            'name': data['name'],
            'description': data['description'],
            'longitude': data['longitude'],
            'latitude': data['latitude'],
            'status': data['status'],
            'img': data['img']
        }

        notifyChangesWebSocket('group_name', 'STATION')

        serializer = StationSerializer.create(serializer_context)

        return Response(serializer, status=status.HTTP_201_CREATED)

    def updateStation(self,request, uuid):
        station = Station.objects.get(uuid=uuid)
        print(station)
        data = request.data['station']

        required_fields = ['name', 'description', 'longitude', 'latitude', 'status', 'img']

        check_all_fields(data, required_fields)

        station.name = data['name']
        station.description = data['description']
        station.longitude = data['longitude']
        station.latitude = data['latitude']
        station.status = data['status']
        station.img = data['img']

        ## necesito comprobar que cumple con los requisitos del modelo

        station.save()

        serializer = StationSerializer(station, many=False)

        notifyChangesWebSocket('group_name', 'STATION')

        return Response(serializer.data)

    def deleteStation(self,request, uuid):
        station = Station.objects.get(uuid=uuid)
        station.delete()

        notifyChangesWebSocket('group_name', 'STATION')

        return Response({'message': 'Station deleted'}, status=status.HTTP_204_NO_CONTENT)

class BikeView(viewsets.GenericViewSet):

    def getBikes(self, request):
        bikes = Bike.objects.all()
        serializer = BikeSerializer(bikes, many=True)
        return Response(serializer.data)
    
    def getBike(self, request, uuid):
        bike = Bike.objects.get(uuid=uuid)
        serializer = BikeSerializer(bike, many=False)
        return Response(serializer.data)
    

class BikeViewAdmin(viewsets.GenericViewSet):
    permission_classes = [IsAdmin]
    def addBike(self, request):
        data = request.data['bike']

        required_fields = ['sname', 'status', 'model', 'brand', 'batery', 'lat', 'lng']
        
        check_all_fields(data, required_fields)

        rfid_tag = data.get('rfid_tag', None)

        serializer_context = {
            'sname': data['sname'],
            'status': data['status'],
            'model': data['model'],
            'brand': data['brand'],
            'batery': data['batery'],
            'lat': data['lat'],
            'lng': data['lng'],
            'rfid_tag': rfid_tag
        }

        serializer = BikeSerializer.create(serializer_context)

        notifyChangesWebSocket('group_name', 'BIKE')

        return Response(serializer, status=status.HTTP_201_CREATED)
    
    def updateBike(self, request, uuid):
        bike = Bike.objects.get(uuid=uuid)
        data = request.data['bike']

        required_fields = ['sname', 'status', 'model', 'brand', 'batery']
        
        check_all_fields(data, required_fields)

        bike.sname = data['sname']
        bike.status = data['status']
        bike.model = data['model']
        bike.brand = data['brand']
        bike.batery = data['batery']
        bike.lat = data.get('lat', None)
        bike.lng = data.get('lng', None)
        bike.rfid_tag = data.get('rfid', None)

        bike.save()

        serializer = BikeSerializer(bike, many=False)

        notifyChangesWebSocket('group_name', 'BIKE')
        print("ssssssssss")
        return Response(serializer.data)
    
    def deleteBike(self, request, uuid):
        bike = Bike.objects.get(uuid=uuid)
        bike.delete()

        notifyChangesWebSocket('group_name', 'BIKE')

        return Response('Bike deleted')

class SlotView(viewsets.GenericViewSet):
    
        def getSlots(self, request):
            slots = Slot.objects.all()
            serializer = SlotSerializer(slots, many=True)
            return Response(serializer.data)
    
        def getSlot(self, request, uuid):
            slot = Slot.objects.get(uuid=uuid)
            serializer = SlotSerializer(slot, many=False)
            return Response(serializer.data)
        

class SlotViewAdmin(viewsets.GenericViewSet):

    permission_classes = [IsAdmin]

    def addSlot(self, request):
        data = request.data['slot']

        required_fields = ['status', 'uuid_station']
            
        check_all_fields(data, required_fields)

        serializer_context = {
            'status': data['status'],
            'uuid_station': data['uuid_station']
        }

        # Establece 'uuid_bike' a None si no se proporcionó
        serializer_context['uuid_bike'] = data.get('uuid_bike', None)

        # Controlamos el estado del slot
        ## Comprobamos que el slot tiene el status MANTENANCE se lo dejamos

        if serializer_context['status'] != 'MANTENANCE':

            if serializer_context['uuid_bike'] is not None:
                serializer_context['status'] = 'OCCUPED'
            else:
                serializer_context['status'] = 'FREE'
        

        serializer = SlotSerializer.create(serializer_context)

        notifyChangesWebSocket('group_name', 'SLOT')

        return Response(serializer, status=status.HTTP_201_CREATED)

    def updateSlot(self, request, uuid):

        try:
            slot = Slot.objects.get(uuid=uuid)
        except Slot.DoesNotExist:
            return Response({"error": "Slot not found"}, status=status.HTTP_404_NOT_FOUND)

        data = request.data['slot']

        required_fields = ['status', 'uuid_station']
            
        check_all_fields(data, required_fields)

        slot.status = data['status']

        try:
            station = Station.objects.get(uuid=data['uuid_station'])
            slot.uuid_station = station
        except Station.DoesNotExist:
            return Response({"error": "Station not found"}, status=status.HTTP_404_NOT_FOUND)

        uuid_bike = data.get('uuid_bike')

        if uuid_bike:
            try:
                bike = Bike.objects.get(uuid=uuid_bike)
                slot.uuid_bike = bike
            except Bike.DoesNotExist:
                return Response({"error": "Bike not found"}, status=status.HTTP_404_NOT_FOUND)
        else:
            slot.uuid_bike = None
        
        # Controlamos el estado del slot
        ## Comprobamos que el slot tiene el status MANTENANCE se lo dejamos

        if slot.status != 'MANTENANCE':

            if slot.uuid_bike is not None:
                slot.status = 'OCCUPED'
            else:
                slot.status = 'FREE'

        ## Comprobar si cambia la bici que no este en otro slot

        if slot.uuid_bike:
            try:
                slot_bike = Slot.objects.get(uuid_bike=slot.uuid_bike)
                if slot_bike.uuid != slot.uuid:
                    return Response({"error": "Bike already in another slot"}, status=status.HTTP_400_BAD_REQUEST)
            except Slot.DoesNotExist:
                pass
            
        slot.save()

        notifyChangesWebSocket('group_name', 'SLOT')

        serializer = SlotSerializer(slot, many=False)
        return Response(serializer.data)

    def deleteSlot(self, request, uuid):
        slot = Slot.objects.get(uuid=uuid)
        slot.delete()

        notifyChangesWebSocket('group_name', 'SLOT')

        return Response('Slot deleted')