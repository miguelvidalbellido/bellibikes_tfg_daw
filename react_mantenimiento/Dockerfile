FROM node

WORKDIR /app_mantenimiento

COPY package.json .

RUN npm install

COPY . .

EXPOSE 5173

CMD ["npm", "run", "start"]