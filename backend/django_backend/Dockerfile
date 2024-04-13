FROM python:3.8-buster

# Instalar Graphviz y dependencias
RUN apt-get update && apt-get install -y graphviz libgraphviz-dev pkg-config

# Instalar Graphviz y dependencias
RUN apt-get update && apt-get install -y graphviz libgraphviz-dev pkg-config

# Set unbuffered output for python
ENV PYTHONUNBUFFERED 1

# Create app directory
WORKDIR /app

# Install app dependencies
COPY requirements.txt .
RUN pip install -r requirements.txt

# Bundle app source
COPY . .

# Expose port
EXPOSE 8090

RUN chmod +x django.sh

# entrypoint to run the django.sh file
ENTRYPOINT ["/app/django.sh"]