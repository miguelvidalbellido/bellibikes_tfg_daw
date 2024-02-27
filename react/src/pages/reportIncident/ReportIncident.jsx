import React, { useState, useEffect, useRef } from 'react';
import './ReportIncident.css';
import {useLocation} from 'react-router-dom';
import { useIncidents } from "@/hooks/incidents/useIncidents";

const ReportIncident = () => {
    const location = useLocation();
    const { origin, uuid } = location.state || {};  
    const { createIncident } = useIncidents();
    const [ typeValue, setTypeValue ] = useState('');
    const [ descriptionValue, setDescriptionValue ] = useState('');

    const hasEffectRun = useRef(false);

    useEffect(() => {
        if (!hasEffectRun.current) {
            if(origin == 'station') {
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
    }, [])

    const confirmIncident = (event) => {
        event.preventDefault();
        const data = {
            type: typeValue ? typeValue : origin == 'station' ? 'station' : 'slot',
            uuid: uuid,
            description: descriptionValue
        }

        createIncident(data);
    };

    return (
        <div className="container-incidents">
            <h2>Reportar Incidencia</h2>
            <form>
            <label htmlFor="tipoIncidencia">Tipo de Incidencia:</label>
            <select disabled={origin == 'station'} id="tipoIncidencia" name="tipoIncidencia" 
            required value={typeValue}
            onChange={(e) => setTypeValue(e.target.value)}>
                {origin == 'station' && <option value="station">Estación</option>}
                <option value="slot">Slot</option>
                <option value="bike">Bici</option>
            </select>

            <label htmlFor="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required
            value={descriptionValue}
            onChange={(e) => setDescriptionValue(e.target.value)}></textarea>

            <button onClick={confirmIncident}>Confirmar Incidencia</button>
            </form>
        </div>
    );
}

export default ReportIncident;
