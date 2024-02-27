import { useState } from "react"
import BikeForm from "./BikeForm"
import { useBikes } from "@/hooks/bikes/useBikes";

export function DialogCreateBikes() {
  const { useCreateBike } = useBikes();

  return (
    <BikeForm sendData={(data) => useCreateBike(data)}/>
  )
}

export default DialogCreateBikes