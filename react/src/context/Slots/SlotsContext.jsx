import React, { useCallback, useContext, useState, useEffect } from "react"
import SlotService from "../../services/slots/SlotService"

const Context = React.createContext({})

export function SlotsContextProvider({ children }) {
    const [slots, setSlots] = useState([])

    useEffect(function () {
        SlotService.getSlots()
            .then(res => setSlots(res.data))
            .catch(err => console.log(err)) 
    }, [setSlots])

    const fetchSlots = useCallback(function () {
        SlotService.getSlots()
            .then(res => setSlots(res.data))
            .catch(err => console.log(err))
    }, [])

    return <Context.Provider value={{ slots, setSlots, fetchSlots }}>
        {children}
    </Context.Provider>
}

export default Context