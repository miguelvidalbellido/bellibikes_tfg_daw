import React from 'react';

const IncidentStatusList = ({ statuses }) => {

  const sortedStatuses = statuses.sort((a, b) => new Date(a.date) - new Date(b.date));

  return (
    <div className="space-y-4">
      {sortedStatuses.map((status, index) => (
        <div key={index} className="p-4 bg-gray-50 shadow-md rounded">
          <p className="text-md font-semibold text-black">Estado: {status.status}</p>
          <p className="text-sm text-gray-600 mt-2">{status.comment}</p>
          <p className="text-sm text-gray-500 mt-1">{formatDate(status.date)}</p>
        </div>
      ))}
    </div>
  );
};

function formatDate(dateString) {
  const options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
  return new Intl.DateTimeFormat('es-ES', options).format(new Date(dateString));
}

export default IncidentStatusList;
