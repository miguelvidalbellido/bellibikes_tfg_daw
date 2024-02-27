import SlotForm from "./SlotForm"
import { useSlots } from "@/hooks/slots/useSlots"

const DialogCreateSlots = () => {
    const { useCreateSlot } = useSlots();
    
    return (
        <SlotForm sendData={(data) => useCreateSlot(data)}/>
    )
}


export default DialogCreateSlots