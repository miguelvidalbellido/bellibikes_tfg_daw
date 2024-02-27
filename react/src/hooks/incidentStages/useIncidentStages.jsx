import { useCallback, useContext, useEffect, useState } from "react";
import IncidentStagesContext from "../../context/IncidentStages/IncidentStages";
import { useToast } from '@/components/ui/use-toast';
import IncidentStagesService from '../../services/incidentsStages/IncidentsStages';
import { useNavigate } from "react-router-dom";

export function useIncidentStages() {
    const navigate = useNavigate();
    // const { incidentStages, setIncidentStages } = useContext(IncidentStagesContext);
    const [incidentStages, setIncidentStages] = useState([]);
    const [notifyUser, setNotifyUser] = useState([])
    const { toast } = useToast();

    const getStagesFromIncident = useCallback((data) => {
        IncidentStagesService.getStagesOneIncident(data).then(({ data, status }) => {
            if (status === 200) setIncidentStages(data.incidents);
        }).catch(e => {
            console.error(e);
            toast({
                title: 'Ha ocurrido un error',
                description: 'No se ha podido recoger la información de la etapa',
                status: 'error',
                duration: 5000
            });
        });
    }, [navigate, toast]);

    const createIncidentStage = useCallback((data) => {
        console.log(data);
        IncidentStagesService.addStage(data).then(({ data, status }) => {
            console.log(data);
            if (status === 201) {
                toast({
                    title: 'Cambios realizados',
                    description: 'Se ha creado la etapa correctamente',
                    status: 'success',
                    duration: 5000
                });

                // navigate('/');
            }
        }).catch(e => {
            console.error(e);
            toast({
                title: 'Ha ocurrido un error',
                description: 'No se ha podido crear la etapa',
                status: 'error',
                duration: 5000
            });
        });
    }, [navigate, toast]);

    const getNotifysUser = useCallback(() => {
        IncidentStagesService.getStagesUser().then(({ data, status }) => {
            setNotifyUser(data.incidents)
        }).catch(e => {
            console.error(e);
            toast({
                title: 'Ha ocurrido un error',
                description: 'No se ha podido crear la etapa',
                status: 'error',
                duration: 5000
            });
        });
    }, [incidentStages])

    const checkView = useCallback((uuid) => {
        IncidentStagesService.checkVeiw({"uuid": uuid}).then(({ data, status }) => {
            getNotifysUser()
        }).catch(e => {
            console.error(e);
            toast({
                title: 'Ha ocurrido un error',
                description: 'No se ha podido crear la etapa',
                status: 'error',
                duration: 5000
            });
        });
    })


    return { incidentStages, setIncidentStages, getStagesFromIncident, createIncidentStage, getNotifysUser, notifyUser, checkView };
}