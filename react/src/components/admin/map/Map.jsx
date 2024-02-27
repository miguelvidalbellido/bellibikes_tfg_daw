import React, { useState, useEffect } from "react"
import { MapContainer, TileLayer } from "react-leaflet"
import "leaflet/dist/leaflet.css"
import Pointer from "./Pointer"


const Map = ({ data = [] }) => {
    const ontinyentCoords = [38.8220593, -0.6063927];
    const [dataValues, setDataValues] = useState(data)

    useEffect(() => {
        setDataValues(data);
    }, [data]);

    return (
        <MapContainer 
            center={ontinyentCoords}
            zoom={15}
            style={{ height: "80vh", width: "100%" }}
            zoomControl={false}>
            <TileLayer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            />
            {data.map(element => (
                <Pointer key={element.id} data={element} />
            ))}
        </MapContainer>
    );
};

export default Map