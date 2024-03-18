import React, { useState } from 'react';

const NotificationModal = ({ isOpen, onClose, onSend }) => {
  const [notification, setNotification] = useState({
    from: 'admin@bellidel.eu',
    to: '',
    emailType: '',
    subject: '',
    emailData: {
      message: ''
    }
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    // setNotification(prev => ({ ...prev, [name]: value }));
    if (name === 'message') {
      setNotification(prev => ({
        ...prev,
        emailData: {
          ...prev.emailData,
          message: value
        }
      }));
    } else {
      setNotification(prev => ({ ...prev, [name]: value }));
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onSend(notification);
    onClose();
  };

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-gray-600 bg-opacity-75 flex justify-center items-center z-50">
      <div className="bg-white p-6 rounded shadow-md w-full max-w-md">
        <h3 className="text-lg font-semibold mb-4">Enviar Notificación</h3>
        <form onSubmit={handleSubmit}>
          <label htmlFor="emailType" className="block mb-2 text-sm font-medium text-gray-700">
            Tipo de Mensaje
          </label>
          <select
            name="emailType"
            id="emailType"
            value={notification.emailType}
            onChange={handleChange}
            className="mb-4 w-full p-2 border border-gray-300 rounded-md shadow-sm"
            required
          >
            <option value="">Selecciona un tipo</option>
            <option value="info">Información</option>
            <option value="warning">Advertencia</option>
            <option value="alert">Alerta</option>
          </select>

          <label htmlFor="subject" className="block mb-2 text-sm font-medium text-gray-700">
            Asunto
          </label>
          <input
            type="text"
            name="subject"
            id="subject"
            value={notification.subject}
            onChange={handleChange}
            className="mb-4 w-full p-2 border border-gray-300 rounded-md shadow-sm"
            required
          />

          <label htmlFor="message" className="block mb-2 text-sm font-medium text-gray-700">
            Mensaje
          </label>
          <textarea
            name="message"
            id="message"
            rows="4"
            value={notification.message}
            onChange={handleChange}
            className="mb-4 w-full p-2 border border-gray-300 rounded-md shadow-sm"
            required
          ></textarea>

          <div className="flex justify-end space-x-2">
            <button
              type="button"
              onClick={onClose}
              className="py-2 px-4 bg-gray-500 hover:bg-gray-600 text-white rounded-md focus:outline-none"
            >
              Cancelar
            </button>
            <button
              type="submit"
              className="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-md focus:outline-none"
            >
              Enviar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default NotificationModal;
