import React, { useState, useEffect, useRef } from 'react';
import { useLocation, useNavigate } from 'react-router-dom';
import { useIncidents } from "@/hooks/incidents/useIncidents";
import Lottie from 'react-lottie';
import animationData from '@/assets/animations/incident.json'; 

const ReportIncident = () => {
    const location = useLocation();
    const { origin, uuid } = location.state || {};
    const { createIncident } = useIncidents();
    const navigate = useNavigate();
    const [typeValue, setTypeValue] = useState('');
    const [descriptionValue, setDescriptionValue] = useState('');

    const hasEffectRun = useRef(false);

    useEffect(() => {
        if (!hasEffectRun.current) {
            if(origin === 'station') {
                const reloadPage = localStorage.getItem('reload');
                if(reloadPage) {
                    localStorage.removeItem('reload');
                    window.location.reload();
                } else {
                    localStorage.setItem('reload', true);
                }
            }
            hasEffectRun.current = true;
        }
    }, [origin]);

    const confirmIncident = (event) => {
        event.preventDefault();
        const data = {
            type: typeValue ? typeValue : origin === 'station' ? 'station' : 'slot',
            uuid: uuid,
            description: descriptionValue
        };

        createIncident(data);
    };

    // Configuración predeterminada para la animación Lottie
    const defaultOptions = {
        loop: true,
        autoplay: true,
        animationData: animationData,
        rendererSettings: {
            preserveAspectRatio: 'xMidYMid slice'
        }
    };

    return (
        <div className="container mx-auto px-4">
            <button onClick={() => navigate('/')} className="absolute top-0 right-0 mt-4 mr-4 text-2xl font-bold text-redd-500">
                X
            </button>
            <h2 className="text-2xl font-semibold text-center mb-4 mt-6">Reportar Incidencia</h2>
             
            <div className="flex justify-center my-8">
                <Lottie options={defaultOptions} height={150} width={150} />
            </div>
            <form className="max-w-md mx-auto">
                <div className="mb-4">
                    <label htmlFor="tipoIncidencia" className="block text-gray-700 text-sm font-bold mb-2">
                        Tipo de Incidencia:
                    </label>
                    <select disabled={origin === 'station'}
                        id="tipoIncidencia"
                        name="tipoIncidencia"
                        required
                        value={typeValue}
                        onChange={(e) => setTypeValue(e.target.value)}
                        className="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        {origin === 'station' && <option value="station">Estación</option>}
                        <option value="slot">Slot</option>
                        <option value="bike">Bici</option>
                    </select>
                </div>

                <div className="mb-6">
                    <label htmlFor="descripcion" className="block text-gray-700 text-sm font-bold mb-2">
                        Descripción:
                    </label>
                    <textarea id="descripcion"
                        name="descripcion"
                        rows="4"
                        required
                        value={descriptionValue}
                        onChange={(e) => setDescriptionValue(e.target.value)}
                        className="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>

                <div className="flex justify-center">
                    <button onClick={confirmIncident}
                            className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Confirmar Incidencia
                    </button>
                </div>

            </form>
        </div>
    );
}

export default ReportIncident;
