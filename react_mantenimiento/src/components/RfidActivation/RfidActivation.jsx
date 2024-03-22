import React from 'react'
import Scanner from '@/assets/icons/escaner.png'

const RfidActivation = ({activationRfid}) => {
  return (
    <div className="w-full h-screen flex flex-col items-center justify-center bg-gray-100 p-4">
      <img src={Scanner} alt="Scanning" className="max-w-xs md:max-w-lg w-full h-auto" />
      <h2 className="text-xl md:text-3xl text-center text-gray-700 mt-4">
        Inicie escaneo para activar el lector RFID
      </h2>
      <button onClick={() => activationRfid()} className="mt-4 px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition duration-300 ease-in-out">
        ACTIVAR LECTOR
      </button>
    </div>
  );
};

export default RfidActivation;
