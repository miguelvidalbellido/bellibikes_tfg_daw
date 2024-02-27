import React, { useCallback, useContext, useState, useEffect } from "react"
import BikeService from "../../services/bikes/BikeService"

const Context = React.createContext({})

export function BikesContextProvider({ children }) {
    const [bikes, setBikes] = useState([])

    useEffect(function () {
        BikeService.getBikes()
            .then(res => setBikes(res.data))
            .catch(err => console.log(err))
    }, [setBikes])

    const fetchBikes = useCallback(function () {
        BikeService.getBikes()
            .then(res => setBikes(res.data))
            .catch(err => console.log(err))
    }, [])

    return <Context.Provider value={{ bikes, setBikes, fetchBikes }}>
        {children}
    </Context.Provider>
}

export default Context