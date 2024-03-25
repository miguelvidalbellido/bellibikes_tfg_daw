import React, { useState } from "react"
import { useIncidents } from "@/hooks/incidents/useIncidents"
import { useIncidentStages } from "@/hooks/incidentStages/useIncidentStages"
import toast from 'react-hot-toast';

const IncidentsTable = React.lazy(() =>
  import("@/components/IncidentsTable/IncidentsTable")
)

const IncidentStatusList = React.lazy(() =>
  import("@/components/IncidentsStatusList/IncidentsStatusList")
)

const Incidents = () => {

  const { incidents } = useIncidents()
  const { incidentStages, getStagesFromIncident } = useIncidentStages()

  const handleIncidentClick = (uuid) => {
    getStagesFromIncident(uuid)
    toast.success('Incidencia seleccionada.')
  };

  return (
    <div className="container mx-auto flex flex-col md:flex-row">
      {/* Tabla de incidencias */}
      <div className="w-full md:w-full lg:w-3/5 p-4">
        <h2 className="text-xl font-semibold text-gray-800 mb-6">
          Incidencias
        </h2>
        <React.Suspense fallback={<div>Cargando...</div>}>
          {incidents ? (
            <IncidentsTable dataIncidents={incidents} onIncidentClick={handleIncidentClick}/>
          ) : (
            <div>No hay datos</div>
          )}
        </React.Suspense>
      </div>

      {/* Detalles de la incidencia seleccionada */}
      <div className="w-full md:w-full lg:w-2/5 p-4">
            {
              incidentStages ? (
                <React.Suspense fallback={<div>Cargando...</div>}>
                  <IncidentStatusList statuses={incidentStages} />
                </React.Suspense>
              ) : (
                <div>No hay datos</div>
              )
            }
      </div>
    </div>
  )
}

export default Incidents;
