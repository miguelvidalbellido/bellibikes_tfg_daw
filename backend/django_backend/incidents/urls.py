from django.urls import path
from .views import IncidentView
from .views import StagesIncidentView

urlpatterns = [
    path('incidents', IncidentView.as_view({'get': 'getData'})),
    path('incidents/su', IncidentView.as_view({'post': 'addIncident'})),
    path('incidents/<str:uuid>', IncidentView.as_view({
        'get': 'getIncident'
    })),
    path('stages', StagesIncidentView.as_view({'get': 'getData','post': 'addStage'})),
    path('stages/notifypending', StagesIncidentView.as_view({'get': 'getStagesForClient'})),
    path('stages/confirmview', StagesIncidentView.as_view({'put': 'updateUserConfirmation'})),
    path('stagesincident/<str:uuid>/', StagesIncidentView.as_view({'get': 'getStagesIncident'})),
]