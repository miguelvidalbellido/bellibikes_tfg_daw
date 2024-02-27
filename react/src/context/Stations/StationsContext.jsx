import React, { useCallback, useContext, useState, useEffect } from "react"
import StationService from "../../services/stations/StationService"

const Context = React.createContext({})

export function StationsContextProvider({ children }) {
    const [stations, setStations] = useState([])

    useEffect(function () {
        StationService.getStations()
            .then(res => setStations(res.data))
            .catch(err => console.log(err))
    }, [setStations])

    const fetchStations = useCallback(function () {
        StationService.getStations()
            .then(res => setStations(res.data))
            .catch(err => console.log(err))
    }, [])

    // useEffect(function () {
    //     fetchStations()
    // }, [fetchStations])

    

    return <Context.Provider value={{ stations, setStations, fetchStations }}>
        {children}
    </Context.Provider>
}

export default Context