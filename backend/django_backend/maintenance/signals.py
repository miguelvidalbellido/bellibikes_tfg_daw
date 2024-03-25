from django.db.models.signals import pre_save
from django.dispatch import receiver
from core.utils import generate_uuid
from .models import AssociatedScanner

@receiver(pre_save, sender=AssociatedScanner)

def add_uuid_if_not_set(sender, instance, *args, **kwargs):
    
    if instance and not instance.uuid:
        uuid = generate_uuid()
        instance.uuid = uuid