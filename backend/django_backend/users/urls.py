from django.urls import path
from .views import UserView
from .views import UserAuthenticatedView
from .views import UserAdminView

urlpatterns = [
    path('register', UserView.as_view({'post': 'register'})),
    path('login', UserView.as_view({'post': 'login'})),
    path('loginMaintenance', UserView.as_view({'post': 'loginMantenance'})),
    path('getUserData', UserAuthenticatedView.as_view({'get': 'getUserData'})),
    path('addPlan', UserAuthenticatedView.as_view({'post': 'addPlan'})),
    path('checkDataPlan', UserAuthenticatedView.as_view({'get': 'checkDataPlan'})),
    path('getAllUsers', UserAdminView.as_view({'get': 'getUsersData'})),
    path('editUser', UserAdminView.as_view({'post': 'editUser'})),
    path('notifyUserViaEmail', UserAdminView.as_view({'post': 'notifyUserViaEmail'})),
]