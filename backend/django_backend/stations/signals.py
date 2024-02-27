from django.db.models.signals import pre_save
from django.dispatch import receiver
from .models import Station
from core.utils import generate_uuid
from .models import Bike
from .models import Slot

@receiver(pre_save, sender=Station)
@receiver(pre_save, sender=Bike)
@receiver(pre_save, sender=Slot)

def add_uuid_if_not_set(sender, instance, *args, **kwargs):

    if instance and not instance.uuid:
        uuid = generate_uuid()
        instance.uuid = uuid
