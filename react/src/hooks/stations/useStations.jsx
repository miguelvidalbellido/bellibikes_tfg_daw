import { useCallback, useContext, useState, useEffect } from "react"
import StationService from '../../services/stations/StationService';
import { useNavigate, useLocation } from "react-router-dom";
import StationContext from "../../context/Stations/StationsContext";
import { useToast } from '@/components/ui/use-toast'

export function useStations() {
    const navigate = useNavigate();
    const { pathname } = useLocation();
    const { stations, setStations } = useContext(StationContext);
    const { toast } = useToast()

    const useCreateStation = useCallback(data => {
        StationService.addStation(data)
            .then(({ data, status }) => {
                if (status === 201) {
                    toast({
                        title: 'Estación creada correctamente',
                        description: `Estación ${data.station.name} creada correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    setStations([...stations, data.station]);
                    navigate('/dashboard')
                }
            })
            .catch(e => {
                console.error(e);
                toast({
                    title: 'Ha ocurrido un error',
                    description: `No se ha podido crear la estación`,
                    status: 'error',
                    duration: 5000
                })
            });
    }, [stations]);

    const useUpdateStation = useCallback((data) => {
        const uuid = data.uuid;
        StationService.updateStation(uuid, data)
            .then(({ data, status }) => {
                if (status === 200) {
                    let oldStations = [...stations];
                    const index = oldStations.findIndex(station => station.uuid === uuid);
                    oldStations[index] = data;
                    setStations(oldStations);
                    toast({
                        title: 'Estación actualizada correctamente',
                        description: `Estación ${data.name} actualizada correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    navigate('/dashboard')
                }
            })
    }, [stations]);

    const useDeleteStation = useCallback((uuid) => {
        StationService.deleteStation(uuid)
            .then(({ data, status }) => {
                if (status === 204) {
                    let oldStations = [...stations];
                    const index = oldStations.findIndex(station => station.uuid === uuid);
                    oldStations.splice(index, 1);
                    setStations(oldStations);
                    toast({
                        title: 'Estación eliminada correctamente',
                        description: `Estación eliminada correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    navigate('/dashboard')
                }
            })
    }, [stations]);

    return {stations, setStations, useCreateStation, useUpdateStation, useDeleteStation};
}