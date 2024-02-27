from django.db.models.signals import pre_save
from django.dispatch import receiver
from .models import Rent
from core.utils import generate_uuid

@receiver(pre_save, sender=Rent)

def add_uuid_if_not_set(sender, instance, *args, **kwargs):

    if instance and not instance.uuid:
        uuid = generate_uuid()
        instance.uuid = uuid
