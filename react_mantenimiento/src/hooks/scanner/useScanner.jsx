import { useCallback, useContext, useEffect, useState } from "react"
import { useNavigate } from "react-router-dom"
import ScannerService from '../../services/scanner/ScannerService'
import ScannerContextProvider from "../../context/Scanner/ScannerContext"

export function useScanner() {
    const navigate = useNavigate()
    const { rfidScan } = useContext(ScannerContextProvider)

    const [asociatedScanner, setAsociatedScanner] = useState(false)

    const checkScanner = useCallback(() => {
        ScannerService.getCheckScanner().then(({ data, status }) => {
            if (status === 200) {
                console.log(data.scanner);
                setAsociatedScanner(data.scanner)
            }
        }).catch(e => {
            console.error(e)
        })
    }, [])

    const asociateScanner = useCallback((data) => {
        ScannerService.postAsociateScanner(data).then(({ data, status }) => {
            if (status === 200) {
                console.log('Lector asociado:', data);
            }
        }).catch(e => {
            console.error(e)
        })
    }, [])

    return { asociatedScanner, checkScanner, asociateScanner, rfidScan }

}