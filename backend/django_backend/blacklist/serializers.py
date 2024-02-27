import jwt
from rest_framework import serializers
from .models import Blacklist
from users.models import User

from django.conf import settings
from rest_framework import authentication, exceptions


class blacklistSerializer(serializers.ModelSerializer):
    class Meta:
        model = Blacklist
        fields = ('token')

    def newBlackToken(context):
        token = context['token']

        payload = jwt.decode(token, settings.SECRET_KEY, algorithms=['HS256'])

        user = User.objects.get(username=payload['username'])
        user.countTokens = 0
        user.save()

        token_create = Blacklist.objects.create(
            token=token,
        )
        return {
            'token': token_create.token,
        }