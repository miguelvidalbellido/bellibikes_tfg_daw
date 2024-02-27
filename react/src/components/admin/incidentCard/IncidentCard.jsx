import React, { useState } from 'react';
import IncidentModal from '../incidentModal/IncidentModal'; // Asegúrate de importar tu componente Modal correctamente

const IncidentCard = ({ incident }) => {
    const [isModalOpen, setIsModalOpen] = useState(false);

    // Mapeos de colores para el texto y la tarjeta basados en el estado de la incidencia
    const statusColorMappingText = {
      'NUEVA': 'text-green-700',
      'EN PROCESO': 'text-yellow-700',
      'EN ESPERA DE PIEZAS': 'text-red-700',
      'RESUELTA': 'text-blue-700'
    };

    const statusColorMappingCard = {
      'NUEVA': 'border-green-500',
      'EN PROCESO': 'border-yellow-500',
      'EN ESPERA DE PIEZAS': 'border-red-500',
      'RESUELTA': 'border-blue-500'
    };

    const statusClassText = statusColorMappingText[incident.status] || 'bg-gray-500';
    const statusClassCard = statusColorMappingCard[incident.status] || 'bg-gray-500';

    // Función para manejar la apertura del modal
    const handleOpenModal = () => {

      setIsModalOpen(true)
    };

    return (
        <>
        <div className={`${statusClassCard} bg-white shadow-lg rounded-lg p-6 mb-4 border-l-4`}>
            <div className="flex justify-between items-center">
              <div>
                <p className={`${statusClassText} text-lg font-semibold`}>
                  Incidencia {incident.incident_type}
                </p>
                <p className="text-gray-600">
                  {incident.description}
                </p>
              </div>
              <button 
                onClick={handleOpenModal}
                className="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                Ver Más
              </button>
            </div>
        </div>

        {/* Modal para ver más detalles */}
        <IncidentModal isOpen={isModalOpen} onClose={() => setIsModalOpen(false)} incident={incident} />
        </>
    );
};

export default IncidentCard;
