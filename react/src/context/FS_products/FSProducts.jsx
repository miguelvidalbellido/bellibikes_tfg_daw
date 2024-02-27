import React, { useCallback, useContext, useState, useEffect } from "react"
import FsService from '../../services/FS/FsService'

const Context = React.createContext({})

export function FSProductsContextProvider({ children }) {
    const [fsProducts, setFSProducts] = useState([])

    useEffect(function () {
        FsService.getProducts()
            .then(res => {
                setFSProducts(res.data)
            })
            .catch(err => console.log(err)) 
    }, [setFSProducts])

    return <Context.Provider value={{ fsProducts, setFSProducts }}>
        {children}
    </Context.Provider>

}

export default Context