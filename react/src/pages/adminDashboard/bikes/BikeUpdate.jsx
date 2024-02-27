import { useState } from "react"
import BikeForm from "./BikeForm"
import { useBikes } from "@/hooks/bikes/useBikes";

export function DialogUpdateBikes({data}) {

  const [ dataValues, setDataValues ] = useState(data)
  const { useUpdateBike } = useBikes();
    
  return (
    <BikeForm sendData={(data) => useUpdateBike(data)} data={dataValues}/>
  )
}

export default DialogUpdateBikes