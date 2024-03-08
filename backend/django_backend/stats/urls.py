from django.urls import path
from django.urls import path
from .views import StatsView


urlpatterns = [

    path('dashboardHome', StatsView.as_view({'get': 'dashboardHome'})),
    path('dashboardStations', StatsView.as_view({'get': 'stations'}) ),
    path('dashboardSlots', StatsView.as_view({'get': 'slots'}) ),
    path('dashboardBikes', StatsView.as_view({'get': 'bikes'}) ),
    path('dashboardManteinance', StatsView.as_view({'get': 'statsMaintenancePanel'}) ),
]