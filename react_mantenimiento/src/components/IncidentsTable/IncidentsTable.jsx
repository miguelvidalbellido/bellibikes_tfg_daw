import React, { useState } from "react";

const IncidentsTable = ({ dataIncidents, onIncidentClick }) => {
  //// PAGINACION ////
  const [currentPage, setCurrentPage] = useState(0);
  const incidentsPerPage = 8;
  const pageCount = Math.ceil(dataIncidents.length / incidentsPerPage);

  const currentIncidents = dataIncidents.slice(
    currentPage * incidentsPerPage,
    (currentPage + 1) * incidentsPerPage
  );

  const goToNextPage = () => {
    setCurrentPage((page) => Math.min(page + 1, pageCount - 1));
  };

  const goToPreviousPage = () => {
    setCurrentPage((page) => Math.max(page - 1, 0));
  };

  const goToPage = (pageNumber) => {
    setCurrentPage(pageNumber);
  };

  //// FORMATO DE FECHA ////
  const formatDate = (dateString) => {
    const options = {
      year: "numeric",
      month: "2-digit",
      day: "2-digit",
      hour: "2-digit",
      minute: "2-digit",
      hour12: false,
    };
    return new Intl.DateTimeFormat("es", options).format(new Date(dateString));
  };

  return (
    <div className="overflow-x-auto overflow-y-hidden shadow-md sm:rounded-lg">
      <table className="min-w-full text-sm divide-y divide-gray-200">
        <thead className="bg-gray-50">
          <tr>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-normal">
              Tipo
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-normal">
              Descripción
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-normal">
              Estado
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-normal">
              Fecha
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-normal">
              Acciones
            </th>
          </tr>
        </thead>
        <tbody className="bg-white divide-y divide-gray-200">
          {currentIncidents.map((incident, index) => (
            <tr key={index} className="hover:bg-gray-50">
              <td className="px-6 py-4 whitespace-nowrap">
                {incident.incident_type}
              </td>
              <td className="px-6 py-4 whitespace-nowrap">
                {incident.description}
              </td>
              <td className="px-6 py-4 whitespace-nowrap">{incident.status}</td>
              <td className="px-6 py-4 whitespace-nowrap">
                {formatDate(incident.date)}
              </td>
              <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button
                  onClick={() => onIncidentClick(incident.uuid)}
                  className="px-4 py-2 text-white bg-orange-600 hover:bg-orange-700 rounded"
                >
                  Ver detalles
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
      <div className="flex justify-center items-center mt-4 space-x-2 mb-10">
        <button
          onClick={goToPreviousPage}
          className="px-4 py-2 text-black bg-orange-300 hover:bg-orange-400 rounded disabled:opacity-50"
          disabled={currentPage === 0}
        >
          &lt;
        </button>

        <span className="px-4 py-2 text-black bg-gray-200 rounded">
          {currentPage + 1} / {pageCount}
        </span>

        <button
          onClick={goToNextPage}
          className="px-4 py-2 text-black bg-orange-300 hover:bg-orange-400 rounded disabled:opacity-50"
          disabled={currentPage === pageCount - 1}
        >
          &gt;
        </button>
      </div>
    </div>
  );
};

export default IncidentsTable;
