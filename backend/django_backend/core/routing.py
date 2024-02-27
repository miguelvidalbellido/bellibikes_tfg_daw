from django.urls import re_path
from core.consumers import NotifyChanges

websocket_urlpatterns = [
    re_path(r'ws/changes/', NotifyChanges.as_asgi()),
]