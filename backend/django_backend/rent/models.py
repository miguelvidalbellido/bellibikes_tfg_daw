from django.db import models
from users.models import User
from stations.models import Bike
from stations.models import Station

# Create your models here.
class Rent(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    uuid_bike = models.ForeignKey(Bike, on_delete=models.SET_NULL, null=True, blank=True)
    uuid_user = models.ForeignKey(User, on_delete=models.SET_NULL, null=True, blank=True)
    uuid_station_origin = models.ForeignKey(Station, on_delete=models.SET_NULL, null=True, blank=True, related_name="origin_rents")
    uuid_station_destination = models.ForeignKey(Station, on_delete=models.SET_NULL, null=True, blank=True, related_name="destination_rents")
    status = models.CharField(max_length=100, null=False)
    datetime_start = models.DateTimeField(null=False)
    datetime_finish = models.DateTimeField(null=True, blank=True)
    latitude = models.DecimalField(max_digits=30, decimal_places=20, null=False)
    longitude = models.DecimalField(max_digits=30, decimal_places=20, null=False)