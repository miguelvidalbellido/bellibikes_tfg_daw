import React, { useState } from "react";
import { useBikes } from "@/hooks/bikes/useBikes";
import BikeCreate from "./BikeCreate";
import BikeUpdate from "./BikeUpdate";
import BikeDelete from "./BikeDelete";
import useStats from "@/hooks/stats/useStats"

const BikesList = () => {
    const { bikes, setBikes } = useBikes();
    const { statsBikes, getDashboardBikes } = useStats()

    useState(() => {
        getDashboardBikes();
    }, [])
    

    const tarjetas = [
        { titulo: "Cantidad de Bicis", descripcion: statsBikes.total_bikes },
        { titulo: "Bicis Libres", descripcion: statsBikes.free_bikes },
        { titulo: "Bicis Estacionadas", descripcion: statsBikes.occupied_bikes },
        { titulo: "Bicis con Incidencias", descripcion: statsBikes.maintenance_bikes },
    ];

    return(
        <>
        {/* Tarjetas horizontales al estilo de la imagen proporcionada */}
        <div className="flex justify-between mb-4 space-x-4">
          {tarjetas.map((card, index) => (
            <div key={index} className="w-1/4 bg-white shadow rounded-lg p-4 flex flex-col items-center justify-center">
              <h3 className="text-sm font-semibold text-gray-700">{card.titulo}</h3>
              <p className="text-lg font-bold text-gray-900">{card.descripcion}</p>
            </div>
          ))}
        </div>

        {/* Botón crear */}
        <BikeCreate />

        {/* Tabla responsive */}
        <div className="overflow-x-auto shadow-md rounded-lg mt-6">
          <table className="min-w-full table-auto">
            <thead className="bg-emerald-500 text-white">
              <tr>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Serial Name</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Status</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Model</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Controls</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {bikes.map((item, index) => (
                <tr key={index} className="hover:bg-gray-100">
                  <td className="px-6 py-4 whitespace-nowrap">{item.sname}</td>
                  <td className="px-6 py-4 whitespace-nowrap">{item.status}</td>
                  <td className="px-6 py-4 whitespace-nowrap">{item.model}</td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <span className="mr-4">
                      <BikeUpdate data={item} />
                    </span>
                    <span>
                      <BikeDelete uuid={item.uuid}/>
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

export default BikesList;
