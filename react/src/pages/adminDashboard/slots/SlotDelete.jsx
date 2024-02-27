import { Button } from "@/components/ui/button"
import { useSlots } from "@/hooks/slots/useSlots";

const deleteSlot = ({uuid}) => {
    const { useDeleteSlot } = useSlots();
    const handleDeleteClick = () => {
        useDeleteSlot(uuid);
    };
    return (
        <Button variant="destructive" onClick={handleDeleteClick}>Eliminar</Button>
    )
}

export default deleteSlot