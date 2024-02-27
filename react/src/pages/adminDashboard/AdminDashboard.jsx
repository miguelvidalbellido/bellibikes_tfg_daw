import React, { useState, Suspense } from "react"
import StationsList from './stations/StationList'
import BikesList from './bikes/BikesList'
import SlotsList from './slots/SlotList'
import GraphicView from './graphicView/GraphicView'
import Incidents from './incidents/Indicents'

const AdminDashboard = () => {
  const [menuActivo, setMenuActivo] = useState("Inicio");

  const renderContent = () => {
    switch (menuActivo) {
      case "Inicio":
        return <div>Inicio</div>;
      case "Stations":
        return <StationsList />;
      case "Slots":
        return <SlotsList />;
      case "Bikes":
        return <BikesList />;
      case "GraphicView":
        return <GraphicView />;
      case "Incidents":
        return <Incidents />;
      default:
        return <div>Inicio</div>;
    }
  };

  const menuOptions = ["Inicio", "Stations", "Slots", "Bikes", "GraphicView", "Incidents"]

  return (
    <div className="flex h-screen">
        {/* Menú lateral izquierdo con estilo moderno */}
        <div className="w-1/6 bg-gray-800 text-white p-4">
            <ul className="space-y-2">
                {menuOptions.map((item, index) => (
                    <li
                        key={index}
                        className={`px-4 py-2 rounded-md cursor-pointer ${
                            menuActivo === item ? "bg-gray-700" : "hover:bg-gray-600"
                        }`}
                        onClick={() => setMenuActivo(item)}
                    >
                        {item}
                    </li>
                ))}
            </ul>
        </div>

        {/* Contenido principal */}
        <div className="w-5/6 p-4">
            {renderContent()}
        </div>
    </div>
);
};

export default AdminDashboard;
