import React, { useState, useEffect } from "react";
import { useIncidentStages } from "@/hooks/incidentStages/useIncidentStages";

function getStatusClass(status) {
  switch (status) {
    case "NUEVA":
      return "bg-blue-100 border-blue-500 text-blue-800 border-l-4";
    case "EN_PROCESO":
      return "bg-yellow-100 border-yellow-500 text-yellow-800 border-l-4";
    case "RESUELTA":
      return "bg-green-100 border-green-500 text-green-800 border-l-4";
    case "CERRADA":
      return "bg-gray-100 border-gray-500 text-gray-800 border-l-4";
    default:
      return "border-l-4 border-gray-300";
  }
}

const IncidentModal = ({ isOpen, onClose, incident }) => {
  const [newStage, setNewStage] = useState("");
  const [comment, setComment] = useState("");
  const { incidentStages, getStagesFromIncident, createIncidentStage } = useIncidentStages();

  useEffect(() => {
    if (incident) {
      getStagesFromIncident(incident.uuid);
    }
  }, [incident]);

  if (!isOpen) return null;

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log(newStage, comment);
    createIncidentStage({
      "uuid_incident": incident.uuid,
      "status": newStage,
      "comment": comment
    })

    getStagesFromIncident(incident.uuid);


  };

  return (
    <div className="fixed z-10 inset-0 overflow-y-auto">
      <div className="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div className="fixed inset-0 transition-opacity" aria-hidden="true">
          <div className="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        {/* Contenido del modal */}
        <div className="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div className="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div className="sm:flex sm:items-start">
              <div className="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                <h3
                  className="text-lg leading-6 font-medium text-gray-900"
                  id="modal-title"
                >
                  Historial de Etapas
                </h3>
                <div className="mt-2">
                  <ul>
                    {incidentStages.length === 0 ? (
                      <li>No hay etapas</li>
                    ) : (
                      incidentStages.map((stage, index) => (
                        <li
                          key={index}
                          className={`py-4 px-2 ${getStatusClass(
                            stage.status
                          )} mb-2 rounded-lg shadow`}
                        >
                          {/* <h3 className="font-bold">Etapa {index + 1}</h3> */}
                          <p>
                            <span className="font-semibold">Fecha:</span>{" "}
                            {new Date(stage.date).toLocaleString()}
                          </p>
                          <p>
                            <span className="font-semibold">Estado:</span>{" "}
                            {stage.status}
                          </p>
                          <p>
                            <span className="font-semibold">Comentario:</span>{" "}
                            {stage.comment}
                          </p>
                          {/* <p><span className="font-semibold">Confirmación del usuario:</span> {stage.user_confirmation ? 'Confirmado' : 'No Confirmado'}</p> */}
                        </li>
                      ))
                    )}
                  </ul>
                </div>
                <form onSubmit={handleSubmit} className="mt-4">
                  <select
                    className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-3"
                    value={newStage}
                    onChange={(e) => setNewStage(e.target.value)}
                  >
                    <option value="">Selecciona un estado</option>
                    <option value="ASIGNADA">ASIGNADA</option>
                    <option value="EN PROCESO">EN PROCESO</option>
                    <option value="EN ESPERA DE PIEZAS">
                      EN ESPERA DE PIEZAS
                    </option>
                    <option value="RESUELTA">RESUELTA</option>
                  </select>
                  <textarea
                    className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Añade un comentario"
                    rows="4"
                    onChange={(e) => setComment(e.target.value)}
                    value={comment}
                  ></textarea>
                  <button
                    type="submit"
                    className="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm"
                  >
                    Añadir Etapa
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div className="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
              onClick={onClose}
              type="button"
              className="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default IncidentModal;
