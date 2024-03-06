import React, { useState } from 'react';

const FormStage = ({ onSubmit }) => {
    const [tipoIncidencia, setTipoIncidencia] = useState('');
    const [descripcion, setDescripcion] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault(); // Evita el comportamiento predeterminado de envío del formulario
        // Envía los datos al componente padre
        onSubmit({ tipoIncidencia, descripcion });
        // Opcional: Limpia el formulario
        setTipoIncidencia('');
        setDescripcion('');
    };

    return (
        <form onSubmit={handleSubmit} className="p-4 bg-white shadow rounded-lg">
            <div className="mb-4">
                <label htmlFor="tipoIncidencia" className="block text-sm font-medium text-gray-700">
                    Tipo de Incidencia
                </label>
                <select
                    id="tipoIncidencia"
                    value={tipoIncidencia}
                    onChange={(e) => setTipoIncidencia(e.target.value)}
                    className="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
                    <option value="">Seleccione un tipo</option>
                    {/* Añade más opciones según sea necesario */}
                    <option value="tipo1">Tipo 1</option>
                    <option value="tipo2">Tipo 2</option>
                    <option value="tipo3">Tipo 3</option>
                </select>
            </div>
            <div className="mb-4">
                <label htmlFor="descripcion" className="block text-sm font-medium text-gray-700">
                    Descripción
                </label>
                <input
                    type="text"
                    id="descripcion"
                    value={descripcion}
                    onChange={(e) => setDescripcion(e.target.value)}
                    className="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>
            <button
                type="submit"
                className="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                Enviar
            </button>
        </form>
    );
};

export default FormStage;
