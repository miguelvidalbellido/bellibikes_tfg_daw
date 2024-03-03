from django.urls import path
from .views import AssociatedScannerView
from .views import ScannerView
urlpatterns = [
    path('associatedScanner', AssociatedScannerView.as_view({'post': 'addScanner', 'get': 'checkUserScanner'})),
    path('scanner/<str:rfid>/<str:uuid_scanner>/', ScannerView.as_view({'get': 'rfidScanning'})),
]