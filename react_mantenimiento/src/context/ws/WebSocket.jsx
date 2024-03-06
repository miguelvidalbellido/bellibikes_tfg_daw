import React, { useEffect, useState, useContext } from "react";
import WebSocketService from "../../services/ws/websocket";
import AuthContext from "../auth/AuthContext";
import ScannerContextProvider from "../Scanner/ScannerContext";
const Context = React.createContext({});

export function WebSocketContextProvider({ children }) {
  const { user } = useContext(AuthContext);
  const [messages, setMessages] = useState([]);
  const { setRfidScan, setRfidCode } = useContext(ScannerContextProvider);

  useEffect(() => {
    if (user && user.username) {
      WebSocketService.connect("wss://bbdjango.bellidel.eu/ws/changes/");

      // Suscribirse a mensajes del WebSocket
      WebSocketService.subscribeToMessages((newMessage) => {
        setMessages((prevMessages) => [...prevMessages, newMessage]);

        const msg = JSON.parse(newMessage).message;

        // COMPROBAMOS SI EL MENSAJE ES UNA PETICION DE ESCANEO DE RFID Y SI EL USUARIO ES EL QUE ESTA LOGUEADO
        if (msg.startsWith("RFID_SCAN")) {
          const parts = msg.split("_")
          
          if (parts.length >= 4) {
            const username = parts[2]
            const RFIDCODE = parts.slice(3).join("_")

            // console.log("RFID_SCAN para usuario:", username);
            // console.log("Código RFID:", RFIDCODE)
        
            if (username === user.username) {
              setRfidScan(true)
              console.log("Usuario coincidente. Acción activada.")
              setRfidCode(RFIDCODE)
            }
          }
        }

        switch (msg) {
          case "TEST":
            console.log("TEST");
            break;
          default:
            break;
        }
      });
    }
  }, [user]);

  return <Context.Provider value={{}}>{children}</Context.Provider>;
}

export default Context;
