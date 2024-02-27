import React, { useState, useEffect, useContext } from "react";
import { useParams } from "react-router-dom";
import AuthContextProvider from "@/context/auth/AuthContext";
import { useNavigate } from "react-router-dom";
import { useBikes } from "@/hooks/bikes/useBikes";
import iconBike from "@/assets/bikeIcons/bike.png";
import slotimg from "@/assets/slotimg.jpg";
import { useRent } from "@/hooks/rent/useRent";
import { useFSProducts } from "@/hooks/FSProducts/useFSProducts";

const qrStartRent = () => {
  const { bikeUUID } = useParams();
  const { isAuth } = useContext(AuthContextProvider);
  const navigate = useNavigate();
  const { useCheckBike, bikeAvailable } = useBikes();
  const [bike, setBike] = useState({});
  const { createRent } = useRent();
  const { checkDataPlan, checkUserPlan } = useFSProducts();

  useEffect(() => {
    if (bikeUUID) {
      console.log("Comprobando disponibilidad...");
      useCheckBike(bikeUUID);
    }

    if (isAuth) {
      checkUserPlan();
    }
  }, [bikeUUID, isAuth]);

  const redirects = {
    login: () => {
      navigate("/login");
    },
    rentView: () => {
      navigate(`/rentView/${bikeUUID}`);
    },
  };

  const view = isAuth ? (
    <div className="flex justify-center items-center h-screen overflow-hidden">
      <div
        className="absolute inset-0 bg-cover bg-center"
        style={{ backgroundImage: `url(${slotimg})` }}
      >
        <div className="absolute inset-0 bg-black opacity-25"></div>
        <div className="absolute inset-0 backdrop-blur"></div>
      </div>

      <div className="relative bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div className="mb-4 flex">
          <div className="w-1/4 mr-2">
            <img src={iconBike} alt="Icono bici" />
          </div>
          <div className="w-3/4">
            <h1 className="text-xl font-bold text-gray-700">
              Información del alquiler
            </h1>
            <p className="text-gray-600"></p>
            <p className="text-gray-600">
              Estado: {bikeAvailable ? "Disponible" : "No Disponible"}
            </p>
          </div>
        </div>

        <div>
          {checkDataPlan ? (
            <div>
              Tiempo restante: {checkDataPlan.available_time} minutos
            </div>
          ) : (
            <div>
            </div>              
          )}
        </div>

        <button
          className={`w-full text-white font-bold py-2 px-4 rounded ${
            bikeAvailable
              ? "bg-blue-500 hover:bg-blue-700"
              : "bg-gray-500 cursor-not-allowed"
          }`}
          onClick={bikeAvailable ? () => createRent({uuid_bike: bikeUUID}) : undefined}
          disabled={!bikeAvailable}
        >
          Iniciar
        </button>
      </div>
    </div>
  ) : (
    <div className="flex justify-center items-center h-screen overflow-hidden">
      <div
        className="absolute inset-0 bg-cover bg-center"
        style={{ backgroundImage: `url(${slotimg})` }}
      >
        <div className="absolute inset-0 bg-black opacity-25"></div>
        <div className="absolute inset-0 backdrop-blur"></div>
      </div>
      <div className="relative bg-white p-4 rounded-lg shadow-md max-w-sm mx-auto">
        <div className="text-center mt-4">
          <p className="text-black-600 hover:text-black-800 text-sm">
            Inicia sesión para poder alquilar una bici
          </p>
        </div>
        <br />
        <div className="w-full bg-blue-500 text-center mb-8 rounded-md p-4">
          <p
            onClick={() => navigate("/login")}
            className="text-xl font-bold text-white cursor-pointer"
          >
            Iniciar sesión
          </p>
        </div>
      </div>
    </div>
  );

  return <>{view}</>;
};

export default qrStartRent;
