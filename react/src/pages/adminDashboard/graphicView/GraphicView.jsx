import React, { useState, useEffect } from "react"
import Map from "@/components/admin/map/Map"
import { Label } from "@/components/ui/label"
import { Switch } from "@/components/ui/switch"
import { useStations } from '@/hooks/stations/useStations'


const GraphicView = () => {
    const [dataValues, setDataValues] = useState([]);
    const { stations } = useStations()

    const [showStationsActive, setShowStationsActive] = useState(false);
    const [showStationsInactive, setShowStationsInactive] = useState(false);
    const [showBikesRented, setShowBikesRented] = useState(false);
    const [showSlotsIncidence, setShowSlotsIncidence] = useState(false);
    const [showBikesIncidence, setShowBikesIncidence] = useState(false);

    let pivot = []
    

    ///////////////////////////////////////////
    ////////////// control switch /////////////
    ///////////////////////////////////////////

    const toggleStationsActive = () => {
        pivot = []
        let stationsActiveTmp = []        
        if (showStationsActive === false) {
            stations.map((station) => {
                if (station.status === "OPEN") {
                    station.type = "station_open"
                    stationsActiveTmp.push(station)
                }  
            })
            pivot = [...dataValues, ...stationsActiveTmp]
            setDataValues(pivot)
        } else {
            stationsActiveTmp = dataValues.filter(element => element.type !== "station_open")
            setDataValues(stationsActiveTmp)
        }
        setShowStationsActive(!showStationsActive)
    }

    const toggleStationsInactive = () => {
        pivot = []
        let stationsInactiveTmp = []        
        if (showStationsInactive === false) {
            stations.map((station) => {
                if (station.status === "CLOSE") {
                    station.type = "station_close"
                    stationsInactiveTmp.push(station)
                }  
            })
            pivot = [...dataValues, ...stationsInactiveTmp]
            setDataValues(pivot)
        } else {
            stationsInactiveTmp = dataValues.filter(element => element.type !== "station_close")
            setDataValues(stationsInactiveTmp)
        }
        setShowStationsInactive(!showStationsInactive)

    }

    const toggleBikesRented = () => {
        setShowBikesRented(!showBikesRented)
        console.log("Bikes Rented: Ha cambiado")
    }

    const toggleSlotsIncidence = () => {
        setShowSlotsIncidence(!showSlotsIncidence)
        console.log("Slots Incidence: Ha cambiado")
    }

    const toggleBikesIncidence = () => {
        setShowBikesIncidence(!showBikesIncidence)
        console.log("Bikes Incidence: Ha cambiado")
    }

    
    return (
        <div>
            <div className="flex justify-center space-x-4 mb-4">
                <div className="flex items-center space-x-2">
                    <Switch id="station_active" checked={showStationsActive} onCheckedChange={toggleStationsActive}/>
                    <Label htmlFor="station_active">Estaciones activas</Label>
                </div>
                <div className="flex items-center space-x-2">
                    <Switch id="station_inactive" checked={showStationsInactive} onCheckedChange={toggleStationsInactive}/>
                    <Label htmlFor="station_inactive">Estaciones inactivas</Label>
                </div>
                <div className="flex items-center space-x-2" >
                    <Switch id="bikes_rentend" checked={showBikesRented} onCheckedChange={toggleBikesRented}/>
                    <Label htmlFor="bikes_rentend">Bicis en alquiler</Label>
                </div>
                <div className="flex items-center space-x-2">
                    <Switch id="slot_incidence" checked={showSlotsIncidence} onCheckedChange={toggleSlotsIncidence}/>
                    <Label htmlFor="slot_incidence">Incidencias Slots</Label>
                </div>
                <div className="flex items-center space-x-2">
                    <Switch id="bike_incidence" checked={showBikesIncidence} onCheckedChange={toggleBikesIncidence}/>
                    <Label htmlFor="bike_incidence">Incidencias Bicis</Label>
                </div>
            </div>
            <Map data={dataValues} />
        </div>
    );

}

export default GraphicView;