import React, { useState, Suspense } from "react"
import StationsList from './stations/StationList'
import BikesList from './bikes/BikesList'
import SlotsList from './slots/SlotList'
import GraphicView from './graphicView/GraphicView'
import Incidents from './incidents/Indicents'
import HomeDashboard from './home/HomeDashboard'

const AdminDashboard = () => {
  const [menuActivo, setMenuActivo] = useState("Inicio");

  const renderContent = () => {
    switch (menuActivo) {
      case "Inicio":
        return <HomeDashboard />;
      case "Estaciones":
        return <StationsList />;
      case "Ranuras":
        return <SlotsList />;
      case "Bicis":
        return <BikesList />;
      case "Vista Gráfica":
        return <GraphicView />;
      case "Incidencias":
        return <Incidents />;
      default:
        return <div>Inicio</div>;
    }
  };

  const menuOptions = ["Inicio", "Estaciones", "Ranuras", "Bicis", "Vista Gráfica", "Incidencias"]

  return (
    <div className="flex h-screen">
        {/* Menú lateral izquierdo con estilo moderno y minimalista */}
        <div className="w-1/6 bg-gray-100 text-gray-800 p-5 border-r-4 border-green-200">
            <ul className="space-y-4">
                {menuOptions.map((item, index) => (
                    <li
                        key={index}
                        className={`px-4 py-3 rounded-lg cursor-pointer font-medium transition-colors duration-150 ${
                            menuActivo === item ? "bg-emerald-500 text-white" : "hover:bg-green-500 hover:text-white"
                        }`}
                        onClick={() => setMenuActivo(item)}
                    >
                        {item}
                    </li>
                ))}
            </ul>
        </div>

        <div className="w-5/6 p-8 overflow-auto">
            <Suspense fallback={<div>Loading...</div>}>
              {renderContent()}
            </Suspense>
        </div>
    </div>
);
};

export default AdminDashboard;
