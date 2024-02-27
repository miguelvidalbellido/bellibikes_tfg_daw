import React, { createContexxt, useState, useEffect } from 'react'

const Context = React.createContext({})

export function DeviceContextProvider({ children }) {
    const [isMobile, setIsMobile] = useState(window.innerWidth < 768);

    useEffect(() => {
        const hamdleResize = () => {    
            setIsMobile(window.innerWidth < 768);
        }

        window.addEventListener('resize', hamdleResize);

        return () => {
            window.removeEventListener('resize', hamdleResize);
        }
    }, []);

    return <Context.Provider value={{ isMobile }}>
        {children}
    </Context.Provider>
}