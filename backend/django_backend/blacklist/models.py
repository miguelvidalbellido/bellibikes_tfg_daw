from django.db import models

# Create your models here.
class Blacklist(models.Model):
    token = models.SlugField(max_length=255, unique=True, editable=False)

    def __str__(self):
        return str(self.id)