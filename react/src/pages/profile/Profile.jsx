import React from "react";
import { useEffect } from "react";
import { useAuth } from '@/hooks/auth/useAuth'
import { useNavigate } from 'react-router-dom';

const Profile = () => {
  const { useProfile, profileRents, profileData, setProfile } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    useProfile();
  }, [setProfile]);

  return (
    <div className="min-h-screen bg-blue-50 p-4">
  <div className="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md">
    <div className="px-6 py-8">
      <h2 className="text-2xl font-semibold text-blue-600">Perfil del Usuario</h2>
      <div className="mt-6">
        <div className="text-base text-gray-600">
          <p>ID: {profileData.id}</p>
          <p>Username: {profileData.username}</p>
          <p>Email: {profileData.email}</p>
          <p>Tipo: {profileData.type}</p>
        </div>
      </div>
    </div>
    {profileRents ? (
      profileRents.map((rent, index) => (
        <div key={index} className={`mx-4 my-4 py-4 px-6 rounded-lg shadow-lg ${index % 5 === 0 ? 'bg-red-100' : index % 5 === 1 ? 'bg-green-100' : index % 5 === 2 ? 'bg-blue-100' : index % 5 === 3 ? 'bg-yellow-100' : 'bg-purple-100'}`}>
          <h3 className="text-lg font-semibold text-gray-800">Alquiler {index + 1}</h3>
          <div className="text-sm text-gray-700 mt-2">
            {/* <p>UUID Bicicleta: {rent.uuid_bike}</p>
            <p>Estación de origen: {rent.uuid_station_origin}</p>
            <p>Estación de destino: {rent.uuid_station_destination}</p> */}
            <p>Estado: {rent.status}</p>
            <p>Inicio: {rent.datetime_start}</p>
            <p>Fin: {rent.datetime_finish}</p>
          </div>
        </div>
      ))
    ) : undefined}
  </div>
</div>


  );
};

export default Profile;
