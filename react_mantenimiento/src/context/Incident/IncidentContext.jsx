import React, { createContext, useState, useEffect, useCallback } from 'react'
import IncidentService from '../../services/incidents/IndicentService'
const Context = createContext({})

export const IncidentContextProvider = ({ children }) => {
    const [incidents, setIncidents] = useState([]);

    useEffect(() => {
        IncidentService.getIncidents()
            .then(res => setIncidents(res.data))
            .catch(err => console.log(err))
    }, [setIncidents])

    const fetchIncidents = useCallback(() => {
        IncidentService.getIncidents()
            .then(res => console.log(res.data))
            .catch(err => console.log(err))
    }, [])

    return <Context.Provider value={{ incidents, setIncidents, fetchIncidents }}>
        {children}
    </Context.Provider>
}

export default Context