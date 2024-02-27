from django.urls import path
from .views import RentView


urlpatterns = [
    # URL para Stations
    path('end_rent/<str:rfid>/<str:uuid_slot>/', RentView.as_view({'get': 'endRent'})),
    path('start_rent', RentView.as_view({'post': 'startRent'})),
    path('get_rents', RentView.as_view({'get': 'getRents'})),
    path('checkAvailable/<str:uuid_bike>/', RentView.as_view({'get': 'checkBikeNotRented'})),
    path('test', RentView.as_view({'get': 'test'})),
    path('getDataRent/<str:uuid_rent>/', RentView.as_view({'get': 'getDataRent'})),
    path('dataProfile', RentView.as_view({'get': 'getDataUserAndRents'})),
]