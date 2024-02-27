import { useCallback, useContext, useEffect, useState } from "react";
import RentContext from "../../context/Rent/RentContext";
import { useToast } from '@/components/ui/use-toast';
import RentService from '../../services/rent/RentService';
import { useNavigate } from "react-router-dom";

export function useRent() {
    const navigate = useNavigate();
    const { rents, setRents, setActiveRentUser, activeRentUser } = useContext(RentContext);
    const { toast } = useToast();
    const [rentDetails, setRentDetails] = useState({});

    const createRent = useCallback((data) => {
        RentService.addRent(data).then(({ data, status }) => {
            if (status === 201) {
                toast({
                    title: 'Cambios realizados',
                    description: 'Se ha alquilado la bici correctamente',
                    status: 'success',
                    duration: 5000
                });

                setActiveRentUser(data.rent.uuid);

                navigate(`/rentView/${data.rent.uuid}`);
            }
        }).catch(e => {
            console.error(e);
            toast({
                title: 'Ha ocurrido un error',
                description: 'No se ha podido alquilar la bici',
                status: 'error',
                duration: 5000
            });
        });
    }, [setActiveRentUser, navigate, toast]);

    const getDataRent = useCallback((uuid) => {
        RentService.getRent(uuid).then(({ data, status }) => {
            if (status === 200) {
                setRentDetails(data);
            }
        }).catch(e => {
            console.error(e);
        });
    });

    return { rents, setRents, createRent, getDataRent, rentDetails };
}
