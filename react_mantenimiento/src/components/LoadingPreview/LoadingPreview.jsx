import React from 'react'
import Lottie from 'react-lottie'
import ScannAnimated from '@/assets/animations/loading.json'



const LoadingPreview = () => {

    const defaultOptionsScanAnimated = {
    loop: true,
    autoplay: true, 
    animationData: ScannAnimated,
    rendererSettings: {
      preserveAspectRatio: 'xMidYMid slice'
    }
    };
    
    return (
        <div className="flex flex-col items-center justify-center h-screen">
            <div className="w-full max-w-xs md:max-w-sm lg:max-w-lg">
                <Lottie options={defaultOptionsScanAnimated}/>
            </div>
        </div>
    )

}

export default LoadingPreview