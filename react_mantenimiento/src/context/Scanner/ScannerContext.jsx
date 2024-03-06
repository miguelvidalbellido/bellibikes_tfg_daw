import React, { createContext, useContext, useState, useCallback } from 'react'
import ScannerService from '@/services/scanner/ScannerService'

const Context = createContext({})

export const ScannerContextProvider = ({ children }) => {
    const [rfidScan, setRfidScan] = useState(false)
    const [rfidCode, setRfidCode] = useState('')


    return <Context.Provider value={{ rfidScan, setRfidScan, rfidCode, setRfidCode }}>
        {children}
    </Context.Provider>
}

export default Context