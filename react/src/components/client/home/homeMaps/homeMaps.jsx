import React, { useContext } from "react";
import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";
import "./homeMaps.css";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import locationImg from "./location.png";
import StationContext from "@/context/Stations/StationsContext";
import { Navigate, useNavigate } from "react-router-dom";

const bikeIcon = new L.Icon({
  iconUrl: locationImg,
  iconSize: [25, 25],
});

const HomeMaps = () => {
  
  const { stations } = useContext(StationContext)
  const ontinyentCoords = [38.8220593, -0.6063927];
  const navigate = useNavigate();

  const redirects = {
    station: (stationUUID) => {
      navigate(`/station/${stationUUID}`)
    }
  }

  // Control clicks
  const handleMarkerClick = (e, marker) => {
    console.log(`UUID: ${marker.uuid}`);
    redirects.station(marker.uuid)
  };

  return (
    <div className="map-container">
      <MapContainer
        center={ontinyentCoords}
        zoom={14}
        style={{ height: "100vh", width: "100%" }}
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
            icon={bikeIcon}
            eventHandlers={{
              click: (e) => handleMarkerClick(e, marker) // Agrega el manejador de clics al marcador
            }}
          >
            <Popup>
              <div>Bicis disponibles: {marker.bikes}</div>
            </Popup>
          </Marker>
        ))}
      </MapContainer>
      <div className="rent-bike-button">Rent bike</div>
    </div>
  );
};

export default HomeMaps;
