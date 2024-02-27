import React, { useContext, useEffect, useState, useRef } from "react";
import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";
import { useParams } from "react-router-dom";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import locationImg from "@/assets/stationIcons/station_open.png";
import StationContext from "@/context/Stations/StationsContext";
import bikeImage from "@/assets/bikeIcons/bike.png";
import GeoLocationComponent from '@/components/client/geolocation/Geolocation'
import { calculateVelocity } from '@/components/client/geolocation/calculateVelMedia';
import RentContext from "@/context/Rent/RentContext";
import { useNavigate } from "react-router-dom"

const stationIcon = new L.Icon({
    iconUrl: locationImg,
    iconSize: [25, 25],
});

const bikeIcon = new L.Icon({
    iconUrl: bikeImage,
    iconSize: [25, 25],
});

const RentView = () => {
  const { stations } = useContext(StationContext)
  const { activeRentUser, setActiveRentUser, rents } = useContext(RentContext)
  const ontinyentCoords = [38.8220593, -0.6063927];
  const { bikeUUID } = useParams();
  const navigate = useNavigate();

  const redirects = {
    RentalDetials: (uuid_rent) => {
      navigate(`/rentalDetails/${uuid_rent}`)
    }
  }

  useEffect(() => {
    console.log("UUID del rent activo:", activeRentUser)

    if (activeRentUser) {
        const rentFound = rents.find((rent) => rent.uuid === activeRentUser);

        if (rentFound && rentFound.status === "FINISHED") {
            const uuid_rent = rentFound.uuid
            console.log("El rent ha finalizado.")
            setActiveRentUser(null)
            redirects.RentalDetials(uuid_rent)
        } else {
            console.log("El rent está activo o no se ha encontrado.")
        }
    }
  }, [activeRentUser, rents, setActiveRentUser])


  // TIMER
	const [time, setTime] = useState({
		sec: 0,
		min: 0,
		hr: 0
	});

	const [intervalId, setIntervalId] = useState();

	const updateTimer = () => {
		setTime((prev) => {
			let newTime = { ...prev };
			// update sec and see if we need to increase min
			if (newTime.sec < 59) newTime.sec += 0.5;
			else {
				newTime.min += 1;
				newTime.sec = 0;
			}
			// min has increased in *newTime* by now if it was updated, see if it has crossed 59
			if (newTime.min === 60) {
				newTime.min = 0;
				newTime.hr += 1;
			}

			return newTime;
		});
	};

	const pauseOrResume = () => {
		if (!intervalId) {
			let id = setInterval(updateTimer, 1000);
			setIntervalId(id);
		} else {
			clearInterval(intervalId);
			setIntervalId("");
		}
	};

	const reset = () => {
		clearInterval(intervalId);
		setTime({
			sec: 0,
			min: 0,
			hr: 0
		});
	};

  // GEOLOCATION
  const [userLocation, setUserLocation] = useState(null)
  const [velocity, setVelocity] = useState('');

  const handleLocationFetch = location => {
    const velocityTmp = userLocation ? calculateVelocity(userLocation, location) : 0
    setVelocity(velocityTmp)
    setUserLocation(location)
  }

  const markerUser = userLocation ? (
    <Marker
            key={1}
            position={[userLocation.lat, userLocation.lng]}
            icon={bikeIcon}
          >
          </Marker>
    )
    : null

  useEffect(() => {
    pauseOrResume();
  },[bikeUUID]);

  const viewMap = (
    <div className="map-container">
      <MapContainer
        center={ontinyentCoords}
        zoom={14}
        className="absolute z-0 top-0 left-0 w-full h-full"
        zoomControl={false}
      >
        <TileLayer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          attribution="&copy; OpenStreetMap contributors"
        />
        {stations.map((marker, index) => (
          <Marker
            key={index}
            position={[marker.latitude, marker.longitude]}
            icon={stationIcon}
          >
            <Popup>
              <div>Bicis disponibles: {marker.bikes}</div>
            </Popup>
          </Marker>
        ))}
        {markerUser}
      </MapContainer>
      <div className="rent-bike-button">Rent bike</div>
    </div>
  )

  return (
    <>
      {/* GEOLOCATION */}
      <GeoLocationComponent onLocationFetch={handleLocationFetch} />
      <div className="relative h-screen w-full">
        <div className="map-container absolute top-0 left-0 w-full h-3/4">
            {viewMap}
        </div>

        <div className="absolute bottom-0 w-full px-4 py-6 space-y-2">
          <div className="flex justify-between">
            <div className="flex-1 bg-white rounded-lg shadow p-4 mx-1">
              <p className="text-xs text-gray-600">Velocidad Med</p>
              <p className="text-lg font-semibold">{velocity} Km/h</p>
            </div>

            <div className="flex-1 bg-white rounded-lg shadow p-4 mx-1">
              <p className="text-xs text-gray-600">Tiempo</p>
              <p className="text-lg font-semibold">{`${time.hr < 10 ? 0 : ""}${time.hr} : ${time.min < 10 ? 0 : ""}${time.min} : ${time.sec < 10 ? 0 : ""}${time.sec}`}</p>
            </div>
          </div>

          <div className="flex justify-between">
            <div className="flex-1 bg-white rounded-lg shadow p-4 mx-1">
              <p className="text-xs text-gray-600">Precio</p>
              <p className="text-lg font-semibold">€31</p>
            </div>

            <div className="flex-1 bg-red-500 text-white rounded-lg shadow p-4 mx-1 flex justify-center items-center">
              <button className="font-semibold" onClick={pauseOrResume}>Finalizar</button>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}

export default RentView
