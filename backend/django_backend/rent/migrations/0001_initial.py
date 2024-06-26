# Generated by Django 4.2.9 on 2024-01-30 16:03

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        ('stations', '0003_slot'),
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.CreateModel(
            name='Rent',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('uuid', models.CharField(editable=False, max_length=36, unique=True, verbose_name='uuid')),
                ('status', models.CharField(max_length=100)),
                ('datetime_start', models.DateField()),
                ('datetime_finish', models.DateField()),
                ('latitude', models.DecimalField(decimal_places=20, max_digits=30)),
                ('longitude', models.DecimalField(decimal_places=20, max_digits=30)),
                ('uuid_bike', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='stations.bike')),
                ('uuid_station_destination', models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.SET_NULL, related_name='destination_rents', to='stations.station')),
                ('uuid_station_origin', models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.SET_NULL, related_name='origin_rents', to='stations.station')),
                ('uuid_user', models.ForeignKey(blank=True, null=True, on_delete=django.db.models.deletion.SET_NULL, to=settings.AUTH_USER_MODEL)),
            ],
        ),
    ]
