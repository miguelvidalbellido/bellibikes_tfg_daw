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
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { useState } from "react"
import { useToast } from '@/components/ui/use-toast'


export function DialogFormBikes({sendData, data}) {
    const [dataValues, setDataValues] = useState(data);
    const { toast } = useToast()
    const isModifyMode = data ? true : false;

    const handleInputChange = (e) => {
        const { id, value } = e.target;
        setDataValues(prevDataValues => ({
            ...prevDataValues,
            [id]: value,
        }));
    };

    const isValidLatitude = (lat) => {
      const regex = /^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/;
      return regex.test(lat);
    };

    const isValidLongitude = (lon) => {
        const regex = /^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/;
        return regex.test(lon);
    };

    const handleSubmit = (event) => {
        event.preventDefault();
        // if (!isValidLatitude(dataValues.latitude)) {
        //     toast({
        //         title: 'Error',
        //         description: `Invalid latitude`,
        //         status: 'error',
        //         duration: 5000
        //     })
        //     return;
        // } else if (!isValidLongitude(dataValues.longitude)) {
        //     toast({
        //         title: 'Error',
        //         description: `Invalid longitude`,
        //         status: 'error',
        //         duration: 5000
        //     })
        //     return;
        // }
        sendData(dataValues);
        if (!isModifyMode) {
          setDataValues({});
        }
    };

    const actionText = data ? 'Modificar' : 'Crear';

  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button variant="outline">{`${actionText} bici`}</Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <form onSubmit={handleSubmit}>
          <DialogHeader>
            <DialogTitle>{`${actionText} bici`}</DialogTitle>
            <DialogDescription>
              Make changes to your profile here. Click save when you're done.
            </DialogDescription>
          </DialogHeader>
          <div className="grid gap-4 py-4">
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="sname" className="text-right">
                  Serial Name
              </Label>
              <Input
                  id="sname"
                  className="col-span-3"
                  value={dataValues?.sname ?? ''}
                  onChange={handleInputChange}
              />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="status" className="text-right">
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
              <Label htmlFor="model" className="text-right">
                  Model
              </Label>
              <Input
                  id="model"
                  className="col-span-3"
                  value={dataValues?.model ?? ''}
                  onChange={handleInputChange}
              />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="brand" className="text-right">
                  Brand
              </Label>
              <Input
                  id="brand"
                  className="col-span-3"
                  value={dataValues?.brand ?? ''}
                  onChange={handleInputChange}
              />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="batery" className="text-right">
                  Batery
              </Label>
              <Input
                  id="batery"
                  className="col-span-3"
                  value={dataValues?.batery ?? ''}
                  onChange={handleInputChange}
              />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="lat" className="text-right">
                  Latitude
              </Label>
              <Input
                  id="lat"
                  className="col-span-3"
                  value={dataValues?.lat ?? ''}
                  onChange={handleInputChange}
              />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="lng" className="text-right">
                  Longitude
              </Label>
              <Input
                  id="lng"
                  className="col-span-3"
                  value={dataValues?.lng ?? ''}
                  onChange={handleInputChange}
              />
              </div>
              <div className="grid grid-cols-4 items-center gap-4">
              <Label htmlFor="rfid" className="text-right">
                  RFID_TAG OPCIONAL
              </Label>
              <Input
                  id="rfid"
                  className="col-span-3"
                  value={dataValues?.rfid ?? ''}
                  onChange={handleInputChange}
              />
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

export default DialogFormBikes