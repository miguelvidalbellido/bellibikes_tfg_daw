from django.db import models
from django.contrib.auth.models import (AbstractBaseUser, BaseUserManager, PermissionsMixin)
from django.conf import settings
from datetime import datetime, timedelta
import jwt

# Create your models here.
class UserManager(BaseUserManager):
    def create_user(self, username, email, password):
        user = self.model(email=self.normalize_email(email), username=username)
        user.set_password(password)
        user.save()
        return user


class User(AbstractBaseUser, PermissionsMixin):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    username = models.CharField('username', max_length=30, unique=True, null=False)
    email = models.EmailField('email', unique=True)
    type = models.CharField('type', max_length=10, null=False, default='client')

    # countTokens = models.IntegerField(default=0)

    USERNAME_FIELD = 'username'
    REQUIRED_FIELDS = ['email']

    objects = UserManager()

    @property
    def token(self):
        return self.generate_token_jwt()
    
    def generate_token_jwt(self):
        dt = datetime.now() + timedelta(minutes=settings.JWT_EXP_TIME)

        token = jwt.encode({
            'username': self.username,
            'exp': int(dt.strftime('%s'))
        }, settings.SECRET_KEY, algorithm='HS256')

        return token


class Plan(models.Model):
    uuid = models.CharField('uuid', max_length=36, unique=True, editable=False, null=False)
    productIdFs = models.IntegerField('productIdFs')
    description = models.CharField('description', max_length=3000, unique=True, null=False)
    uuid_user = models.ForeignKey(User, on_delete=models.SET_NULL, null=True, blank=True)
    available_time = models.IntegerField('available_time')
    datetime_start = models.DateField(null=False)
    datetime_finish = models.DateField(null=False)
