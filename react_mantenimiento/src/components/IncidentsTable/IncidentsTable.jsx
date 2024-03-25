import React, { useState, useEffect } from "react";

const IncidentsTable = ({ dataIncidents, onIncidentClick }) => {
  // Estados para los filtros
  const [filteredIncidents, setFilteredIncidents] = useState(dataIncidents);
  const [filterType, setFilterType] = useState("")
  const [filterStatus, setFilterStatus] = useState("")
  const [sortOrder, setSortOrder] = useState("asc")

  const tipos = [
    { value: "", label: "Todos los tipos" },
    { value: "station", label: "Estación" },
    { value: "slot", label: "Ranura" },
    { value: "bike", label: "Bicicleta" },
  ]

  const statusIncident = [
        { value: '', label: 'Todos los estados' },
        { value: 'NUEVA', label: 'NUEVA'},
        { value: 'ASIGNADA', label: 'ASIGNADA' },
        { value: 'EN PROCESO', label: 'EN PROCESO' },
        { value: 'EN ESPERA DE PIEZAS', label: 'EN ESPERA DE PIEZAS' },
        { value: 'FINALIZADA', label: 'FINALIZADA' }
    ]

  // PAGINACION
  const [currentPage, setCurrentPage] = useState(0);
  const incidentsPerPage = 8;
  const pageCount = Math.ceil(filteredIncidents.length / incidentsPerPage)

  useEffect(() => {
    let incidents = dataIncidents

    if (filterType) {
      incidents = incidents.filter((incident) => incident.incident_type === filterType)
    }

    if (filterStatus) {
      incidents = incidents.filter((incident) => incident.status === filterStatus)
    }

    if (sortOrder === "asc") {
      incidents.sort((a, b) => new Date(a.date) - new Date(b.date))
    } else {
      incidents.sort((a, b) => new Date(b.date) - new Date(a.date))
    }

    setFilteredIncidents(incidents);
    setCurrentPage(0)
  }, [dataIncidents, filterType, filterStatus, sortOrder]);

  const currentIncidents = filteredIncidents.slice(
    currentPage * incidentsPerPage,
    (currentPage + 1) * incidentsPerPage
  )

  const goToNextPage = () => {
    setCurrentPage((page) => Math.min(page + 1, pageCount - 1))
  }

  const goToPreviousPage = () => {
    setCurrentPage((page) => Math.max(page - 1, 0))
  }

  // FORMATO DE FECHA
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

  const typeLanguageConvert = (type) => {
    const value = tipos.filter((type_arr) => type_arr.value === type)
    if (value.length > 0) return value[0].label
    if (value.length === 0) return type
  }

  return (
    <div className="overflow-x-auto overflow-y-hidden shadow-md sm:rounded-lg">
      <div className="p-4 flex gap-4 bg-white shadow rounded-lg justify-around">
      <select
        value={filterType}
        onChange={(e) => setFilterType(e.target.value)}
        className="p-2 rounded-lg border border-gray-200 text-gray-700 focus:ring-orange-500 focus:border-orange-500"
        >
          {tipos.map((tipo, index) => (
            <option key={index} value={tipo.value}>{tipo.label}</option>
          ))}
      </select>
      <select
        value={filterStatus}
        onChange={(e) => setFilterStatus(e.target.value)}
        className="p-2 rounded-lg border border-gray-200 text-gray-700 focus:ring-orange-500 focus:border-orange-500"
      >
          {statusIncident.map((status, index) => (
            <option key={index} value={status.value}>{status.label}</option>
          ))}
      </select>
      <select
        value={sortOrder}
        onChange={(e) => setSortOrder(e.target.value)}
        className="p-2 rounded-lg border border-gray-200 text-gray-700 focus:ring-orange-500 focus:border-orange-500"
      >
        <option value="asc">Fecha Ascendente</option>
        <option value="desc">Fecha Descendente</option>
      </select>
    </div>
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
                {typeLanguageConvert(incident.incident_type)}
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
