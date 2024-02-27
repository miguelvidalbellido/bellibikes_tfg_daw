import React, { createContext, useState, useEffect, useCallback } from 'react'
import IncidentStagesContext from '../../services/incidentsStages/IncidentsStages'
const Context = createContext({})

export const IncidentsStagesContextProvider = ({ children }) => {
    const [allIncidentsStages, setAllIncidentsStages] = useState([]);

    useEffect(() => {
        IncidentStagesContext.getStages()
            .then(res => setAllIncidentsStages(res.data))
            .catch(err => console.log(err))
    }, [setAllIncidentsStages])

    const fetchIncidents = useCallback(() => {
        IncidentStagesContext.getStages()
            .then(res => setAllIncidentsStages(res.data))
            .catch(err => console.log(err))
    }, [])

    return <Context.Provider value={{ allIncidentsStages, setAllIncidentsStages }}>
        {children}
    </Context.Provider>
}

export default Context