import { useCallback, useContext, useEffect, useState } from "react";
import IncidentContext from "../../context/Incident/IncidentContext";
import { useToast } from '@/components/ui/use-toast';
import IncidentService from '../../services/incidents/IndicentService';
import { useNavigate } from "react-router-dom";

export function useIncidents() {
    const navigate = useNavigate();
    const { incidents, setIncidents } = useContext(IncidentContext);
    const { toast } = useToast();

    const createIncident = useCallback((data) => {
        IncidentService.addIncident(data).then(({ data, status }) => {
            if (status === 201) {
                toast({
                    title: 'Cambios realizados',
                    description: 'Se ha creado la incidencia correctamente',
                    status: 'success',
                    duration: 5000
                });

                navigate('/');
            }
        }).catch(e => {
            console.error(e);
            toast({
                title: 'Ha ocurrido un error',
                description: 'No se ha podido crear la incidencia',
                status: 'error',
                duration: 5000
            });
        });
    }, [navigate, toast]);

    return { incidents, setIncidents, createIncident };
}