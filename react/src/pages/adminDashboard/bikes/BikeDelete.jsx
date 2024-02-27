import { Button } from "@/components/ui/button"
import { useBikes } from "@/hooks/bikes/useBikes";

const deleteBike = ({uuid}) => {
    const { useDeleteBike } = useBikes();
    const handleDeleteClick = () => {
        useDeleteBike(uuid);
    };
    return (
        <Button variant="destructive" onClick={handleDeleteClick}>Eliminar</Button>
    )
}

export default deleteBike