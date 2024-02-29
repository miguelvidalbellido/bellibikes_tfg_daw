import React, { useEffect, useState, useContext } from "react"
import WebSocketService from "../../services/ws/websocket"
import StationsContextProvider from "../Stations/StationsContext";
import BikesContextProvider from "../Bikes/BikesContext";
import SlotsContextProvider from "../Slots/SlotsContext";
import RentContextProvider from "../Rent/RentContext";

const Context = React.createContext({})

export function WebSocketContextProvider({ children }) {
    const [messages, setMessages] = useState([]);

    const { fetchStations } = useContext(StationsContextProvider);
    const { fetchBikes } = useContext(BikesContextProvider);
    const { fetchSlots } = useContext(SlotsContextProvider);
    const { fetchRents } = useContext(RentContextProvider);

    useEffect(() => {
        WebSocketService.connect('wss://bellibikes.bellidel.eu/ws/changes/')

        // Suscribirse a mensajes del WebSocket
        WebSocketService.subscribeToMessages((newMessage) => {
            setMessages(prevMessages => [...prevMessages, newMessage]);

            switch (JSON.parse(newMessage).message) {
                case 'STATION':
                    fetchStations();
                    break;
                case 'BIKE':
                    fetchBikes();
                    break;
                case 'SLOT':
                    fetchSlots();
                    break;
                case 'RENT':
                    fetchRents();
                    break;
                default:
                    break;
            }
        });
    }, [])


    return <Context.Provider value={{ }}>
        {children}
    </Context.Provider>

}

export default Context