import React, { createContext, useContext, useState, useCallback } from 'react'
import ScannerService from '@/services/scanner/ScannerService'

const Context = createContext({})

export const ScannerContextProvider = ({ children }) => {
    const [rfidScan, setRfidScan] = useState(false);


    return <Context.Provider value={{ rfidScan, setRfidScan }}>
        {children}
    </Context.Provider>
}

export default Context