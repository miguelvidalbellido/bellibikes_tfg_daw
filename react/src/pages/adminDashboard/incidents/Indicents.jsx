import React, { useState } from "react";
import IncidentCard from '@/components/admin/incidentCard/IncidentCard'
import { useIncidents } from "@/hooks/incidents/useIncidents";

const Incidents = () => {
  const { incidents } = useIncidents();
  const [currentPage, setCurrentPage] = useState(1);
  const [incidentFilter, setIncidentFilter] = useState('Todas');
  const itemsPerPage = 6;

  const filteredIncidents = incidents.filter(incident => {
    if (incidentFilter === 'Todas') {
      return true;
    }
    return incident.status == incidentFilter;
  });

  const totalPages = Math.ceil(filteredIncidents.length / itemsPerPage);


  const currentItems = filteredIncidents.slice((currentPage - 1) * itemsPerPage, currentPage * itemsPerPage);

 
  const setPage = (page) => {
    setCurrentPage(page);
  };

  const setFilter = (filter) => {
    setIncidentFilter(filter);
    setCurrentPage(1);
  };

  return (
    <div className="bg-gray-100 w-full">
      <div className="bg-white shadow-md p-4 mb-6">
        <div className="max-w-7xl mx-auto flex justify-end space-x-2">
          <button onClick={() => setFilter('Todas')} className="text-sm bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-150 ease-in-out">
            Todas
          </button>
          <button onClick={() => setFilter('NUEVA')} className="text-sm bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition duration-150 ease-in-out">
            Nuevas
          </button>
          <button onClick={() => setFilter('EN PROCESO')} className="text-sm bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition duration-150 ease-in-out">
          EN PROCESO
          </button>
          <button onClick={() => setFilter('RESUELTA')} className="text-sm bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded transition duration-150 ease-in-out">
          RESUELTAS
          </button>
        </div>
      </div>

      <div className="p-4">
        <div className="max-w-7xl mx-auto">
          {currentItems.length > 0 ? (
            currentItems.map((incident, index) => (
              <IncidentCard key={index} incident={incident} />
            ))
          ) : (
            <p>No hay...</p>
          )}
        </div>
      </div>

      <div className="flex justify-center space-x-2 my-4">
        {Array.from({ length: totalPages }, (_, i) => i + 1).map((number) => (
          <button
            key={number}
            onClick={() => setPage(number)}
            className={`text-sm px-4 py-2 rounded transition duration-150 ease-in-out ${currentPage === number ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800'}`}
          >
            {number}
          </button>
        ))}
      </div>
    </div>
  );
};

export default Incidents;
