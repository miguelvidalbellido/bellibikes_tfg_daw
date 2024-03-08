import React from 'react'
import Lottie from 'react-lottie'
import ScannAnimated from '@/assets/animations/scan_animation1.json'



const WaitingRfid = () => {

    const defaultOptionsScanAnimated = {
        loop: true,
        autoplay: true, 
        animationData: ScannAnimated,
        rendererSettings: {
        preserveAspectRatio: 'xMidYMid slice'
        }
    };
    
    return (
        <div className="flex flex-col items-center justify-center h-screen mt-0">
            <div className="w-full max-w-xs md:max-w-sm lg:max-w-lg">
                <Lottie options={defaultOptionsScanAnimated}/>
            </div>
            <p className="text-lg text-gray-800 mt-4">Esperando datos...</p>
        </div>
    )

}

export default WaitingRfid