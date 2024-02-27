import React from "react";
import { useIncidentStages } from "@/hooks/incidentStages/useIncidentStages";
import { useEffect } from "react";
import { useAuth } from '@/hooks/auth/useAuth'
import { useNavigate } from 'react-router-dom';

const Page = () => {
  const { notifyUser, getNotifysUser, checkView } = useIncidentStages();
  const { isAuth } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    if (isAuth) getNotifysUser();
  }, [isAuth]);

  const marcarComoLeidas = (uuid) => {
    console.log(`Incidencia ${uuid} marcada como leída.`);
    checkView(uuid)
  };

  const redirects = {
    home: () => {
      navigate('/')
    }
  }

  return (
    <div className="p-4 bg-gray-100 min-h-screen">
        <button 
        onClick={() => redirects.home()} 
        className="absolute top-4 right-4 bg-transparent text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded"
      >
        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <h1 className="text-xl md:text-2xl font-bold text-gray-900 mb-6 text-center">
        Listado de Incidencias
      </h1>
      <div className="space-y-4">
        {notifyUser.length > 0
        ?(
            notifyUser.map((incidencia) => (
                <div
                  key={incidencia.uuid}
                  className="bg-white shadow-lg rounded-lg p-4"
                >
                  <div className="flex justify-between items-center">
                    <div className="flex-1">
                      <h2 className="text-md font-semibold text-gray-800">
                        Estado:{" "}
                        <span className="font-normal">{incidencia.status}</span>
                      </h2>
                      <p className="text-gray-600">
                        Comentario: {incidencia.comment}
                      </p>
                      <p className="text-gray-500 text-sm">
                        Fecha: {incidencia.date}
                      </p>
                    </div>
                    <button
                      onClick={() => marcarComoLeidas(incidencia.uuid)}
                      className="ml-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        className="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                      >
                        <path
                          strokeLinecap="round"
                          strokeLinejoin="round"
                          strokeWidth="2"
                          d="M5 13l4 4L19 7"
                        />
                      </svg>
                    </button>
                  </div>
                </div>
              ))
        )
    : (
        <div className="text-center p-4 max-w-sm mx-auto bg-white rounded-lg border border-gray-200 shadow-md">
          <svg xmlns="http://www.w3.org/2000/svg" className="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
            <path strokeLinecap="round" strokeLinejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <h3 className="mb-2 text-lg font-semibold text-gray-900">No hay notificaciones</h3>
          <p className="text-gray-700">No tienes nuevas notificaciones en este momento. ¡Todo está tranquilo!</p>
        </div>
      )}
      </div>
    </div>
  );
};

export default Page;
