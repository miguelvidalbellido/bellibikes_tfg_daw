import SlotForm from "./SlotForm"
import { useSlots } from "@/hooks/slots/useSlots"
import { useState } from "react"

const DialogUpdateSlots = ({data}) => {
    const { useUpdateSlot } = useSlots();
    const [ dataValues ] = useState(data)
    
    return (
        <SlotForm sendData={(data) => useUpdateSlot(data)} data={dataValues}/>
    )
}


export default DialogUpdateSlots