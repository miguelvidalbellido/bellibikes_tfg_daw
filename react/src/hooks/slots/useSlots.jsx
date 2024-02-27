import { useCallback, useContext } from "react"
import SlotsContext from "../../context/Slots/SlotsContext";
import { useToast } from '@/components/ui/use-toast';
import SlotService from '../../services/slots/SlotService';
import { useNavigate, useLocation } from "react-router-dom";

export function useSlots() {
    const navigate = useNavigate();
    const { slots, setSlots } = useContext(SlotsContext);
    const { toast } = useToast()

    const useCreateSlot = useCallback(data => {
        SlotService.addSlot(data)
            .then(({ data, status }) => {
                if (status === 201) {
                    toast({
                        title: 'Slot creado correctamente',
                        description: `Slot ${data.slot.name} creado correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    setSlots([...slots, data.slot]);
                    navigate('/dashboard')
                }
            })
            .catch(e => {
                if (e.response.status === 400) {
                    toast({
                        title: 'Ha ocurrido un error',
                        description: `La bici ya esta asignada a un slot`,
                        status: 'destructive',
                        duration: 5000
                    })
                } else {
                    toast({
                        title: 'Ha ocurrido un error',
                        description: `No se ha podido crear el slot`,
                        status: 'destructive',
                        duration: 5000
                    })
                }
                
            });
    }, [slots]);

    const useUpdateSlot = useCallback((data) => {
        const uuid = data.uuid;
        SlotService.updateSlot(uuid, data)
            .then(({ data, status }) => {
                if (status === 200) {
                    let oldSlots = [...slots];
                    const index = oldSlots.findIndex(slot => slot.uuid === uuid);
                    oldSlots[index] = data;
                    setSlots(oldSlots);
                    toast({
                        title: 'Slot actualizado correctamente',
                        description: `Slot ${data.name} actualizado correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    navigate('/dashboard')
                }
            }).catch(e => {
                if (e.response.status === 400) {
                    toast({
                        title: 'Ha ocurrido un error',
                        description: `La bici ya esta asignada a un slot`,
                        status: 'destructive',
                        duration: 5000
                    })
                } else {
                    toast({
                        title: 'Ha ocurrido un error',
                        description: `No se ha podido actualizar el slot`,
                        status: 'destructive',
                        duration: 5000
                    })
                }
            })
    }, [slots]);

    const useDeleteSlot = useCallback((uuid) => {
        SlotService.deleteSlot(uuid)
            .then(({ data, status }) => {
                if (status === 200) {
                    let oldSlots = [...slots];
                    const index = oldSlots.findIndex(slot => slot.uuid === uuid);
                    oldSlots.splice(index, 1);
                    setSlots(oldSlots);
                    toast({
                        title: 'Slot eliminado correctamente',
                        description: `Slot eliminado correctamente`,
                        status: 'success',
                        duration: 5000
                    })
                    navigate('/dashboard')
                }
            })
    }, [slots]);

    return {slots, setSlots, useCreateSlot, useUpdateSlot, useDeleteSlot};
}