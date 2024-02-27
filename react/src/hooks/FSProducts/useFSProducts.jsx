import { useCallback, useContext, useState } from "react"
import FSProductsContext from "@/context/FS_products/FSProducts"
import FsService from '../../services/FS/FsService'
import { useToast } from '@/components/ui/use-toast'

export function useFSProducts() {
    const { fsProducts, setFSProducts } = useContext(FSProductsContext);
    const { toast } = useToast()
    const [ checkDataPlan, setCheckDataPlan ] = useState({})

    const addPlanUser = useCallback(data => {
        FsService.addProduct(data)
            .then(({ data, status }) => {
                console.log(data);
                console.log(status);

                if (status === 201) {
                    toast({
                        title: 'Tu plan se ha añadido correctamente!!',
                        description: `Recibiras la factura en tu correo electronico cuando finalice su plan`,
                        status: 'success',
                        duration: 5000
                    })
                }
            })
            .catch(e => {
                console.error(e);
            });
    
    }, [])

    const checkUserPlan = useCallback(data => {
        FsService.checkDataPlan(data)
            .then(({ data, status }) => {
                if (status === 200) {
                    const data_plan = (JSON.parse(data))[0].fields;
                    setCheckDataPlan(data_plan);
                }

                if (status === 204) {
                    toast({
                        title: 'Advertencia',
                        description: `Tu usuario no tiene un plan. El alquiler se facturará en función del tiempo utilizado`,
                        status: 'success',
                        duration: 5000
                    })
                }
            })
            .catch(e => {
                console.error(e);
            });
    
    }, [])


    return {fsProducts, setFSProducts, addPlanUser, checkDataPlan, setCheckDataPlan, checkUserPlan}
}