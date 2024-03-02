import React, { Suspense } from "react";
const IncidenciasChart = React.lazy(() =>
  import("@/components/IncidenciasChart/IncidenciasChart")
);

const Stats = () => {
  return (
    <div className="container mx-auto px-4 py-6">
      <h2 className="text-xl font-semibold text-gray-800 mb-6">Estadísticas</h2>
      {/* Bar chart placeholder */}
      <div className="mb-8">
        <Suspense fallback={<div>Cargando Estadísticas...</div>}>
          <IncidenciasChart />
        </Suspense>
      </div>

      {/* Stats cards */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div className="bg-white p-4 shadow rounded-lg flex flex-col items-center justify-center">
          <span className="text-3xl font-bold text-yellow-600">21</span>
          <span className="text-md text-gray-600 mt-2">New features</span>
        </div>
        <div className="bg-white p-4 shadow rounded-lg flex flex-col items-center justify-center">
          <span className="text-3xl font-bold text-yellow-600">145</span>
          <span className="text-md text-gray-600 mt-2">Closed features</span>
        </div>
        <div className="bg-white p-4 shadow rounded-lg flex flex-col items-center justify-center">
          <span className="text-3xl font-bold text-yellow-600">4</span>
          <span className="text-md text-gray-600 mt-2">Fixed</span>
        </div>
        <div className="bg-white p-4 shadow rounded-lg flex flex-col items-center justify-center">
          <span className="text-3xl font-bold text-yellow-600">12</span>
          <span className="text-md text-gray-600 mt-2">Not fixed</span>
        </div>
        <div className="bg-white p-4 shadow rounded-lg flex flex-col items-center justify-center">
          <span className="text-3xl font-bold text-yellow-600">4</span>
          <span className="text-md text-gray-600 mt-2">Re-opened</span>
        </div>
        <div className="bg-white p-4 shadow rounded-lg flex flex-col items-center justify-center">
          <span className="text-3xl font-bold text-yellow-600">4</span>
          <span className="text-md text-gray-600 mt-2">Needs verify</span>
        </div>
      </div>
    </div>
  );
};

export default Stats;
