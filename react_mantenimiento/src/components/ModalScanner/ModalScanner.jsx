import React, { useState } from 'react';

const ModalScanner = ({ isOpen, onClose, associateScanner }) => {
  const [lector, setLector] = useState('');

  const handleAccept = () => {
    associateScanner(lector)
    onClose();
  };

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="my-modal">
      <div className="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div className="mt-3 text-center">
          <h3 className="text-lg leading-6 font-medium text-gray-900">No tienes un lector asociado</h3>
          <div className="mt-2 px-7 py-3">
            <p className="text-sm text-gray-500">El código se encuentra justo detras de cada lector RFID.</p>
            <input
              type="text"
              className="mt-3 px-4 py-2 border rounded-lg text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-orange-500"
              value={lector}
              onChange={(e) => setLector(e.target.value)}
              placeholder="ID del lector"
            />
          </div>
          <div className="items-center px-4 py-3">
            <button
              id="ok-btn"
              className="px-4 py-2 bg-orange-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
              onClick={handleAccept}
            >
              Aceptar
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ModalScanner;
