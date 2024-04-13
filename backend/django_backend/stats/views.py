from django.shortcuts import render
from rest_framework import viewsets, status, views
from rest_framework.response import Response
from stations.models import Station
from stations.serializers import StationSerializer
from rent.models import Rent
from rent.serializers import RentSerializer
from users.models import User
from users.serializers import userSerializer
from stations.models import Slot
from stations.serializers import SlotSerializer
from stations.models import Bike
from stations.serializers import BikeSerializer
from django.db.models import Count
from core.permissions import IsAdmin
from core.permissions import IsMaintenance
from incidents.models import Incident
from incidents.serializers import IncidentSerializer

from django.db.models.functions import TruncDay
from django.db.models import Count
from datetime import timedelta, datetime
from django.utils.timezone import make_aware

# Create your views here.
class StatsView(viewsets.GenericViewSet):

    permission_classes = [IsAdmin]

    def dashboardHome(self, request):
        try:
            totalRent = Rent.objects.all().count()
        except:
            totalRent = 0

        try:
            totalSlots = Station.objects.exclude(status='MANTENANCE').count()
        except:
            totalSlots = 0

        try:
            totalUsers = User.objects.all().count()
        except:
            totalUsers = 0

        try:
            totalStations = Station.objects.filter(status='OPEN').count()
        except:
            totalStations = 0
        
        return Response({
            "totalRent": totalRent,
            "totalSlots": totalSlots,
            "totalUsers": totalUsers,
            "totalStations": totalStations
        }, status=status.HTTP_200_OK)

    def stations(self, request):
        
        permission_classes = [IsAdmin]

        try:
            stations = Station.objects.all().count()
        except:
            stations = 0

        try:
            stationsOpen = Station.objects.filter(status='OPEN').count()
        except:
            stationsOpen = 0

        try:
            stationsMaintenance = Station.objects.filter(status='MANTENANCE').count()
        except:
            stationsMaintenance = 0

        try:
            stationsClose = Station.objects.filter(status='CLOSE').count()
        except:
            stationsEmpty = 0

        return Response({
            "stations": stations,
            "stationsOpen": stationsOpen,
            "stationsMaintenance": stationsMaintenance,
            "stationsClose": stationsClose
        }, status=status.HTTP_200_OK)
    
    def slots(self, request):
        
        permission_classes = [IsAdmin]

        total_slots = Slot.objects.count()
        free_slots = Slot.objects.filter(status='FREE').count()
        occupied_slots = Slot.objects.filter(status='OCCUPED').count()
        maintenance_slots = Slot.objects.filter(status='MANTENANCE').count()
        
        return Response({
            "total_slots": total_slots,
            "free_slots": free_slots,
            "occupied_slots": occupied_slots,
            "maintenance_slots": maintenance_slots
        }, status=status.HTTP_200_OK)
    
    def bikes(self, request):

        permission_classes = [IsAdmin]
        
        total_bikes = Bike.objects.count()
        free_bikes = Bike.objects.filter(status='NOT_RENTED').count()
        occupied_bikes = Bike.objects.filter(status='RENTED').count()
        maintenance_bikes = Bike.objects.filter(status='MANTENANCE').count()
        
        return Response({
            "total_bikes": total_bikes,
            "free_bikes": free_bikes,
            "occupied_bikes": occupied_bikes,
            "maintenance_bikes": maintenance_bikes
        }, status=status.HTTP_200_OK)
    
    def statsMaintenancePanel(self, request):
         
        permission_classes = [IsMaintenance]

        stats_last_week = Incident.objects.filter(date__gte='2021-10-01').extra({'date': "date(date)"}).values('date').annotate(count=Count('uuid'))
        # stats_last_week = Incident.objects.extra({'date': "date(date)"}).values('date').annotate(count=Count('uuid')).order_by('-date')[:7]

        for i in range(7):
            if not any(d['date'] == '2021-10-0'+str(i+1) for d in stats_last_week):
                stats_last_week = list(stats_last_week)
                stats_last_week.append({'date': '2021-10-0'+str(i+1), 'count': 0})
                stats_last_week = tuple(stats_last_week)
        

        return Response({
            "stats_last_week": stats_last_week
        }, status=status.HTTP_200_OK)


        