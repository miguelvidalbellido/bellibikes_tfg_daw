import React, { useState } from 'react'
import toast from 'react-hot-toast'

const FormStage = ({ onSubmit, uuid_incident }) => {
    const [status, setStatus] = useState('')
    const [comment, setComment] = useState('')
    const statusIncident = [
        { value: '', label: 'Seleccione un status' },
        { value: 'ASIGNADA', label: 'ASIGNADA' },
        { value: 'EN PROCESO', label: 'EN PROCESO' },
        { value: 'EN ESPERA DE PIEZAS', label: 'EN ESPERA DE PIEZAS' },
        { value: 'FINALIZADA', label: 'FINALIZADA' }
    ]

    const handleSubmit = (e) => {
        e.preventDefault()

        if (uuid_incident === '') {
            toast.error('Seleccione una incidencia')
            return
        }

        if (status && comment) {
            onSubmit({ 
                'uuid_incident': uuid_incident,
                'status': status, 
                'comment': comment })
            setStatus('')
            setComment('')
        }

        if (!status) toast.error('Seleccione un status')
        if (!comment) toast.error('Ingrese un comentario')
    }

    return (
        <form onSubmit={handleSubmit} className="p-4 bg-white shadow rounded-lg">
            <div className="mb-4">
                <label htmlFor="status" className="block text-sm font-medium text-gray-700">
                    Status
                </label>
                <select
                    id="status"
                    value={status}
                    onChange={(e) => setStatus(e.target.value)}
                    className="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                >
                    {statusIncident.map((status, index) => (
                        <option key={index} value={status.value}>{status.label}</option>
                    ))}
                </select>
            </div>
            <div className="mb-4">
                <label htmlFor="comment" className="block text-sm font-medium text-gray-700">
                    Comment
                </label>
                <input
                    type="text"
                    id="comment"
                    value={comment}
                    onChange={(e) => setComment(e.target.value)}
                    className="mt-1 block w-full p-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-orange-500 focus:border-orange-500"
                />
            </div>
            <button
                type="submit"
                className="w-full px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
            >
                Enviar
            </button>
        </form>
    );
};

export default FormStage;
