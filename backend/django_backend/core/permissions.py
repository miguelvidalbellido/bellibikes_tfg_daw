from rest_framework import permissions
from users.models import User

class IsAdmin(permissions.BasePermission):
    messagge = 'You must be an admin to perform this action.'
    def has_permission(self, request, view):
        try:
            user = User.objects.get(username=request.user)
            return user.type == 'admin'
        except:
            return False