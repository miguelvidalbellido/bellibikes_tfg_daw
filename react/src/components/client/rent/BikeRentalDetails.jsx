import React, { useContext, useState } from "react";
import backgroundImage from "@/assets/slotimg.jpg";
import bikeImage from "@/assets/bikeIcons/bike.png";

const BikeRentalDetails = ({ dataRent, onOpenIssue }) => {
    
  return (
    <div className="flex flex-col h-screen">
      <div className="relative flex-1">
        <img
          src={backgroundImage}
          className="absolute inset-0 object-cover w-full h-full filter blur"
          alt="Background"
        />
        <div className="relative flex items-center justify-center h-full">
          <img
            src={bikeImage}
            className="w-64 h-auto"
            alt="Bicicleta"
            style={{ transform: "translateY(70%)", width: "50%" }}
          />
        </div>
      </div>

      <div className="flex-1 bg-gray-900 p-6">
        <h1 className="text-2xl font-bold text-white mb-2">
          Detalles del Alquiler
        </h1>
        <p className="text-gray-500 mb-4">Marca: {dataRent.bike_brand}</p>
        <p className="text-gray-500 mb-4">Modelo: {dataRent.bike_model}</p>
        <p className="text-gray-500 mb-4">Duración del alquiler: {dataRent.duration_rent} minutos</p>
        <button className="bg-green-500 text-white rounded-full px-6 py-2 mb-4 hover:bg-green-600 w-full disabled">
          Nos vemos en el proximo alquiler
        </button>
        <button
          className="bg-blue-500 text-white rounded-full px-6 py-2 hover:bg-blue-600 w-full"
          onClick={onOpenIssue}
        >
          Reportar Incidencia
        </button>
        <div className="text-right mt-4">
          <span className="text-gray-500 text-sm">Costo del alquiler: </span>
          <span className="text-xl text-white">$34</span>
        </div>
      </div>
    </div>
  );
};

export default BikeRentalDetails;
