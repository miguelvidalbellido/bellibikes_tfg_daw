import { Button } from "@/components/ui/button"
import { useStations } from "@/hooks/stations/useStations";

// export function ButtonDestructive() {
//     return <Button variant="destructive">Destructive</Button>
// }

const deleteStation = ({uuid}) => {
    const { useDeleteStation } = useStations();
    const handleDeleteClick = () => {
        useDeleteStation(uuid);
    };
    return (
        <Button variant="destructive" onClick={handleDeleteClick}>Eliminar</Button>
    )
}

export default deleteStation