import React, { useState } from 'react';

const LocationModal = ({ isOpen, onClose, onAddLocation }) => {
  const [location, setLocation] = useState('');
  const [filter, setFilter] = useState('');

  const locations = [
    { id: '1', name: 'Ies estació' },
    { id: '2', name: 'Poligono ontinyent' },
    { id: '3', name: 'Plaza coronación' },
  ];

  const filteredLocations = locations.filter(loc => 
    loc.name.toLowerCase().includes(filter.toLowerCase())
  );

  if (!isOpen) {
    return null;
  }

  const handleSubmit = (e) => {
    e.preventDefault();
    onAddLocation(location);
    onClose();
  };

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
      <div className="bg-white p-5 rounded-lg">
        <form onSubmit={handleSubmit}>
          <div>
            <label htmlFor="search" className="block text-sm font-medium text-gray-700">Buscar ubicación</label>
            <input
              type="text"
              id="search"
              value={filter}
              onChange={(e) => setFilter(e.target.value)}
              className="mt-1 block w-full p-2 border border-gray-300 rounded-md"
              placeholder="Escribe para buscar..."
            />
          </div>
          <div className="mt-4">
            <label htmlFor="location" className="block text-sm font-medium text-gray-700">Ubicación</label>
            <select
              id="location"
              value={location}
              onChange={(e) => setLocation(e.target.value)}
              className="mt-1 block w-full p-2 border border-gray-300 rounded-md"
              required
            >
              <option value="">Selecciona una ubicación</option>
              {filter.length >= 3 && filteredLocations.map((loc) => (
                <option key={loc.id} value={loc.name}>{loc.name}</option>
              ))}
            </select>
          </div>
          <div className="mt-4 flex justify-end gap-3">
            <button
              type="button"
              onClick={onClose}
              className="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700"
            >
              Cancelar
            </button>
            <button
              type="submit"
              className="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700"
            >
              Añadir
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default LocationModal;
