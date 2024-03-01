import React from 'react';
import { Line } from 'react-chartjs-2';
import 'chart.js/auto';

const incidencias = [5, 10, 15, 20, 10, 5, 12];

const data = {
  labels: ['1 día', '2 días', '3 días', '4 días', '5 días', '6 días', 'Hoy'],
  datasets: [
    {
      label: 'Incidencias',
      data: incidencias,
      fill: false,
      backgroundColor: 'rgb(59, 130, 246)', 
      borderColor: 'rgba(59, 130, 246, 0.2)',
      tension: 0.1,
    },
  ],
};

const options = {
  scales: {
    y: {
      beginAtZero: true,
    },
  },
};

const IncidenciasChart = () => {
  return (
 <div className="mx-auto p-4 bg-white shadow rounded-lg w-full max-w-4xl">
    <Line data={data} options={options} />
</div>

  );
};

export default IncidenciasChart;
