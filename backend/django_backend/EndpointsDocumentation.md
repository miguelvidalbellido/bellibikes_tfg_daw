# Documentación Endpoints Django

Este archivo maestro contiene todos los Endpoints de nuestro backend.

# Websocket
## Endpoint Websocket: `ws://bellidel.eu:8090/ws/changes`

### Método: WS

**Descripción:** Esta pendiente de los cambios que se realizan para cambiar el cliente

**Parámetros:** 
- Ninguno

**Resultado:**
- Respuesta JSON:
    ```json
    {
        "message": "mensaje"
    }

# Stations
## Endpoint Create Stations: `http://bellidel.eu:8090/stations/su`

### Método: POST

**Descripción:** Crear estación (requiere ser administrador)

**Parámetros:** 
- Bearer Token
- Contenido Body
    ```json
    {
        "station": {
            "name": "",
            "description": "",
            "longitude": ,
            "latitude": ,
            "status": "",
            "img": ""
        }
    }

**Resultado:**
- Código de estado: 201 OK
- Respuesta JSON:
    ```json
    {
        "station": {
            "name": "",
            "description": "",
            "longitude": ,
            "latitude": ,
            "status": "",
            "img": ""
        }
    }



# PLANTILLA

# Modulo
## Nombre endpoint: 'DIRECCIÓN'

### Método: POST/PUT/GET/DELETE

**Descripción:** 

**Parámetros:** 
- 

**Resultado:**
- Código de estado: 200 OK
- Respuesta JSON:
    ```json
    {
        "respuesta": "respuesta"
    }