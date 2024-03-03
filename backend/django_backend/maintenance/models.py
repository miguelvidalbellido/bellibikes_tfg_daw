from django.db import models

# Create your models here.

class AssociatedScanner(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    username = models.CharField(max_length=100)
    uuid_scanner = models.CharField(max_length=100)