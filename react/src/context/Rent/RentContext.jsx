import React, { useState, useEffect, createContext, useCallback } from "react";
import RentService from "../../services/rent/RentService";

const Context = createContext({});

export function RentContextProvider({ children }) {
    const [rents, setRents] = useState([]);
    const [activeRentUser, setActiveRentUser] = useState(null);

    useEffect(() => {
        const fetchInitialRents = async () => {
            try {
                const res = await RentService.getRents();
                setRents(res.data);
            } catch (err) {
                console.error(err);
            }
        };
        fetchInitialRents();
    }, []);

    const fetchRents = useCallback(async () => {
        try {
            const res = await RentService.getRents();
            setRents(res.data)
        } catch (err) {
            console.error(err);
        }
    }, []);

    return (
        <Context.Provider value={{ rents, setRents, fetchRents, activeRentUser, setActiveRentUser }}>
            {children}
        </Context.Provider>
    );
}

export default Context;
