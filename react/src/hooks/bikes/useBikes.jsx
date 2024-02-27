import { useCallback, useContext, useState } from "react"
import BikesContext from "../../context/Bikes/BikesContext";
import { useToast } from '@/components/ui/use-toast';
import BikeService from '../../services/bikes/BikeService';
import { useNavigate, useLocation } from "react-router-dom";

export function useBikes() {
    const navigate = useNavigate();
    const { bikes, setBikes } = useContext(BikesContext);
    const { toast } = useToast();
    const [ bikeAvailable, setBikeAvailable ] = useState(false);

    const useCreateBike = useCallback(data => {
        BikeService.addBike(data)
            .then(({ data, status }) => {
                if (status === 201) {
                    toast({
                        title: 'Bici creada correctamente',
                        description: `Bici ${data.bike.sname} creada correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    setBikes([...bikes, data.bike]);
                    navigate('/dashboard')
                }
            })
            .catch(e => {
                console.error(e);
                toast({
                    title: 'Ha ocurrido un error',
                    description: `No se ha podido crear la bici`,
                    status: 'error',
                    duration: 5000
                })
            });
    }, [bikes]);

    const useUpdateBike = useCallback((data) => {
        const uuid = data.uuid;
        BikeService.updateBike(uuid, data)
            .then(({ data, status }) => {
                if (status === 200) {
                    let oldBikes = [...bikes];
                    const index = oldBikes.findIndex(bike => bike.uuid === uuid);
                    oldBikes[index] = data;
                    setBikes(oldBikes);
                    toast({
                        title: 'Bici actualizada correctamente',
                        description: `Bici ${data.sname} actualizada correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    navigate('/dashboard')
                }
            })
    }, [bikes]);

    const useDeleteBike = useCallback((uuid) => {
        BikeService.deleteBike(uuid)
            .then(({ data, status }) => {
                if (status === 200) {
                    let oldBikes = [...bikes];
                    const index = oldBikes.findIndex(bike => bike.uuid === uuid);
                    oldBikes.splice(index, 1);
                    setBikes(oldBikes);
                    toast({
                        title: 'Bici eliminada correctamente',
                        description: `Bici eliminada correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    navigate('/dashboard')
                }
            })
    }, [bikes]);

    const useCheckBike = useCallback(data => {
        BikeService.checkBike(data)
            .then(({ data, status }) => {
                console.log(data);
                if (status === 200 && data.available) {
                    toast({
                        title: 'Bici comprobada correctamente',
                        description: `Bici comprobada correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    setBikeAvailable(true);
                }
            })
            .catch(e => {
                console.error(e);
                toast({
                    title: 'Ha ocurrido un error',
                    description: `No se ha podido comprobar la bici`,
                    status: 'error',
                    duration: 5000
                })
            });
    }, []);

    return {bikes, setBikes, useCreateBike, useUpdateBike, useDeleteBike, useCheckBike, bikeAvailable};
}