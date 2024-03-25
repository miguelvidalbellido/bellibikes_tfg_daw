import React from 'react';

const IncidentStages = ({ stages }) => {
    if (!stages || stages.length === 0) {
        return (
            <div className="mt-4 p-4 bg-gray-100 rounded-lg text-center">
                <span className="text-sm text-gray-500">No hay etapas para mostrar</span>
            </div>
        );
    }

    return (
        <div className="mt-4 p-4 bg-white shadow rounded-lg">
            <h3 className="text-lg leading-6 font-medium text-gray-900">Etapas de la Incidencia</h3>
            <div className="mt-2">
                {stages.map((stage) => (
                    <div key={stage.id} className="mt-2 p-3 bg-gray-50 rounded-lg">
                        <div className="text-sm text-gray-800">Fecha: {new Date(stage.date).toLocaleString()}</div>
                        <div className="text-sm text-gray-800">Estado: {stage.status}</div>
                        <div className="text-sm text-gray-800">Comentario: {stage.comment}</div>
                        {/* <div className="text-sm text-gray-800">Confirmación de usuario: {stage.user_confirmation ? 'Sí' : 'No'}</div> */}
                    </div>
                ))}
            </div>
        </div>
    );
};

export default IncidentStages;
