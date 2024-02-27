import React, { useState, useEffect } from "react"
import { useParams } from "react-router-dom"
import BikesStationCard from "@/components/client/bikes/BikesStationCard"
import stationIcon from "@/assets/stationIcons/station_icon_app.png"
import { useStations } from "@/hooks/stations/useStations"
import { useSlots } from "@/hooks/slots/useSlots"
import { useBikes } from "@/hooks/bikes/useBikes"
import { useNavigate } from "react-router-dom";
import StationAppView from '@/components/client/stations/StationAppView';


const StationApp = () => {
  const { stationUUID } = useParams();
  const [stationData, setStation] = useState([])
  const [slotsData, setSlots] = useState([])
  const [bikesData, setBikes] = useState([])

  const { stations } = useStations()
  const { bikes } = useBikes()
  const { slots } = useSlots()

  const navigate = useNavigate();

  const navigateIncidents = () => {
    navigate('/reportIncident', {state: {origin: 'station', uuid: stationUUID}});
  };

  useEffect(() => {
    setStation(stations.filter((station) => station.uuid === stationUUID));
  }, [stations, stationUUID])

  useEffect(() => {
    setSlots(slots.filter((slot) => slot.uuid_station == stationUUID));
  }, [slots, stationUUID])

  useEffect(() => {
    const slotsUUID = slotsData.map((slot) => slot.uuid_bike)
    setBikes(bikes.filter((bike) => slotsUUID.includes(bike.uuid)))
  }, [bikes, stationUUID, slotsData])

  const numSlotsDisponibles = slotsData.filter(
    (slot) => slot.status === "FREE"
  ).length
  const numSlotsTotal = slotsData.length

  const viewData = stationData[0] ? (
    <>
      <h2 className="text-xl font-bold text-gray-800">
        {stationData[0].name}{" "}
      </h2>
      <p className="text-gray-500 mb-4">{stationData[0].description}</p>

      <div className="flex justify-between items-start mb-4">
        <div className="flex flex-col items-center mr-4">
          <img src={stationIcon} alt="Icono" className="h-16 w-16 mb-1" />
          <span className="bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded-full">
            {numSlotsDisponibles}/{numSlotsTotal}
          </span>
          <span className="text-xs text-gray-500 mt-1">
            aparcabicicletas disponibles
          </span>
        </div>
        <div className="flex-grow">
          <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mb-2">
            Comenzar navegación
          </button>
          <button className="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
            Reservar
          </button>
        </div>
      </div>

      <div className="border-t border-gray-200">
        {bikesData.length > 0 ? (
          bikesData.map((bike) => (
            <BikesStationCard key={bike.uuid} bike={bike} />
          ))
        ) : (
          <p>No hay bicicletas disponibles</p>
        )}
      </div>
    </>
  ) : (
    <p>Estación no encontrada</p>
  );

  return (
    <StationAppView viewData={viewData} openIssue={navigateIncidents} />
  );
};

export default StationApp;
