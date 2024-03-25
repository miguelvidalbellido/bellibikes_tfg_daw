import { useCallback, useContext, useEffect, useState } from "react";
import IncidentStagesService from '../../services/incidentsStages/IncidentsStages';
import { useNavigate } from "react-router-dom";
import toast from 'react-hot-toast'

export function useIncidentStages() {
    const navigate = useNavigate();

    const [incidentStages, setIncidentStages] = useState([]);


    const getStagesFromIncident = useCallback((data) => {
        IncidentStagesService.getStagesOneIncident(data).then(({ data, status }) => {
            if (status === 200) {
                setIncidentStages(data.incidents)
            };
        }).catch(e => {
            console.error(e)
        });
    }, [navigate])

    const createIncidentStage = useCallback((data) => {
        console.log(data)
        IncidentStagesService.addStage(data).then(({ data, status }) => {
            console.log(data)
            if (status === 201) {
                toast.success('Se ha creado la etapa correctamente')
            }
        }).catch(e => {
            console.error(e)
            toast.error('No se ha podido crear la etapa')
        });
    }, []);


    return { incidentStages, setIncidentStages, getStagesFromIncident, createIncidentStage };
}