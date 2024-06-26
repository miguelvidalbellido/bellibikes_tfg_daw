from rest_framework import serializers, exceptions
from .models import User
from .models import Plan
from rest_framework import status
from rest_framework.exceptions import NotFound
from .models import AccountsDisabled

class userSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = ('id', 'uuid', 'username', 'email', 'password', 'type')

    def register(context):
        username = context['username']
        email = context['email']
        password = context['password']

        try:
            username_already_exists = User.objects.filter(username=username).exists()
            email_already_exists = User.objects.filter(email=email).exists()
        except Exception as e:
            print(f"Ocurrio un error: {e}")
        
        if (username_already_exists == True):
            raise NotFound('Already exists.')

        if (email_already_exists == True):
            raise serializers.ValidationError('Email already exists.')

        user = User.objects.create_user(
            username=username, 
            email=email, 
            password=password
        )

        return {
            'user': {
                'username': user.username,
                'email': user.email,
                'token': user.token
            }
        }
    
    def login(context):
        username = context['username']
        password = context['password']

        if username is None:
            raise NotFound('Username is required to login')
        
        if password is None:
            raise NotFound('Password is required to login')
        
        try:
            user = User.objects.get(username=username)
            # user.countTokens = 0
            user.save()
        except:
            raise serializers.ValidationError(
                'Username or password incorrects.'
            )
        
        if not user.check_password(password):
            raise serializers.ValidationError(
                'Username or password incorrects.'
            )
        
        return {
            'user': {
                'username': user.username,
                'email': user.email,
                'type': user.type
            },
            'token': user.token,
        }
    
    def loginMantenance(context):
        username = context['username']
        password = context['password']

        if username is None:
            raise NotFound('Username is required to login')
        
        if password is None:
            raise NotFound('Password is required to login')
        
        try:
            user = User.objects.get(username=username)
            # user.countTokens = 0
            user.save()
        except:
            raise serializers.ValidationError(
                'Username or password incorrects.'
            )
            
        
        if not user.check_password(password):
            raise serializers.ValidationError(
                'Username or password incorrects.'
            )
        
        if user.type != 'maint':
            raise serializers.ValidationError(
                'Username not type maintenance'
            )
        
        
        return {
            'user': {
                'username': user.username,
                'email': user.email,
                'type': user.type
            },
            'token': user.token,
        }
        
        
    def getUserData(context):
        username = context['username']

        try:
            user = User.objects.get(username=username)
        except:
            raise serializers.ValidationError('*User not found.')

        return {
            'user': {
                'id': user.id,
                'username': user.username,
                'email': user.email,
                'type': user.type
            },
            'token': user.token,
        }
    
    def getUserDataSinToken(context):
        username = context['username']

        try:
            user = User.objects.get(username=username)
        except:
            raise serializers.ValidationError('*User not found.')
        
        ## Busca si el usuario tiene un plan activo

        try:
            plan = Plan.objects.get(uuid_user=user.uuid)
        except:
            plan = None

        return {
            'user': {
                'id': user.id,
                'username': user.username,
                'email': user.email,
                'type': user.type
            },
        }
    
    def getUsersData(context):
        users = User.objects.all()
        users_list = []

        for user in users:
            is_disabled = True 

            try:
                account_disabled = AccountsDisabled.objects.get(uuid_user=user)
                is_disabled = account_disabled.active
            except AccountsDisabled.DoesNotExist:
                is_disabled = False

            users_list.append({
                'id': user.id,
                'username': user.username,
                'email': user.email,
                'type': user.type,
                'is_disabled': is_disabled
            })

        return {
            'users': users_list
        }
    
    def editUser(context):
        user = context['user']
        username = user['username']
        email = user['email']
        user_type = user['type']
        user_id = user['id']
        
        try:
            user = User.objects.get(id=user_id)
        except:
            raise serializers.ValidationError('User not found.')
        
        
        
        user.username = username
        user.email = email
        user.type = user_type
        
        return {
            'user': {
                'id': user.id,
                'username': user.username,
                'email': user.email,
                'type': user.type
            }
        }


class PlanSerializer(serializers.ModelSerializer):
    class Meta:
        model = Plan
        fields = ('productIdFs', 'description', 'uuid_user', 'available_time', 'datetime_start', 'datetime_finish')
    
    def to_representation(self,context):
        return {
            'plan': {
                'productIdFs': context.productIdFs,
                'description': context.description,
                'uuid_user': context.uuid_user.uuid,
                'available_time': context.available_time,
                'datetime_start': context.datetime_start,
                'datetime_finish': context.datetime_finish
            }
        }

    def create(context):
        description = context['description']
        uuid_user = context['uuid_user']
        available_time = context['available_time']
        datetime_start = context['datetime_start']
        datetime_finish = context['datetime_finish']
        idproduct = context['idproduct']

        plan = Plan.objects.create(
            description=description,
            uuid_user=uuid_user,
            available_time=available_time,
            datetime_start=datetime_start,
            productIdFs=idproduct,
            datetime_finish=datetime_finish
        )

        plan.save()

        return {
            'plan': {
                'productIdFs': plan.productIdFs,
                'description': plan.description,
                'uuid_user': plan.uuid_user.uuid,
                'available_time': plan.available_time,
                'datetime_start': plan.datetime_start,
                'datetime_finish': plan.datetime_finish
            }
        }

class AccountsDisabledSerializer(serializers.ModelSerializer):
    is_disabled = serializers.SerializerMethodField()

    class Meta:
        model = User
        fields = ['username', 'email', 'is_disabled'] 

    def get_is_disabled(self, user):
        try:
            account_disabled = AccountsDisabled.objects.get(uuid_user=user)
            return not account_disabled.active
        except AccountsDisabled.DoesNotExist:
            return False
