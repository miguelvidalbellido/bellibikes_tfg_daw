import React, { useState, useEffect } from 'react'
import { useScanner } from '@/hooks/scanner/useScanner'
import { useIncidentStages } from '@/hooks/incidentStages/useIncidentStages'
const RfidActivation = React.lazy(() => import('@/components/RfidActivation/RfidActivation'))
const ModalScanner = React.lazy(() => import('@/components/ModalScanner/ModalScanner'))
const IncidentTable = React.lazy(() => import('@/components/ScannerComponents/IncidentTable/IncidentTable'))
const IncidentStages = React.lazy(() => import('@/components/ScannerComponents/IncidentStages/IncidentStages'))

const Scan = () => {

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [enableRfid, setEnableRfid] = useState(false)
    const { asociatedScanner, checkScanner, asociateScanner, rfidScan, setRfidScan, rfidCode, setRfidCode, getIncidentsScan, incidentData } = useScanner()
    const { getStagesFromIncident, incidentStages } = useIncidentStages()
    useEffect(() => {
        if (asociatedScanner) {
            setEnableRfid(true)
            setRfidScan(false)
            setRfidCode('')
            asociatedScanner == 'true' ? setIsModalOpen(false) : setIsModalOpen(true)
        }
    }, [asociatedScanner])

    useEffect(() => {
        if (rfidScan && enableRfid) {
            console.log('WS NOTIFICA RFID SCAN, SOLICITAMOS DATOS AL BACKEND' + rfidCode)
            getIncidentsScan(rfidCode)
        }
    }, [rfidScan, enableRfid])


    const handleRfidActivation = async () => {
        checkScanner()
    }

    const handleAsociateScanner = (uuid) => {
        console.log('Lector asociado:', uuid)
        asociateScanner(uuid)
        setEnableRfid(false)
        setIncidentData([])
    }

    const loadStages = async (uuid_incident) => {
        await getStagesFromIncident(uuid_incident)
    }

    if (incidentStages.length > 0) console.log(incidentStages)

    /// VISTA
    const incidentsTableView = incidentData.length > 0 
        ? <IncidentTable incidents={incidentData} onSelectIncident={(uuid) => loadStages(uuid)} /> 
        : <p>No hay incidentes</p>

    const stagesView = incidentStages.length > 0 
        ? <IncidentStages stages={incidentStages} /> 
        : null

    return (
        <>
        {
            enableRfid ? (
                asociatedScanner == 'true' ? (
                    <div className="flex flex-wrap -mx-2">
                        <div className="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                            <div className="m-4">
                                {incidentsTableView}
                            </div>
                            <div className="m-4">
                                {stagesView}
                            </div>    
                        </div>
                        <div className="w-full md:w-1/2 px-2">
                            <div className="m-4">
                                
                            </div>
                        </div>
                    </div>
                ) : (
                    <ModalScanner isOpen={isModalOpen} onClose={() => setIsModalOpen(false)} associateScanner={(uuid_scanner) => handleAsociateScanner(uuid_scanner)}  />
                )
            ) : (
                <RfidActivation activationRfid={handleRfidActivation} />
            )
        }
        </>
    )
}

export default Scan