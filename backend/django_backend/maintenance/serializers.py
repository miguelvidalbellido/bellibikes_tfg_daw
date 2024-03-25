from rest_framework import serializers
import uuid
from .models import AssociatedScanner

class AssociatedScannerSerializer(serializers.ModelSerializer):
    class Meta:
        model = AssociatedScanner
        fields = '__all__'
    
    def to_representation(self, instance):
        return {
            "uuid": instance.uuid,
            "username": instance.username,
            "uuid_scanner": instance.uuid_scanner
        }

    def create(context):
        username = context['username']
        uuid_scanner = context['uuid_scanner']

        associated_scanner = AssociatedScanner.objects.create(
            username=username,
            uuid_scanner=uuid_scanner
        )

        associated_scanner.save()

        return {
            "uuid": associated_scanner.uuid,
            "username": associated_scanner.username,
            "uuid_scanner": associated_scanner.uuid_scanner
        }