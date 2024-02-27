from django.urls import path
from .views import StationView
from .views import BikeView
from .views import StationViewAdmin
from .views import BikeViewAdmin
from .views import SlotView
from .views import SlotViewAdmin

urlpatterns = [
    # URL para Stations
    path('stations/', StationView.as_view({'get': 'getData'})),
    path('stations/su', StationViewAdmin.as_view({'post': 'addStation'})),
    path('stations/<str:uuid>', StationView.as_view({
        'get': 'getStation'
    })),
    path('stations/su/<str:uuid>', StationViewAdmin.as_view({
        'put': 'updateStation', 
        'delete': 'deleteStation'
    })),

    # URL para Bikes
    path('bikes/', BikeView.as_view({'get': 'getBikes'})),
    path('bikes/su', BikeViewAdmin.as_view({'post': 'addBike'})),
    path('bikes/<str:uuid>/', BikeView.as_view({
        'get': 'getBike',
    })),
    path('bikes/su/<str:uuid>', BikeViewAdmin.as_view({
        'put': 'updateBike',
        'delete': 'deleteBike',
    })),

    # URL para Slots
    path('slots/', SlotView.as_view({'get': 'getSlots'})),
    path('slots/su', SlotViewAdmin.as_view({'post': 'addSlot'})),
    path('slots/<str:uuid>', SlotView.as_view({
        'get': 'getSlot',
    })),
    path('slots/su/<str:uuid>', SlotViewAdmin.as_view({
        'put': 'updateSlot',
        'delete': 'deleteSlot',
    })),
    
]