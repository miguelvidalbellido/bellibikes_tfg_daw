from django.db import models

# Create your models here.
class Station(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    name = models.CharField(max_length=100)
    latitude = models.DecimalField(max_digits=30, decimal_places=20, null=False)
    longitude = models.DecimalField(max_digits=30, decimal_places=20, null=False)
    status = models.CharField(max_length=100)
    description = models.CharField(max_length=200)
    img = models.CharField(max_length=201)

class Bike(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    sname = models.CharField(max_length=100)
    status = models.CharField(max_length=100)
    model = models.CharField(max_length=100)
    brand = models.CharField(max_length=100)
    batery = models.CharField(max_length=100)
    lat = models.DecimalField(max_digits=30, decimal_places=20, null=False)
    lng = models.DecimalField(max_digits=30, decimal_places=20, null=False)
    rfid_tag = models.CharField(max_length=100, null=True, blank=True)

class Slot(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    status = models.CharField(max_length=100)
    uuid_station = models.ForeignKey(Station, on_delete=models.CASCADE)
    uuid_bike = models.ForeignKey(Bike, on_delete=models.SET_NULL, null=True, blank=True)