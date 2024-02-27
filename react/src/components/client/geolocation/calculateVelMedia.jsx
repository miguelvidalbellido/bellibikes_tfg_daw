export const calculateVelocity = (startCoords, endCoords) => {

  function ajustarNumero(num) {
    let numAjustado = num.toFixed(1);
  
    let partes = numAjustado.split('.');
  
    if (partes[0].length > 2) {
      partes[0] = partes[0].substring(partes[0].length - 2);
    }

    numAjustado = partes.join('.');
  
    return parseFloat(numAjustado);
  }

  const haversine = (lat1, lon1, lat2, lon2) => {
    const r = 6371; 
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return r * c; // Distancia en km
  };
  

    const distance = haversine(startCoords.lat, startCoords.lng, endCoords.lat, endCoords.lng);
    const timeHours = 10 / 3600;
    const velocityKmh = distance / timeHours;

  
  return ajustarNumero(velocityKmh);
};
