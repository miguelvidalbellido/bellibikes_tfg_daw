import React, { useState } from "react"
import { Marker, Popup } from "react-leaflet"
import locationImg from "./location.png";
import imgStationActive from "@/assets/stationIcons/station_open.png"
import imgStationInactive from "@/assets/stationIcons/station_disabled.png"


const Pointer = ({ data }) => {
    const [iconSize, setIconSize] = useState([30, 30])
    
    const loadIcon = (type) => {
        switch (type) {
            case "station_open":
                return stationActiveIcon
            case "station_close":
                return stationInactiveIcon
            default:
                return defaultIcon
        }
    }

    const defaultIcon = new L.Icon({
        iconUrl: locationImg,
        iconSize: iconSize,
    });

    const stationActiveIcon = new L.Icon({
        iconUrl: imgStationActive,
        iconSize: iconSize,
    });

    const stationInactiveIcon = new L.Icon({
        iconUrl: imgStationInactive,
        iconSize: iconSize
    });

    return (
        <Marker position={[data.latitude, data.longitude]} icon={loadIcon(data.type)}>
            <Popup>
                <div>
                    <h2>{data.name}</h2>
                    <p>{data.description}</p>
                </div>
            </Popup>
        </Marker>
    )
}

export default Pointer