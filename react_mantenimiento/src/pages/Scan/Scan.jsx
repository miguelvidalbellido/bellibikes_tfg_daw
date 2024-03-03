import React, { useState, useEffect } from 'react'
import { useScanner } from '@/hooks/scanner/useScanner'
const RfidActivation = React.lazy(() => import('@/components/RfidActivation/RfidActivation'))
const ModalScanner = React.lazy(() => import('@/components/ModalScanner/ModalScanner'))

const Scan = () => {

    const [isModalOpen, setIsModalOpen] = useState(false);
    const [enableRfid, setEnableRfid] = useState(false)
    const { asociatedScanner, checkScanner, asociateScanner, rfidScan } = useScanner()

    useEffect(() => {
        if (asociatedScanner) {
            setEnableRfid(true)
            asociatedScanner == 'true' ? setIsModalOpen(false) : setIsModalOpen(true)
        }
    }, [asociatedScanner])

    useEffect(() => {
        if (rfidScan && enableRfid) {
            console.log('OBTENEMOS EL RFID SCAN Y REALIZAMOS PETICIONES AL BACKEND');
        }
    }, [rfidScan, enableRfid])


    const handleRfidActivation = async () => {
        checkScanner()
    }

    const handleAsociateScanner = (uuid) => {
        console.log('Lector asociado:', uuid)
        asociateScanner(uuid)
        setEnableRfid(false)
    }

    return (
        <>
        {
            enableRfid ? (
                asociatedScanner == 'true' ? (
                    <p>{asociatedScanner}</p>
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