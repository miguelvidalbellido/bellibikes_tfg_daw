from django.urls import path
from .views import UserView
from .views import UserAuthenticatedView

urlpatterns = [
    path('register', UserView.as_view({'post': 'register'})),
    path('login', UserView.as_view({'post': 'login'})),
    path('getUserData', UserAuthenticatedView.as_view({'get': 'getUserData'})),
    path('addPlan', UserAuthenticatedView.as_view({'post': 'addPlan'})),
    path('checkDataPlan', UserAuthenticatedView.as_view({'get': 'checkDataPlan'})),
]