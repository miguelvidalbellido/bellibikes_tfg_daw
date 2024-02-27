import json
from channels.generic.websocket import AsyncWebsocketConsumer

class NotifyChanges(AsyncWebsocketConsumer):
    async def connect(self):
        await self.channel_layer.group_add(
            "group_name",
            self.channel_name
        )
        await self.accept()

    async def disconnect(self, close_code):
        await self.channel_layer.group_discard(
            "group_name",
            self.channel_name
        )

    async def notify(self, event):
        message = event['message']

        # Enviar mensaje al WebSocket
        await self.send(text_data=json.dumps({
            'message': message
        }))