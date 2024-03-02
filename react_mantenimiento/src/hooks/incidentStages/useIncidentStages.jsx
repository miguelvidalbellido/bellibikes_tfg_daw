import { useCallback, useContext, useEffect, useState } from "react";
import IncidentStagesService from '../../services/incidentsStages/IncidentsStages';
import { useNavigate } from "react-router-dom";

export function useIncidentStages() {
    const navigate = useNavigate();

    const [incidentStages, setIncidentStages] = useState([]);


    const getStagesFromIncident = useCallback((data) => {
        IncidentStagesService.getStagesOneIncident(data).then(({ data, status }) => {
            if (status === 200) {
                setIncidentStages(data.incidents)
            };
        }).catch(e => {
            console.error(e);
        });
    }, [navigate]);


    return { incidentStages, setIncidentStages, getStagesFromIncident };
}