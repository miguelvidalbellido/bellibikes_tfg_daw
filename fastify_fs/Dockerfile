# Utilizar la imagen oficial de Node.js versión 19
FROM node:19-alpine

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /usr/src/app

# Copiar el archivo package.json y package-lock.json (si está disponible)
COPY package*.json ./

# Instalar dependencias del proyecto
RUN npm install

# Copiar el resto de los archivos del proyecto al contenedor
COPY . .

# Exponer el puerto que utiliza Fastify
EXPOSE 3000

# Ejecutar Fastify
CMD ["node", "src/app.js"]