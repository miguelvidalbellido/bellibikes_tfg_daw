import { Button } from "@/components/ui/button"
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"

import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"

import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { useState } from "react"
import { useToast } from '@/components/ui/use-toast'

// Context para obtener los selects
import { useBikes } from '@/hooks/bikes/useBikes'
import { useStations } from '@/hooks/stations/useStations'

export function DialogFormSlot({sendData, data}) {
    const [dataValues, setDataValues] = useState(data);
    const { bikes } = useBikes();
    const { stations } = useStations();

    const { toast } = useToast()
    const isModifyMode = data ? true : false;


    const handleInputChange = (e) => {
        const { id, value } = e.target;
        setDataValues(prevDataValues => ({
            ...prevDataValues,
            [id]: value,
        }));
    };

    const handleStationChange = (value) => {
      setDataValues(prevDataValues => ({
        ...prevDataValues,
        'uuid_station': value,
      }));
    }

    const handleBikeChange = (value) => {
      setDataValues(prevDataValues => ({
        ...prevDataValues,
        'uuid_bike': value,
      }));
    }

    const handleSubmit = (event) => {
        event.preventDefault();


        // Se elimina uuid_bike si no tiene valor
        if (dataValues.uuid_bike === 'NINGUNA') {
            delete dataValues.uuid_bike;
        }

        // Comprueba que tiene UUID_STATION
        if (dataValues.uuid_station === 'NINGUNA') {
          toast({
            title: 'Ha ocurrido un error',
            description: `Selecciona una estación`,
            status: 'error',
            duration: 5000
        })
            return;
        } else {
          sendData(dataValues);
        }

        if (!isModifyMode) {
          setDataValues({});
        }
    };

    const actionText = data ? 'Modificar' : 'Crear';

  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button variant="outline">{`${actionText} slot`}</Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <form onSubmit={handleSubmit}>
          <DialogHeader>
            <DialogTitle>{`${actionText} slot`}</DialogTitle>
            <DialogDescription>
              Make changes to your profile here. Click save when you're done.
            </DialogDescription>
          </DialogHeader>
          <div className="grid gap-4 py-4">
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="sname" className="text-right">
                  Status
              </Label>
              <Input
                  id="status"
                  className="col-span-3"
                  value={dataValues?.status ?? ''}
                  onChange={handleInputChange}
              />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="theme" className="text-right">
                  UUID_STATION
                </Label>
                <Select defaultValue={dataValues?.uuid_station ?? 'NINGUNA'} className="col-span-3" onValueChange={handleStationChange}>
                  <SelectTrigger className="w-[180px]">
                    <SelectValue placeholder="SELECT STATION" />
                  </SelectTrigger>
                  <SelectContent>
                    {/* Opción NINGUNA agregada aquí */}
                    <SelectItem value="NINGUNA">
                      NINGUNA
                    </SelectItem>

                    {/* Mapeo de las bicicletas existentes */}
                    {stations.map((station) => (
                      <SelectItem key={station.uuid} value={station.uuid} >
                        {station.name}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
                <Label htmlFor="theme" className="text-right">
                  UUID_BIKE
                </Label>
                <Select defaultValue={dataValues?.uuid_bike ?? 'NINGUNA'} className="col-span-3" onValueChange={handleBikeChange}>
                  <SelectTrigger className="w-[180px]">
                    <SelectValue placeholder="SELECT BIKE" />
                  </SelectTrigger>
                  <SelectContent>
                    {/* Opción NINGUNA agregada aquí */}
                    <SelectItem value="NINGUNA">
                      NINGUNA
                    </SelectItem>

                    {/* Mapeo de las bicicletas existentes */}
                    {bikes.map((bike) => (
                      <SelectItem key={bike.uuid} value={bike.uuid}>
                        {bike.sname}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
              </div>
          </div>
          <DialogFooter>
            <Button type="submit">Save changes</Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  )
}

export default DialogFormSlot