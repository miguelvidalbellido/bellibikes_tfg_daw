import random
import string
import secrets
from rest_framework.exceptions import NotFound
## WEBSOCKET
from channels.layers import get_channel_layer
from asgiref.sync import async_to_sync

DEFAULT_CHAR_STRING = string.ascii_lowercase + string.digits


def generate_random_string(chars=DEFAULT_CHAR_STRING, size=6):

    return ''.join(random.choice(chars) for _ in range(size))


def generate_uuid():

    part1 = secrets.token_hex(4)
    part2 = secrets.token_hex(2)
    part3 = secrets.token_hex(2)
    part4 = secrets.token_hex(2)
    part5 = secrets.token_hex(6)

    return part1 + "-" + part2 + "-" + part3 + "-" + part4 + "-" + part5

# Funcion global para comprobar que los campos requeridos estan en el request
def check_all_fields(fields, required_fields):
    for field in required_fields:
        if not fields.get(field):
            raise NotFound({"err": f"Field {field} is required"})

def notifyChangesWebSocket(group, msg):
## Enviamos el mensaje por websocket para avisar a los usuarios de los cambios de stations
    channel_layer = get_channel_layer()
    group_name = group
    message = {'type': 'notify', 'message': msg}

    # Enviar mensaje de forma sincrónica
    async_to_sync(channel_layer.group_send)(
        group_name,
        message
    )