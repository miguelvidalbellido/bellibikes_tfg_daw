import { useCallback, useContext, useEffect, useState } from "react";
import IncidentContext from "../../context/Incident/IncidentContext";
import IncidentService from '../../services/incidents/IndicentService';
import { useNavigate } from "react-router-dom";

export function useIncidents() {
    const navigate = useNavigate();
    const { incidents, setIncidents } = useContext(IncidentContext);

    const createIncident = useCallback((data) => {
        IncidentService.addIncident(data).then(({ data, status }) => {
            if (status === 201) {
                navigate('/');
            }
        }).catch(e => {
            console.error(e);
        });
    }, [navigate]);

    return { incidents, setIncidents, createIncident };
}