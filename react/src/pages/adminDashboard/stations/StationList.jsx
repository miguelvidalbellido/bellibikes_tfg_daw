import React, { useState } from "react"
import { useStations } from "@/hooks/stations/useStations"
import StationUpdate from "./StationUpdate"
import StationCreate from "./StationCreate"
import StationDelete from "./StationDelete"
import useStats from "@/hooks/stats/useStats"

const StationList = () => {
    const { stations, setStations } = useStations();
    const { statsStations, getDashboardStations } = useStats();

    useState(() => {
      getDashboardStations();
    }, []);

    const tarjetas = [
      { titulo: "Total estaciones", descripcion: statsStations.stations },
      { titulo: "Estaciones Activas", descripcion: statsStations.stationsOpen },
      { titulo: "Estaciones Mantenimiento", descripcion: statsStations.stationsMaintenance },
      { titulo: "Estaciones Cerradas", descripcion: statsStations.stationsClose },
  ];

    return(
        <>
        {/* Tarjetas horizontales */}
        <div className="flex justify-between mb-4 space-x-4">
          {tarjetas.map((card, index) => (
            <div key={index} className="w-1/4 bg-white shadow rounded-lg p-4 flex flex-col items-center justify-center">
              <h3 className="text-sm font-semibold text-gray-700">{card.titulo}</h3>
              <p className="text-lg font-bold text-gray-900">{card.descripcion}</p>
            </div>
          ))}
        </div>

        {/* Botón crear */}
        <StationCreate />

        {/* Tabla responsive */}
        <div className="overflow-x-auto shadow-md rounded-lg mt-6">
          <table className="min-w-full table-auto">
            <thead className="bg-emerald-500 text-white">
              <tr>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Nombre</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Descripción</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Status</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Controls</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {stations.map((item, index) => (
                <tr key={index} className="hover:bg-gray-100">
                  <td className="px-6 py-4 whitespace-nowrap">{item.name}</td>
                  <td className="px-6 py-4 whitespace-nowrap">{item.description}</td>
                  <td className="px-6 py-4 whitespace-nowrap">{item.status}</td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <span className="mr-4">
                      <StationUpdate data={item} />
                    </span>
                    <span>
                      <StationDelete uuid={item.uuid}/>
                    </span>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
        </>
    )
}

export default StationList