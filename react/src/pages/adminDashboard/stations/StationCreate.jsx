import { useState } from "react"
import StationForm from "./StationForm"
import { useStations } from "@/hooks/stations/useStations";

export function DialogCreateStations() {
  const { useCreateStation } = useStations();

  return (
    <StationForm sendData={(data) => useCreateStation(data)}/>
  )
}

export default DialogCreateStations