from rest_framework import serializers
from .models import Incident
from .models import StagesIncident
import uuid 
from users.models import User

class IncidentSerializer(serializers.ModelSerializer):
    class Meta:
        model = Incident
        fields = '__all__'

    def to_representation(self, instance):
        return {
            "id": instance.id,
            "uuid": instance.uuid,
            "uuid_user": instance.uuid_user.uuid,
            "date": instance.date,
            "incident_type": instance.incident_type,
            "uuid_type": instance.uuid_type,
            "description": instance.description,
            "status": instance.status
        }

    def create(self, context):
        uuid_user = context['uuid_user']
        date = context['date']
        incident_type = context['incident_type']
        uuid_type = context['uuid_type']
        description = context['description']
        status = context['status']
        
        incident = Incident.objects.create(
            uuid_user=uuid_user,
            date=date,
            incident_type=incident_type,
            uuid_type=uuid_type,
            description=description,
            status=status
        )
        incident.save()

        return {
            'incident': {
                'id': incident.id,
                'uuid_user': incident.uuid_user.uuid,
                'date': incident.date,
                'incident_type': incident.incident_type,
                'uuid_type': incident.uuid_type,
                'description': incident.description,
                'status': incident.status
            }
        }

class StagesIncidentSerializer(serializers.ModelSerializer):
    class Meta:
        model = StagesIncident
        fields = '__all__'

    def to_representation(self, instance):
        return {
            "id": instance.id,
            "uuid": instance.uuid,
            "uuid_incident": instance.uuid_incident.uuid if instance.uuid_incident.uuid else None,
            "date": instance.date,
            "status": instance.status,
            "comment": instance.comment,
            "user_confirmation": instance.user_confirmation
        }
    
    def create(self, context):
        uuid_incident = context['uuid_incident']
        date = context['date']
        status = context['status']
        comment = context['comment']
        user_confirmation = context['user_confirmation']
        
        stagesIncident = StagesIncident.objects.create(
            uuid_incident=uuid_incident,
            date=date,
            status=status,
            comment=comment,
            user_confirmation=user_confirmation
        )
        stagesIncident.save()

        return {
            'stages': {
                'id': stagesIncident.id,
                'uuid_incident': stagesIncident.uuid_incident.uuid,
                'date': stagesIncident.date,
                'comment': stagesIncident.comment,
                'comment': stagesIncident.comment,
                'status': stagesIncident.status
            }
        }