import React, { useEffect } from "react";
import { useNavigate } from 'react-router-dom';
import { useAuth } from '@/hooks/auth/useAuth';
import Lottie from 'react-lottie';
import animationData from '@/assets/animations/profile_animation.json'; 

const Profile = () => {
  const { useProfile, profileRents, profileData } = useAuth();
  const navigate = useNavigate();

  useEffect(() => {
    useProfile();
  }, [useProfile]);

  // Opciones para la animación Lottie
  const defaultOptions = {
    loop: true,
    autoplay: true,
    animationData: animationData,
    rendererSettings: {
      preserveAspectRatio: 'xMidYMid slice'
    }
  };

  return (
    <div className="min-h-screen bg-green-50 p-4 flex flex-col items-center">
      <div className="w-full max-w-md bg-white rounded-lg overflow-hidden shadow-md">
        {/* Animación Lottie en la parte superior */}
        <div className="w-full">
          <Lottie options={defaultOptions} height={200} width={200} />
        </div>
        <div className="px-6 py-8">
          <h2 className="text-2xl font-semibold text-center text-green-600">{profileData.username}</h2>
          <div className="mt-6">
            <div className="text-base text-gray-600 text-center">
              {/* <p>Username: {profileData.username}</p> */}
              <p>Email: {profileData.email}</p>
              <p>Tipo: {profileData.type}</p>
            </div>
          </div>
        </div>
        {profileRents && profileRents.map((rent, index) => (
          <div key={index} className={`mx-4 my-4 py-4 px-6 rounded-lg shadow-lg ${index % 5 === 0 ? 'bg-red-100' : index % 5 === 1 ? 'bg-green-100' : index % 5 === 2 ? 'bg-blue-100' : index % 5 === 3 ? 'bg-yellow-100' : 'bg-purple-100'}`}>
            <h3 className="text-lg font-semibold text-gray-800">Alquiler {index + 1}</h3>
            <div className="text-sm text-gray-700 mt-2">
              <p>Estado: {rent.status}</p>
              <p>Inicio: {rent.datetime_start}</p>
              <p>Fin: {rent.datetime_finish}</p>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Profile;
