from rest_framework import serializers
from .models import Station
from .models import Bike
from .models import Slot
import uuid

class StationSerializer(serializers.ModelSerializer):
    class Meta:
        model = Station
        fields = '__all__'

    def to_representation(self, instance):
        return {
            "id": instance.id,
            "uuid": instance.uuid,
            "name": instance.name,
            "status": instance.status,
            "img": instance.img,
            "longitude": instance.longitude,
            "latitude": instance.latitude,
            "description": instance.description
        }

    def create(context):
        name = context['name']
        description = context['description']
        longitude = context['longitude']
        latitude = context['latitude']
        status = context['status']
        img = context['img']
        
        try:
            station_already_exists = Station.objects.filter(name=name).exists()
        except Exception as e:
            raise serializers.ValidationError({"err": f"Ocurrio un error: {e}"})
            print(f"[STATIONS - CREATE] Ocurrio un error: {e}")

        if (station_already_exists == True):
            raise serializers.ValidationError({"err": f"Station name {name} already exists."})
        
        station = Station.objects.create(
            name=name,
            description=description,
            longitude=longitude,
            latitude=latitude,
            status=status,
            img=img
        )
        station.save()

        return {
            'station': {
                'id': station.id,
                'name': station.name,
                'description': station.description,
                'longitude': station.longitude,
                'latitude': station.latitude,
                'status': station.status,
                'img': station.img
            }
        }

class BikeSerializer(serializers.ModelSerializer):

    class Meta:
        model = Bike
        fields = '__all__'
    
    def to_representation(self, instance):
        return {
            "id": instance.id,
            "uuid": instance.uuid,
            "sname": instance.sname,
            "status": instance.status,
            "model": instance.model,
            "brand": instance.brand,
            "batery": instance.batery,
            "lat": instance.lat,
            "lng": instance.lng,
            "rfid": instance.rfid_tag if instance.rfid_tag else None
        }

    def create(context):
        sname = context['sname']
        status = context['status']
        model = context['model']
        brand = context['brand']
        batery = context['batery']
        lat = context['lat']
        lng = context['lng']

        try:
            bike_already_exists = Bike.objects.filter(sname=sname).exists()
        except Exception as e:
            raise serializers.ValidationError({"err": f"Ocurrio un error: {e}"})
            print(f"[BIKES - CREATE] Ocurrio un error: {e}")

        if (bike_already_exists == True):
            raise serializers.ValidationError({"err": f"Bike sname {sname} already exists."})
        
        bike = Bike.objects.create(
            sname=sname,
            status=status,
            model=model,
            brand=brand,
            batery=batery,
            lat=lat,
            lng=lng
        )
        bike.save()

        return {
            'bike': {
                'id': bike.id,
                'sname': bike.sname,
                'status': bike.status,
                'model': bike.model,
                'brand': bike.brand,
                'batery': bike.batery,
                'lat': bike.lat,
                'lng': bike.lng
            }
        }
    
    def update(context):
        sname = context['sname']
        status = context['status']
        model = context['model']
        brand = context['brand']
        batery = context['batery']
        lat = context['lat']
        lng = context['lng']

        try:
            bike_already_exists = Bike.objects.filter(sname=sname).exists()
        except Exception as e:
            raise serializers.ValidationError({"err": f"Ocurrio un error: {e}"})
            print(f"[BIKES - UPDATE] Ocurrio un error: {e}")

        if (bike_already_exists == False):
            raise serializers.ValidationError({"err": f"Bike sname {sname} doesn't exists."})
        
        bike = Bike.objects.update(
            sname=sname,
            status=status,
            model=model,
            brand=brand,
            batery=batery,
            lat=lat,
            lng=lng
        )
        
        bike.save()

        return {
            'bike': {
                'id': bike.id,
                'sname': bike.sname,
                'status': bike.status,
                'model': bike.model,
                'brand': bike.brand,
                'batery': bike.batery,
                'lat': bike.lat,
                'lng': bike.lng,
                'rfid_tag': bike.rfid_tag if bike.rfid_tag else None
            }
        }


class SlotSerializer(serializers.ModelSerializer):

    class Meta:
        model = Slot
        fields = '__all__'
    
    def to_representation(self, instance):
        print("foseiubfiuesfbiu")
        print(instance.uuid_bike)
        return {
            "id": instance.id,
            "uuid": instance.uuid,
            "status": instance.status,
            "uuid_station": instance.uuid_station.uuid if instance.uuid_station else None,
            "station_name": Station.objects.get(uuid=instance.uuid_station.uuid).name if instance.uuid_station.uuid else None,
            "uuid_bike": instance.uuid_bike.uuid if instance.uuid_bike else None,
            "bike_sname": Bike.objects.get(uuid=instance.uuid_bike.uuid).sname if instance.uuid_bike else None,
        }
    
    def create(context):
        status = context['status']
        uuid_station = context['uuid_station']
        uuid_bike = context['uuid_bike']

        # Comprobamos que el UUID de station exista y se obtiene la instancia
        try:
            station = Station.objects.get(uuid=uuid_station)
        except Station.DoesNotExist:
            raise serializers.ValidationError({"err": f"Station with uuid {uuid_station} does not exist."})
        except Exception as e:
            raise serializers.ValidationError({"err": f"An error occurred: {e}"})
            print(f"[SLOTS - CREATE] An error occurred: {e}")

        # Si se proporciona uuid_bike, intenta obtener la instancia de Bike
        bike = None
        if uuid_bike:
            try:
                bike = Bike.objects.get(uuid=uuid_bike)
            except Bike.DoesNotExist:
                raise serializers.ValidationError({"err": f"Bike with uuid {uuid_bike} does not exist."})
            except Exception as e:
                raise serializers.ValidationError({"err": f"An error occurred: {e}"})
        
        # Comprobamos que la bici no este en mantenimiento

        if bike and bike.status == 'MANTENANCE':
            raise serializers.ValidationError({"err": f"Bike with uuid {uuid_bike} is in maintenance."})
        
        # Comprobamos que el uuid_bike no este ya asignado a otro slot
        if bike:
            try:
                uuid_obj_bike = uuid.UUID(uuid_bike)
                bike_instance = Bike.objects.get(uuid=uuid_obj_bike)
                slot_already_exists = Slot.objects.filter(uuid_bike=bike_instance).exists()

                if slot_already_exists:
                    raise serializers.ValidationError({"err": f"Bike with uuid {uuid_bike} is already assigned to a slot."})

            except Bike.DoesNotExist:
                raise serializers.ValidationError({"err": f"Bike with uuid {uuid_bike} does not exist."})
            except ValueError as e:
                raise serializers.ValidationError({"err": f"Invalid UUID: {e}"})
            except Exception as e:
                raise serializers.ValidationError({"err": f"An error occurred: {e}"})


        # Crear el Slot con la instancia de Station
        slot = Slot.objects.create(
            status=status,
            uuid_station=station, 
            uuid_bike=bike if bike else None
        )

        slot.save()

        return {
            'slot': {
                'id': slot.id,
                'status': slot.status,
                'uuid_station': slot.uuid_station.uuid,  
                'uuid_bike': slot.uuid_bike.uuid if slot.uuid_bike else None
            }
        }