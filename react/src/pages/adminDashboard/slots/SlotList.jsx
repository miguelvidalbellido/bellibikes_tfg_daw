import React, { useState } from "react"
import { useSlots } from "@/hooks/slots/useSlots"
import SlotCreate from "./SlotCreate"
import SlotUpdate from "./SlotUpdate"
import SlotDelete from "./SlotDelete"
import useStats from "@/hooks/stats/useStats"

const SlotsList = () => {
    const { slots, setSlots } = useSlots();
    const { statsSlots, getDashboardSlots } = useStats();

    useState(() => {
      getDashboardSlots();
    }, []);

    const tarjetas = [
      { titulo: "Ranuras Totales", descripcion: statsSlots.total_slots },
      { titulo: "Ranuras Libres", descripcion: statsSlots.free_slots },
      { titulo: "Ranuras Ocupadas", descripcion: statsSlots.occupied_slots },
      { titulo: "Ranuras en Mantenimiento", descripcion: statsSlots.maintenance_slots },
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
        <SlotCreate />

        {/* Tabla responsive */}
        <div className="overflow-x-auto shadow-md rounded-lg mt-6">
          <table className="min-w-full table-auto">
            <thead className="bg-emerald-500 text-white">
              <tr>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Status</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Station</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Bike</th>
                <th className="px-6 py-3 text-xs font-medium uppercase tracking-wider">Controls</th>
              </tr>
            </thead>
            <tbody className="bg-white divide-y divide-gray-200">
              {slots.map((item, index) => (
                <tr key={index} className="hover:bg-gray-100">
                  <td className="px-6 py-4 whitespace-nowrap">{item.status}</td>
                  <td className="px-6 py-4 whitespace-nowrap">{item.station_name}</td>
                  <td className="px-6 py-4 whitespace-nowrap">
                    {item.bike_sname ? item.bike_sname : "No bike"}
                  </td>
                  <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <span className="mr-4">
                      <SlotUpdate data={item} />
                    </span>
                    <span>
                      <SlotDelete uuid={item.uuid}/>
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

export default SlotsList