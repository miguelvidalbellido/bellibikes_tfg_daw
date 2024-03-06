import React from 'react';

const IncidentsTable = ({ incidents, onSelectIncident }) => {
    return (
        <div className="overflow-x-auto">
            <table className="min-w-full leading-normal">
                <thead className="bg-gray-100">
                    <tr>
                        <th className="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Fecha
                        </th>
                        <th className="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Tipo
                        </th>
                        <th className="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Descripción
                        </th>
                        <th className="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            Estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {incidents.map((incident) => (
                        <tr key={incident.uuid} className="hover:bg-gray-100 cursor-pointer" onClick={() => onSelectIncident(incident.uuid)}>
                            <td className="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {new Date(incident.date).toLocaleDateString()}
                            </td>
                            <td className="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {incident.incident_type}
                            </td>
                            <td className="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {incident.description}
                            </td>
                            <td className="px-5 py-2 border-b border-gray-200 bg-white text-sm">
                                {incident.status}
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default IncidentsTable;
