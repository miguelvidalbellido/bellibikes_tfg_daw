from django.db import models
from users.models import User

# Create your models here.
class Incident(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    uuid_user = models.ForeignKey(User, on_delete=models.SET_NULL, null=True, blank=True)
    date = models.DateTimeField(null=False)
    incident_type = models.CharField(max_length=100, null=False)
    uuid_type = models.CharField(max_length=200, null=False)
    description = models.TextField(null=False)
    status = models.CharField(max_length=100, null=False)


class StagesIncident(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    uuid_incident = models.ForeignKey(Incident, on_delete=models.SET_NULL, null=True, blank=True)
    date = models.DateTimeField(null=False)
    status = models.CharField(max_length=100, null=False)
    comment = models.TextField(null=False)
    user_confirmation = models.BooleanField(null=False)