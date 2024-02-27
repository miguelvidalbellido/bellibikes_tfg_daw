import { useState } from "react"
import StationForm from "./StationForm"
import { useStations } from "@/hooks/stations/useStations";

export function DialogUpdateStations({data}) {

  const [ dataValues, setDataValues ] = useState(data)
  const { useUpdateStation } = useStations();
    
  return (
    <StationForm sendData={(data) => useUpdateStation(data)} data={dataValues}/>
  )
}

export default DialogUpdateStations