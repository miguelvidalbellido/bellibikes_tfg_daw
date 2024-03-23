<a name="readme-top"></a>

<div align="center">

  <img src="./readme_imgs/bellibikes_logo.webp" alt="logo" width="200"  height="auto" />
  <br/>

  <h1><b>BelliBikes</b></h1>

</div>

<!-- TABLA DE CONTENIDO -->

# 📗 Tabla de contenidos

- [📖 Sobre el proyecto](#sobre-el-proyecto)
  - [🛠 Desarrollado con](#built-with)
    - [:battery: Pila tecnológica](#tech-stack)
    - [:bulb: Características principales](#key-features)
  - [🚀 Demostración en directo](#live-demo)
- [💻 Servicios](#services-documentation)
  - [React](#react-client-documentation)
  - [React Mantenimiento](#maintenance-client-documentation)
  - [Django](#django)
  - [Fastify](#fastify)
  - [Express - Resend](#express-resend)
  - [Facturascripts](#facturascripts)
  - [Arduino](#arduino)
- [📦Dependencias](#dependencias-react)
  - [React](#dependencias-react)
  - [React Mant](#dependencias-react-mant)
  - [Django](#dependencias-django)
- [👥 Desarrolladores](#authors)
<!-- - [🔭 Future Features](#future-features)
- [🤝 Contributing](#contributing)
- [⭐️ Show your support](#support) -->
- [🙏 Agradecimientos](#acknowledgements)
<!-- - [❓ FAQ (OPTIONAL)](#faq)
- [📝 License](#license) -->

<!-- SOBRE EL PROYECTO -->

# 📖 BelliBikes <a name="about-project"></a>


**BelliBikes** es una aplicación enfocada al alquiler de bicicletas eléctricas, fomentando la facilidad en la gestión y mantenimiento y una gran experiencia para el usuario.

## 👥 Autores <a name="authors"></a>


👤 **Miguel Vidal Bellido**

- GitHub: [@miguelvidalbellido](https://github.com/miguelvidalbellido)
- Gmail: [miguel.vidal.bell@gmail.com](mailto:miguel.vidal.bell@gmail.com)
- LinkedIn: [LinkedIn](https://www.linkedin.com/in/miguelvidalbellido/)



## 🛠 Desarrollado con <a name="built-with"></a>

### Pila tecnológica <a name="tech-stack"></a>


<details>
  <summary>Cliente</summary>
  <ul>
    <li><a href="https://reactjs.org/">React.js</a></li>
  </ul>
</details>

<details>
  <summary>Servidor</summary>
  <ul>
    <li><a href="https://expressjs.com/">Express.ts</a></li>
    <li><a href="https://fastify.dev/">Fastify.js</a></li>
    <li><a href="https://www.djangoproject.com/">Django</a></li>
    <li><a href="https://www.arduino.cc/">Arduino</a></li>
    <li><a href="https://www.php.net/">PHP</a></li>
    <li><a href="https://facturascripts.com/">Facturascripts</a></li>
  </ul>
</details>

<details>
<summary>Bases de Datos</summary>
  <ul>
    <li><a href="https://www.postgresql.org/">PostgreSQL</a></li>
    <li><a href="https://www.mysql.com/">PostgreSQL</a></li>
    <li><a href="https://www.sqlite.org/">SQLite</a></li>
  </ul>
</details>

<details>
<summary>Gestores de Bases de Datos</summary>
  <ul>
    <li><a href="https://www.pgadmin.org/">PgAdmin</a></li>
    <li><a href="https://www.adminer.org/">Adminer</a></li>
  </ul>
</details>

<details>
<summary>Otras tecnologías</summary>
  <ul>
    <li><a href="https://contabo.com/en/">Docker Compose</a></li>
    <li><a href="https://resend.com/">Resend</a></li>
    <li><a href="https://bitwarden.com/es-la/">Bitwarden</a></li>
    <li><a href="https://www.nginx.com/">Nginx</a></li>
    <li><a href="https://letsencrypt.org/es/">LetsEncrypt</a></li>
    <li><a href="https://www.ionos.es/">Ionos</a></li>
    <li><a href="https://docs.docker.com/compose/">Contabo</a></li>
  </ul>
</details>



<!-- CARACTERRÏSTICAS -->

### Características principales <a name="key-features"></a>


- **Micro servicio con plantillas para enviar correos**
- **Comunicación interactiva mediante WebSocket**
- **Cliente React con dos vistas, vista cliente para móvil y vista ordenador para información y panel de administración.**
- **Panel de Mantenimiento con React.**
- **Facturación con ERP (Facturascripts)**
- **Despliegue con Docker-compose en servidor VPS con HTTPS**

<p align="right">(<a href="#readme-top">volver al inicio</a>)</p>

<!-- LIVE DEMO -->

## 🚀 Demostración en directo <a name="live-demo"></a>


- [Cliente](https://bellibikes.bellidel.eu/)
- [Mantenimiento](https://bellibikesmant.bellidel.eu/login)
- [Facturación](https://bbfs.bellidel.eu/)


<p align="right">(<a href="#readme-top">volver al inicio</a>)</p>


# Servicios <a name="services-documentation"></a>

<!-- REACT -->

## :wrench: Servicios Frontend <a name="service-frontend-documentation"></a>

### 🖥️ Cliente React  <a name="react-client-documentation"></a>
BelliBikes ofrece una experiencia de usuario adaptativa y rica en funcionalidades, distribuida en dos vistas principales diseñadas para satisfacer las necesidades específicas de nuestros usuarios, dependiendo del dispositivo que estén utilizando. A continuación, se detallan las capacidades y características de cada vista.

#### 📱 Vista Cliente Móvil

Diseñada **específicamente para dispositivos móviles**, esta vista se centra en facilitar el proceso de alquiler de bicicletas, ofreciendo una interfaz intuitiva y accesible que se activa automáticamente al detectar el acceso desde un dispositivo móvil.

**Funcionalidades Principales:**

- **Registro y Login:** Los usuarios pueden crear una cuenta nueva o iniciar sesión en una existente. :pencil:

- **Alquiler y Devolución de Bicicletas:** Facilita el proceso de alquilar una bicicleta y devolverla, optimizando la experiencia para dispositivos móviles. :bicycle:

- **Contratación de Planes:** Permite a los usuarios contratar diferentes planes de alquiler según sus necesidades. :page_with_curl:

- **Consulta de Información sobre Estaciones:** Ofrece información detallada sobre las estaciones de bicicletas, incluyendo ubicación y disponibilidad. :station:

- **Notificación de Incidencias:** Los usuarios pueden notificar incidencias directamente desde la aplicación. :loudspeaker:

- **Consulta de Etapas de Incidencias:** Permite a los usuarios seguir el progreso de las incidencias que han notificado. :mag_right:

- **Consulta de Perfil:** Los usuarios pueden ver y editar su perfil, incluyendo información personal y preferencias. :bust_in_silhouette:

#### 💻 Vista PC - Web Informativa y Panel de Administración
Esta vista está diseñada para ser utilizada principalmente en computadoras. Incluye una web informativa accesible a todos los usuarios, y un panel de administración destinado a la gestión integral de la aplicación.

**Web Informativa:**

- Proporciona información general sobre BelliBikes, incluyendo servicios y ventajas. :information_source:
- Los usuarios logueados pueden comprar planes de alquiler directamente desde esta vista. :shopping_cart:

**Panel de Administración:**

- **CRUD de Bicicletas, Estaciones, Slots e Incidencias:** Herramientas completas para la gestión de bicicletas, estaciones de alquiler, slots disponibles e incidencias reportadas. :wrench:

- **Mapa Interactivo:** Visualización de estaciones activas e inactivas para facilitar la gestión y mantenimiento. :world_map:

- **Estadísticas Detalladas:** Análisis y seguimiento de la utilización de bicicletas, disponibilidad de slots y estado de las estaciones. :bar_chart:

- **Gestión de Usuarios:** Permite a los administradores enviar correos personalizados a usuarios, modificar datos de usuario y controlar el acceso de los usuarios activando o desactivando su capacidad de login. :user_cog:

Cada vista está diseñada con el usuario final en mente, asegurando que la experiencia de alquilar una bicicleta sea tan eficiente y agradable como sea posible, mientras que la gestión y mantenimiento de la aplicación se realizan con facilidad desde el panel de administración.

<!-- REACT MANTENIMIENTO -->

### :wrench: Cliente React para Mantenimiento <a name="maintenance-client-documentation"></a>

El cliente React para el usuario de mantenimiento es una herramienta esencial dentro del ecosistema de BelliBikes, diseñada para facilitar la gestión, seguimiento y resolución de incidencias de manera eficiente. Al acceder a la aplicación, se realizan las siguientes comprobaciones y funcionalidades:

#### :lock: Autenticación y Token
- Al acceder, la aplicación verifica la existencia de un token de autenticación.
- Si no se encuentra un token, se carga automáticamente el módulo de **login** para que el usuario de mantenimiento inicie sesión.

#### :bar_chart: Estadísticas
- **Sección de Estadísticas:** Una vez autenticado, el usuario puede acceder a una sección dedicada a las estadísticas.
- **Visualización Gráfica y Datos Estadísticos:** Se presentan gráficos y estadísticas detalladas sobre las incidencias, permitiendo al usuario obtener una visión general del estado actual y tendencias en el tiempo.

#### :clipboard: Listado de Incidencias
- **Visualización de Incidencias:** Se ofrece un listado completo de todas las incidencias reportadas.
- **Detalle de Incidencias:** Los usuarios pueden seleccionar una incidencia específica para ver sus etapas y detalles asociados, facilitando el seguimiento y la gestión de cada caso.

#### :mag: Escáner de RFID
- **Asociación de Escáner:** Para los usuarios de mantenimiento sin un escáner RFID asociado, se muestra un modal que permite la asociación de un escáner a su cuenta.
- **Modo Escaneo:** Una vez asociado el escáner, el usuario puede entrar en modo escucha al presionar el botón de escanear.
- **Lectura de Productos:** Cuando el usuario de mantenimiento escanea un producto (bicicleta) con su lector RFID, la aplicación notifica al backend, que a su vez informa al frontend sobre la bicicleta escaneada.
- **Gestión de Incidencias y Etapas:** Se muestran las incidencias y etapas asociadas a la bicicleta leída, y el usuario tiene la posibilidad de añadir nuevas etapas a la incidencia, mejorando el proceso de resolución.

El cliente para el usuario de mantenimiento está diseñado para ser intuitivo y eficiente, asegurando que la gestión de incidencias y el mantenimiento de las bicicletas se realicen con la máxima eficacia y el menor tiempo de respuesta posible.

<p align="right">(<a href="#readme-top">volver al inicio</a>)</p>


### Servidor Backend Django 🚲 <a name="django"></a>

Este servidor es el Core principal de la aplicación, por el pasan todos las operaciones más críticas, ademas de funcionar como puente (puerta de enlace) entre los clientes y los servidores backend restantes. 

#### Tabla de Contenidos 📑
- [Autenticación y Gestión de Usuarios](#autenticación-y-gestión-de-usuarios)
- [Módulo de Stations (Estaciones)](#módulo-de-stations)
- [Módulo de Rent (Alquiler)](#módulo-de-rent)
- [Módulo de Stats (Estadísticas)](#módulo-de-stats)
- [Módulo de Incidencias](#módulo-de-incidencias)
- [Módulo de Mantenimiento](#módulo-de-mantenimiento)
- [Integración con FacturaScripts](#integración-con-facturascripts)

---

#### :lock: Autenticación y Gestión de Usuarios <a name="autenticación-y-gestión-de-usuarios"></a>

Este módulo se encarga de la gestión integral de usuarios, incluyendo el registro, inicio de sesión y la autenticación basada en tokens JWT. Además, incluye funcionalidades avanzadas como:

- **Blacklist de Tokens:** Para asegurar que los tokens caducados no sean utilizados, se implementa una blacklist que los invalida efectivamente.
- **Desactivación de Cuentas:** Los usuarios pueden desactivar sus cuentas si lo desean.
- **Alta Automática en FacturaScripts:** Al iniciar sesión por primera vez, los clientes se registran automáticamente en FacturaScripts, facilitando la gestión administrativa.

---

#### :bike: Módulo de Stations (Estaciones) <a name="módulo-de-stations"></a>

El módulo de stations permite la gestión completa de bicicletas, estaciones, y slots a través de operaciones CRUD, facilitando así la administración del inventario y la disponibilidad de bicicletas para el alquiler.

---

#### :key: Módulo de Rent (Alquiler) <a name="módulo-de-rent"></a>

Este módulo es crucial para el funcionamiento del sistema de alquiler de bicicletas. Incluye:

- **Alquiler y Devolución:** Los usuarios pueden alquilar bicicletas y devolverlas usando un sistema basado en Arduino como slot.
- **Facturación Automática:** Al realizar un alquiler, se crea automáticamente una factura en FacturaScripts, y se añade el coste asociado a la cuenta del usuario.

---

#### :bar_chart: Módulo de Stats (Estadísticas) <a name="módulo-de-stats"></a>

Proporciona estadísticas detalladas sobre el uso de la aplicación, incluyendo datos sobre alquileres, incidencias, y mucho más, ofreciendo una herramienta valiosa para el administrador y el equipo de mantenimiento.

---

#### :warning: Módulo de Incidencias <a name="módulo-de-incidencias"></a>

Facilita la creación y gestión de incidencias, permitiendo añadir etapas para su resolución. Es una herramienta clave para el seguimiento y solución de problemas reportados por los usuarios.

---

#### :wrench: Módulo de Mantenimiento <a name="módulo-de-mantenimiento"></a>

Este módulo está diseñado para los usuarios de mantenimiento, permitiendo la asociación con un lector RFID, la consulta de datos, y la activación del proceso de lectura activa para la gestión de bicicletas e incidencias asociadas.

---

#### :heavy_dollar_sign: Integración con FacturaScripts <a name="integración-con-facturascripts"></a>

Detalla cómo se integra el backend con FacturaScripts para la gestión automática de clientes y facturación, facilitando un flujo de trabajo coherente y automatizado.

---

Este documento pretende ser una guía completa para el entendimiento y operación del backend de Django para BelliBikes, asegurando una comprensión clara de sus módulos y funcionalidades.

<p align="right">(<a href="#readme-top">volver al inicio</a>)</p>

###  FacturaScripts 📃 <a name="facturascripts"></a>

#### Tabla de Contenidos 📑
- [Introducción](#introducción)
- [Integración con Django](#integración-con-django)
- [Gestión de Productos](#gestión-de-productos)
- [Creación y Gestión de Facturas](#creación-y-gestión-de-facturas)
- [Acceso a Internet](#acceso-a-internet)
- [Uso de la API de FacturaScripts](#uso-de-la-api-de-facturascripts)
- [Seguridad y Privacidad](#seguridad-y-privacidad)

---

#### Introducción 🌟
FacturaScripts es una herramienta esencial en nuestro ecosistema, diseñada para la gestión eficiente de productos y la creación y manejo de facturas. Este servicio se integra estrechamente con nuestro backend de Django, facilitando la automatización de tareas administrativas y contables.

#### Integración con Django 🔄
La integración entre FacturaScripts y Django se realiza a través de la API de FacturaScripts, permitiendo que nuestro backend en Django interactúe directamente con FacturaScripts para realizar operaciones como la consulta, creación, y gestión de productos y facturas.

#### Gestión de Productos 🛒
- **Almacenamiento de Productos:** FacturaScripts se encarga de mantener un registro actualizado de todos los productos disponibles.
- **Sincronización:** Cualquier adición o actualización en el inventario de productos se sincroniza automáticamente con nuestro sistema Django.

#### Creación y Gestión de Facturas 💼
- **Creación Automática de Facturas:** A través de la API, Django puede solicitar a FacturaScripts la creación de facturas basadas en las transacciones realizadas por los usuarios.
- **Gestión de Facturas:** FacturaScripts permite la revisión, modificación y gestión de facturas emitidas, asegurando la precisión y la conformidad con los requisitos legales y fiscales.

#### Acceso a Internet 🌐
FacturaScripts accede a Internet para obtener información relevante necesaria para la actualización de productos y la generación de facturas, garantizando que los datos estén siempre actualizados y sean precisos.

#### Uso de la API de FacturaScripts 🛠️
- **API Rest:** FacturaScripts expone una API Rest que nuestro sistema Django utiliza para interactuar con el servicio.
- **Operaciones Soportadas:** La API permite operaciones como la creación, consulta, y gestión de productos y facturas.

#### Seguridad y Privacidad 🔒
- **Autenticación:** Todas las comunicaciones entre Django y FacturaScripts son autenticadas para asegurar la seguridad y la privacidad de los datos.
- **Encriptación:** Se utiliza encriptación en el transporte de datos para proteger la información sensible.


### Servidor Node con Fastify 🚀 <a name="fastify"></a>

#### Tabla de Contenidos 📑
- [Introducción](#introducción)
- [Arquitectura y Tecnologías](#arquitectura-y-tecnologías)
- [API Extendida de FacturaScripts](#api-extendida-de-facturascripts)
- [Cron Jobs](#cron-jobs)
  - [Reestablecimiento de Minutos para Usuarios con Plan](#reestablecimiento-de-minutos-para-usuarios-con-plan)
  - [Gestión de la Batería de las Bicicletas](#gestión-de-la-batería-de-las-bicicletas)
- [Seguridad](#seguridad)
- [Instalación y Uso](#instalación-y-uso)
- [Soporte y Contribución](#soporte-y-contribución)

---

#### Introducción 🌟
Este servidor Node.js, impulsado por Fastify, está diseñado para extender y optimizar las capacidades de la API de FacturaScripts. Busca mejorar la eficiencia de las peticiones a través de la velocidad y el bajo overhead que ofrece Fastify, proporcionando una capa adicional de funcionalidad y rendimiento.

#### Arquitectura y Tecnologías 🏗️
- **Node.js**: El entorno de ejecución para JavaScript en el servidor.
- **Fastify**: Un framework web rápido y de bajo overhead para Node.js, elegido por su eficiencia en el manejo de peticiones HTTP.

#### API Extendida de FacturaScripts 📡
Esta implementación utiliza Fastify para crear endpoints personalizados que extienden la funcionalidad de la API de FacturaScripts, permitiendo:
- Optimización de las peticiones y respuestas.
- Funciones adicionales específicas para el negocio que no están presentes en la API original de FacturaScripts.

**Cron Jobs ⏲️**
#### Reestablecimiento de Minutos para Usuarios con Plan 🔄
- **Funcionalidad**: Este cron se ejecuta diariamente a las 00:00 para reestablecer los minutos disponibles de los usuarios que cuentan con un plan de suscripción.
  
#### Gestión de la Batería de las Bicicletas 🔋
- **Funcionalidad**: Un cron adicional se encarga de simular el uso de las bicicletas, aumentando o disminuyendo su nivel de batería en función del uso reportado.

#### Seguridad 🔒
La seguridad es una prioridad, implementando medidas como:
- Autenticación y autorización para el acceso a endpoints críticos.
- Encriptación de datos sensibles.

### Servicio de Envío de Correos con Express, Node.js y TypeScript 📧 <a name="express-resend"></a>

#### Tabla de Contenidos 📑
- [Introducción](#introducción)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Manejo de Peticiones](#manejo-de-peticiones)
- [Plantillas de Correo](#plantillas-de-correo)
- [Seguridad](#seguridad)

---

#### Introducción 🌟
Este servicio API implementado con Express y Node.js en TypeScript es una solución dedicada para el envío de correos electrónicos, mejorando y extendiendo las funcionalidades de la API de FacturaScripts. Con Resend y plantillas `.hbs`, este servicio está diseñado para optimizar la entrega de correos mediante la carga de datos recibidos por petición en plantillas específicas para cada tipo de mensaje.

#### Estructura del Proyecto 📂
El proyecto se organiza de la siguiente manera:
- `controllers`: Contiene `mailsController.ts` que maneja la lógica de negocio para el envío de correos.
- `middleware`: Incluye `verifyConnection.ts` para asegurar que cada petición viene de una fuente autorizada.
- `models`: Define la estructura de datos para los correos con `emailModel.ts`.
- `routes`: Maneja las rutas de correo con `mailRoutes.ts`.
- `templates`: Almacena las plantillas Handlebars (`.hbs`) como `alertEmail.hbs`, `detailsRentEmail.hbs`, `infoEmail.hbs`, y `warningEmail.hbs` para diferentes tipos de correos.

#### Manejo de Peticiones ✉️
Las peticiones a la API deben incluir:
- Datos del mensaje en formato JSON.
- Un token válido para la autenticación.
- La indicación de la plantilla `.hbs` que se usará.

#### Plantillas de Correo 📄
Las plantillas Handlebars `.hbs` permiten insertar datos dinámicos en los correos. Los datos recibidos en la petición se cargan en la plantilla especificada antes de enviar el correo.

#### Seguridad 🔒
La seguridad se maneja a través de:
- Tokens JWT para autenticar las peticiones.
- Conexión segura al servidor SMTP.

## Arduino <a name="arduino"></a>

### Servicio de Lectura de Tarjetas RFID y Conexión WiFi con Arduino y Django END_RENT 📶

#### Tabla de Contenidos 📑
- [Introducción](#introducción)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Manejo de Peticiones](#manejo-de-peticiones)
- [Configuración de Hardware](#configuración-de-hardware)
- [Seguridad](#seguridad)

---

#### Introducción 🌟
Este script para Arduino está diseñado para leer identificadores de tarjetas RFID utilizando el módulo MFRC522 y conectarse a un servidor a través de WiFi para realizar acciones específicas. Este código es parte de un sistema mayor que interactúa con una API para gestionar el estado de objetos, como terminar el alquiler de una bicicleta en este caso.

#### Estructura del Proyecto 📂
El script de Arduino se divide en dos secciones principales:
- `setup()`: Configura la conexión inicial del módulo RFID y WiFi.
- `loop()`: Espera la presentación de una nueva tarjeta RFID para leer su ID y enviar una solicitud HTTP GET al servidor.

#### Manejo de Peticiones 📡
Cuando se detecta una tarjeta RFID, el código:
- Lee el ID de la tarjeta.
- Establece una conexión segura con el servidor especificado.
- Envía una solicitud GET al servidor con el ID de la tarjeta como parte del endpoint.

#### Configuración de Hardware 🔌
Deberás conectar:
- El módulo MFRC522 a tu Arduino a través de los pines SPI y los pines de reset (RST_PIN) y SS (SS_PIN) configurados.
- Asegúrate de que tu módulo WiFi (como WiFi NINA) esté correctamente instalado y operativo en tu placa Arduino.

#### Seguridad 🔒
- **Credenciales WiFi**: Mantén las credenciales de tu red WiFi en un lugar seguro y no las codifiques directamente en el script cuando lo compartas.
- **Conexión HTTPS**: El script realiza una conexión segura al servidor, asegúrate de que el servidor tiene un certificado SSL/TLS válido para proteger la transmisión de datos.

### Servicio de Escaneo RFID con Arduino y Conexión WiFi Segura 🚀

#### Tabla de Contenidos 📑
- [Introducción](#introducción)
- [Configuración del Hardware](#configuración-del-hardware)
- [Configuración del Software](#configuración-del-software)
- [Proceso de Inicialización](#proceso-de-inicialización)
- [Funcionamiento del Bucle Principal](#funcionamiento-del-bucle-principal)
- [Conexión con el Servidor](#conexión-con-el-servidor)

---

#### Introducción 🌟
Este script para Arduino permite la lectura de tarjetas RFID mediante el módulo MFRC522 y el envío de los datos leídos a un servidor a través de una conexión WiFi segura. Es especialmente útil para sistemas que requieren identificación de usuario o activos, como el mantenimiento de equipos.

#### Configuración del Hardware 🛠️
- **MFRC522 RFID Reader**: Conectado a los pines SPI del Arduino y los pines específicos para SS (Slave Select) y RST (Reset).
- **WiFi NINA Module**: Asegúrate de que esté correctamente instalado en tu placa Arduino.

#### Configuración del Software 💻
- **Librerías de Arduino**: `SPI.h`, `MFRC522.h`, `WiFiNINA.h` son necesarias para la compilación del script.
- **Credenciales WiFi**: `ssid` y `password` deben ser actualizadas con la información de tu red.

#### Proceso de Inicialización 🔌
En `setup()`, el sistema:
- Inicia la comunicación serial.
- Inicializa el módulo MFRC522.
- Establece la conexión WiFi.

#### Funcionamiento del Bucle Principal 🔄
El `loop()`:
- Detecta nuevas tarjetas RFID presentes.
- Lee el ID de la tarjeta y lo envía al servidor a través de una solicitud GET HTTPS.

#### Conexión con el Servidor 🔗
- Se realiza una conexión SSL al servidor utilizando `WiFiSSLClient`.
- El `host` y `httpsPort` deben coincidir con tu servidor y puerto configurados para aceptar solicitudes HTTPS.


<!-- DEPENDENCIAS -->




## :package: Dependencias de React Frontend <a name="dependencias-react"></a>

### :star: Dependencias Principales

- **@radix-ui/react-***: :art: Colección de componentes de UI sin estilo para construir interfaces de usuario de alta calidad.
- **axios**: :globe_with_meridians: Cliente HTTP basado en promesas para el navegador y node.js.
- **class-variance-authority**: :bookmark_tabs: Proporciona tipos de utilidad para manejar variantes de clase en TypeScript.
- **clsx**: :link: Utilidad para construir cadenas de nombres de clase condicionalmente.
- **date-fns**: :calendar: Biblioteca moderna de manipulación de fechas.
- **framer-motion**: :dizzy: Biblioteca para animaciones y gestos en React.
- **html5-qrcode**: :qr_code: Lector de QR para HTML5.
- **lucide-react**: :pushpin: Iconos React para Lucide.
- **react y react-dom**: :atom_symbol: Biblioteca de JavaScript para construir interfaces de usuario.
- **react-day-picker**: :date: Selector de fechas flexible y sin dependencias para React.
- **react-device-detect**: :mobile_phone_off: Detecta dispositivos, navegadores y sistemas operativos en React.
- **react-helmet-async**: :helmet_with_white_cross: Gestión de documentos head para React.
- **react-hook-form**: :memo: Biblioteca para manejar formularios con React.
- **react-leaflet**: :world_map: Componentes React para Leaflet, una biblioteca de mapas.
- **react-lottie**: :film_projector: Renderizador de animaciones Lottie para React.
- **react-native-qrcode-scanner y react-qr-reader**: :camera_flash: Bibliotecas para escanear códigos QR en aplicaciones React y React Native.
- **react-router-dom**: :compass: Enrutamiento dinámico para aplicaciones web con React.
- **react-toastify**: :bell: Componentes de notificación para React.
- **tailwind-merge y tailwindcss-animate**: :cyclone: Herramientas para trabajar con Tailwind CSS, una biblioteca de CSS de utilidad.

### :gear: DevDependencies

- **@types/react y @types/react-dom**: :page_facing_up: Tipos TypeScript para react y react-dom.
- **@vitejs/plugin-react**: :electric_plug: Plugin oficial de Vite para React.
- **autoprefixer**: :mag: PostCSS plugin para parsear CSS y agregar prefijos de proveedores a las reglas CSS.
- **eslint y plugins relacionados**: :no_entry_sign: Linter para JavaScript y JSX, con plugins específicos para React y hooks.
- **postcss**: :nail_care: Herramienta para transformar CSS con plugins de JavaScript.
- **tailwindcss**: :tornado: Marco CSS de utilidad para el diseño rápido de UI.
- **vite**: :rocket: Herramienta de construcción que ofrece una experiencia de desarrollo más rápida y un servidor de desarrollo optimizado.


## :package: Dependencias del Dashboard de Mantenimiento <a name="dependencias-react-mant"></a>

### :sparkles: Dependencias Principales

- **axios**: :globe_with_meridians: Cliente HTTP basado en promesas para el navegador y node.js.
- **chart.js y react-chartjs-2**: :bar_chart: Bibliotecas para crear gráficos interactivos dentro de aplicaciones React.
- **react y react-dom**: :atom_symbol: Bibliotecas de JavaScript para construir interfaces de usuario.
- **react-hot-toast**: :fire: Biblioteca para mostrar notificaciones de una manera muy sencilla.
- **react-icons**: :art: Permite incluir íconos de diferentes librerías en proyectos React.
- **react-lottie**: :film_projector: Renderizador de animaciones Lottie para React.
- **react-router-dom**: :compass: Enrutamiento dinámico para aplicaciones web con React.

### :gear: DevDependencies

- **@types/react y @types/react-dom**: :page_facing_up: Tipos TypeScript para react y react-dom.
- **@vitejs/plugin-react**: :electric_plug: Plugin oficial de Vite para React.
- **autoprefixer y postcss**: :nail_care: Herramientas para automatizar la compatibilidad de CSS entre diferentes navegadores.
- **eslint y plugins relacionados**: :no_entry_sign: Linter para JavaScript y JSX, con plugins específicos para React y hooks.
- **tailwindcss**: :cyclone: Marco CSS de utilidad para el diseño rápido de UI.
- **vite**: :rocket: Herramienta de construcción que ofrece una experiencia de desarrollo más rápida y un servidor de desarrollo optimizado.

<!-- DJANGO -->

## :package: Dependencias del Backend Django <a name="dependencias-django"></a>

### Paquetes y Dependencias 🛠️
- **Django** 🌐: El framework web principal.
  - `Django==3.2.5`
- **Psycopg2-binary** 🐘: Adaptador de base de datos PostgreSQL para Python.
  - `psycopg2-binary==2.9.1`
- **Django REST Framework** 🔄: Un poderoso y flexible toolkit para construir APIs web.
  - `djangorestframework==3.12.4`
- **PyJWT** 🔑: Implementación de JSON Web Tokens para Python.
  - `PyJWT==2.3.0`
- **Django CORS Headers** 🌍: Manejo de Cross-Origin Resource Sharing (CORS) en Django.
  - `django-cors-headers==3.7.0`
- **Channels** 📡: Extiende Django para manejar WebSockets, chats, y más.
  - `channels==4.0.0`
- **Uvicorn[standard]** 🦄: Un servidor ASGI ligero basado en uvloop y httptools.
  - `uvicorn[standard]==0.15.0`
- **Requests** 📤: Una elegante y simple biblioteca HTTP para Python.
  - `requests==2.28.0`

<!-- FACTURASCRIPTS -->


<!-- SERVIDOR EXPRESS -->


<!-- SERVIDOR FASTIFY -->

<!-- ARDUINO -->


<!-- AGRADECIMIENTOS -->

## 🙏 Agradecimientos <a name="acknowledgements"></a>

En primer lugar, mi gratitud hacia el equipo docente de primero y segundo curso. Cada profesor, con su dedicación, pasión y compromiso, no solo ha compartido con nosotros valiosos conocimientos técnicos, sino que también nos ha enseñado a enfrentar desafíos, a trabajar en equipo y a nunca dejar de aprender y curiosear sobre las infinitas posibilidades que el desarrollo web ofrece. Su guía ha sido fundamental para el desarrollo de este proyecto y para prepararnos para los retos profesionales que nos esperan.

Quiero agradecer especialmente a Yolanda, Carolina, Javi, Pau, Miguel, Jose y Javi, por su apoyo continuo, sus consejos y su capacidad para inspirarnos a superar nuestras expectativas. Su entusiasmo y conocimiento han sido una fuente de inspiración constante y han jugado un papel crucial en mi formación.

Este proyecto es el resultado de muchas horas de esfuerzo, aprendizaje y colaboración. Es un reflejo no solo de mi trabajo, sino del espíritu de comunidad y apoyo mutuo que he tenido la fortuna de experimentar en este ciclo formativo. Por ello, mi agradecimiento se extiende a todos mis compañeros, con quienes he compartido dudas, ideas y descubrimientos a lo largo del camino. Su compañerismo ha hecho de esta experiencia algo inolvidable.

Este proyecto no solo marca el fin de una etapa, sino el comienzo de una nueva aventura profesional. Gracias a todos los que han sido parte de este viaje.


<p align="right">(<a href="#readme-top">volver al inicio</a>)</p>

