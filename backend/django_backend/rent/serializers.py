from rest_framework import serializers
import uuid
from .models import Rent
from stations.models import Bike

class RentSerializer(serializers.ModelSerializer):
    class Meta:
        model = Rent
        fields = '__all__'

    def to_representation(self, instance):
        return {
            "uuid": instance.uuid,
            "uuid_bike": instance.uuid_bike.uuid,
            "uuid_user": instance.uuid_user.uuid,
            "uuid_station_origin": instance.uuid_station_origin.uuid,
            "uuid_station_destination": instance.uuid_station_destination.uuid if instance.uuid_station_destination else None,
            "status": instance.status,
            "datetime_start": instance.datetime_start,
            "datetime_finish": instance.datetime_finish if instance.datetime_finish else None,
            "latitude": instance.latitude,
            "longitude": instance.longitude
        }

    def create(context):
        print(context)
        uuid_bike = context['uuid_bike']
        uuid_user = context['uuid_user']
        uuid_station_origin = context['uuid_station_origin']
        latitude = context['latitude']
        longitude = context['longitude']
        datetime_start = context['datetime_start']
        status = context['status']

        if Rent.objects.filter(uuid_bike=uuid_bike, status='active').exists():
            raise serializers.ValidationError({"err": f"Bike already in use."})

        # try:
        #     uuid_obj_bike = uuid.UUID(uuid_bike)
        #     rent_already_exists = Rent.objects.filter(uuid_bike=uuid_bike, status='active').exists()
        # except Exception as e:
        #     print(f"[RENT - CREATE] Ocurrio un error: {e}")
        #     raise serializers.ValidationError({"err": f"Ocurrio un error: {e}"})

        # if (rent_already_exists == True):
        #     raise serializers.ValidationError({"err": f"Bike {uuid_bike} already in use."})
        
        rent = Rent.objects.create(
            uuid_bike=uuid_bike,
            uuid_user=uuid_user,
            uuid_station_origin=uuid_station_origin,
            latitude=latitude,
            longitude=longitude,
            datetime_start=datetime_start,
            status=status
        )

        rent.save()

        print(rent)

        return {
            'rent': {
                'uuid': rent.uuid,
                'uuid_bike': rent.uuid_bike.uuid,
                'uuid_user': rent.uuid_user.uuid,
                'uuid_station_origin': rent.uuid_station_origin.uuid,
                'uuid_station_destination': rent.uuid_station_destination.uuid if rent.uuid_station_destination else None,
                'status': rent.status,
                'datetime_start': rent.datetime_start,
                'datetime_finish': rent.datetime_finish if rent.datetime_finish else None,
                'latitude': rent.latitude,
                'longitude': rent.longitude
            }
        }