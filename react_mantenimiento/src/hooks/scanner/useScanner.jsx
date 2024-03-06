import { useCallback, useContext, useEffect, useState } from "react"
import { useNavigate } from "react-router-dom"
import ScannerService from '../../services/scanner/ScannerService'
import ScannerContextProvider from "../../context/Scanner/ScannerContext"

export function useScanner() {
    const navigate = useNavigate()
    const { rfidScan, setRfidScan, rfidCode, setRfidCode } = useContext(ScannerContextProvider)

    const [asociatedScanner, setAsociatedScanner] = useState(false)
    const [incidentData, setIncidentData] = useState([])

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

    const getIncidentsScan = useCallback((rfid_tag) => {
        ScannerService.getIncidentsScan(rfid_tag).then(({ data, status }) => {
            if (status === 200) {
                setIncidentData(data.incidents)
            }
        }).catch(e => {
            console.error(e)
        })
    }, [])

    return { asociatedScanner, checkScanner, asociateScanner, rfidScan, setRfidScan, rfidCode, setRfidCode, getIncidentsScan, incidentData, setIncidentData }

}