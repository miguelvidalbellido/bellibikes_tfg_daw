import React, { useState, useEffect } from 'react'
import { useScanner } from '@/hooks/scanner/useScanner'
import { useIncidentStages } from '@/hooks/incidentStages/useIncidentStages'
const RfidActivation = React.lazy(() => import('@/components/RfidActivation/RfidActivation'))
const ModalScanner = React.lazy(() => import('@/components/ModalScanner/ModalScanner'))
const IncidentTable = React.lazy(() => import('@/components/ScannerComponents/IncidentTable/IncidentTable'))
const IncidentStages = React.lazy(() => import('@/components/ScannerComponents/IncidentStages/IncidentStages'))
const FormStage = React.lazy(() => import('@/components/ScannerComponents/FormStage/FormStage'))
const WaitingRfid = React.lazy(() => import('@/components/ScannerComponents/WaitingRfid/WaitingRfid'))  

const Scan = () => {

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [enableRfid, setEnableRfid] = useState(false)
    const [uuid_incident, setUuidIncident] = useState('')
    const { asociatedScanner, checkScanner, asociateScanner, rfidScan, setRfidScan, rfidCode, setRfidCode, getIncidentsScan, incidentData, setIncidentData } = useScanner()
    const { getStagesFromIncident, incidentStages, createIncidentStage } = useIncidentStages()

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
            // console.log('WS NOTIFICA RFID SCAN, SOLICITAMOS DATOS AL BACKEND' + rfidCode)
            getIncidentsScan(rfidCode)
        }
    }, [rfidScan, enableRfid])


    const handleRfidActivation = async () => {
        checkScanner()
    }

    const handleAsociateScanner = (uuid) => {
        // console.log('Lector asociado:', uuid)
        asociateScanner(uuid)
        setEnableRfid(false)
        setIncidentData([])
        setUuidIncident('')
    }

    const handleStageSubmit = async (data) => {
        // console.log('Datos del formulario', data)
        await createIncidentStage(data)
        await getStagesFromIncident(uuid_incident)
    }

    const loadStages = async (uuid_incident) => {
        await getStagesFromIncident(uuid_incident)
    }

    // if (incidentStages.length > 0) console.log(incidentStages)


    /// VISTA
    const incidentsTableView = incidentData.length > 0 
        ? <IncidentTable incidents={incidentData} onSelectIncident={(uuid) => {
            setUuidIncident(uuid)
            loadStages(uuid)
            }
        } /> 
        : undefined

    const stagesView = incidentStages.length > 0 
        ? <IncidentStages stages={incidentStages} /> 
        : null
    
    const formStageView = incidentData.length > 0
        ? <FormStage onSubmit={(data) => handleStageSubmit(data)} uuid_incident={uuid_incident} />
        : null

    return (
        <>
        {
                enableRfid ? (
                    asociatedScanner == 'true' ? (
                        rfidCode ? (
                    <div className="flex flex-wrap mx-6">
                        <div className="w-full md:w-full lg:w-3/5 p-4">
                            <div className="m-4">
                                {incidentsTableView}
                            </div>
                            <div className="m-4">
                                {stagesView}
                            </div>    
                        </div>
                        <div className="w-full md:w-full lg:w-2/5 p-4">
                            <div className="m-4">
                                {formStageView}
                            </div>
                        </div>
                            </div>
                        ) : (
                            <WaitingRfid />
                        )
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