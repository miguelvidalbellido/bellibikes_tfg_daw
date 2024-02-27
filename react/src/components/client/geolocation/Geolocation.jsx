import React, { useEffect, useState } from 'react';

const GeoLocationComponent = ({ onLocationFetch }) => {
  const [locationStatus, setLocationStatus] = useState('Cargando...');
  const defaultLocation = { lat: 26.0546106, lng: -98.3939791 }; // Ubicación predeterminada en caso de error

  useEffect(() => {
    // Verifica si la geolocalización está soportada
    if (!navigator.geolocation) {
      setLocationStatus('Geolocalización no soportada por este navegador.');
      return;
    }

    const getLocation = () => {
      const successHandler = (position) => {
        // Actualiza el estado con la ubicación actual
        const { latitude, longitude } = position.coords;
        onLocationFetch({ lat: latitude, lng: longitude });
        setLocationStatus(`Ubicación obtenida: ${latitude}, ${longitude}`);
      };

      const errorHandler = (error) => {
        // Actualiza el estado con la ubicación predeterminada en caso de error
        onLocationFetch(defaultLocation);
        setLocationStatus(`Error ${error.code}: ${error.message}. Usando ubicación predeterminada: ${defaultLocation.lat}, ${defaultLocation.lng}`);
      };

      // Opciones para la solicitud de geolocalización
      const options = {
        enableHighAccuracy: true, // Usa el GPS si está disponible
        maximumAge: 10000, // Acepta posiciones cacheadas de hasta 10000 ms
      };

      navigator.geolocation.getCurrentPosition(successHandler, errorHandler, options);
    };

    // Llama a getLocation cada 10 segundos
    const intervalId = setInterval(getLocation, 10000);

    // Limpieza al desmontar el componente
    return () => clearInterval(intervalId);
  }, [onLocationFetch]);

//   return <div>{locationStatus}</div>;
};

export default GeoLocationComponent;
