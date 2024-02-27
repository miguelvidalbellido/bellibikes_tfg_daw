#!/bin/bash
echo "Creating Migrations..."
python3 manage.py makemigrations
# python3 manage.py makemigrations users
echo ====================================

echo "Starting Migrations..."
python3 manage.py migrate
echo ====================================

echo "Starting Server..."
# python3 manage.py runserver 0.0.0.0:8090
uvicorn django_backend.asgi:application --host 0.0.0.0 --port 8090