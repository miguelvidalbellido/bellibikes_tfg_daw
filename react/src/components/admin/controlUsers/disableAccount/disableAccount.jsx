import React from 'react';

const DisableAccount = ({ isOpen, onClose, onConfirm, username }) => {
  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-gray-600 bg-opacity-75 flex justify-center items-center">
      <div className="bg-white p-6 rounded shadow-md">
        <h2 className="text-xl font-bold mb-4">Desactivar Cuenta</h2>
        <p>Estás seguro que deseas desactivar la cuenta del usuario: <strong>{username}</strong>?</p>
        <div className="mt-6 flex justify-end space-x-3">
          <button 
            onClick={onClose}
            className="bg-gray-200 hover:bg-gray-300 text-black py-2 px-4 rounded"
          >
            Cancelar
          </button>
          <button 
            onClick={() => onConfirm(username)}
            className="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded"
          >
            Desactivar
          </button>
        </div>
      </div>
    </div>
  );
};

export default DisableAccount;
