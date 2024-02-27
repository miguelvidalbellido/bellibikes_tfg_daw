import React from 'react';
import bikeImage from './bike_home.png';

const HomeDesktop = () => {
  return (
    <div className="space-y-32">
      {/* Sección de Introducción */}
      <div className="flex flex-col md:flex-row items-center justify-around my-10 mx-4 md:mx-20 pt-16">
        <div className="md:w-1/2 animate-fade-in-up">
          <h2 className="text-4xl font-bold text-gray-800 mb-4">
            OntiBikes - Alquiler de Bicicletas Eléctricas
          </h2>
          <p className="text-gray-600 text-lg">
            Explora la ciudad de una forma divertida, ecológica y eficiente. 
            Con OntiBikes, descubre la alegría de moverte con nuestras bicicletas eléctricas de última generación.
          </p>
        </div>
        <div className="md:w-1/2 flex justify-center mt-8 md:mt-0 animate-fade-in-down">
          <img src={bikeImage} alt="Bicicleta Eléctrica" className="rounded-lg shadow-xl w-full max-w-sm"/>
        </div>
      </div>

      {/* Sección de Cómo Funciona */}
      <div className="bg-gray-100 py-16">
        <div className="text-center">
          <h3 className="text-3xl font-bold text-gray-800">¿Cómo Funciona?</h3>
          <p className="text-gray-600 mt-2">Alquilar una OntiBike es fácil y rápido</p>
        </div>
        <div className="flex flex-col md:flex-row justify-around mt-8 mx-4 md:mx-20 space-y-4 md:space-y-0">
          <div className="animate-fade-in-left">
            <h4 className="text-xl font-semibold">1. Elige tu Bicicleta</h4>
            <p>Explora nuestra gama y selecciona la bicicleta que más te guste.</p>
          </div>
          <div className="animate-fade-in-up">
            <h4 className="text-xl font-semibold">2. Haz tu Reserva</h4>
            <p>Reserva tu bicicleta en pocos clics desde nuestra app.</p>
          </div>
          <div className="animate-fade-in-right">
            <h4 className="text-xl font-semibold">3. ¡Disfruta del Viaje!</h4>
            <p>Recoge tu bicicleta y disfruta de un paseo inolvidable.</p>
          </div>
        </div>
      </div>

      {/* Sección de Testimonios */}
      <div className="text-center py-8">
      <h3 className="text-3xl font-bold text-gray-800">Testimonios</h3>
      <p className="text-gray-600 mt-2">Lo que nuestros usuarios dicen de nosotros</p>
      
      <div className="flex flex-wrap justify-center mt-8 gap-4">
        {/* Testimonio 1 */}
        <div className="max-w-md p-4 bg-white shadow-lg rounded-lg mx-4 animate-fade-in-right">
          <img src={bikeImage} alt="Usuario" className="rounded-full w-20 h-20 mx-auto"/>
          <p className="text-gray-600 mt-4">"Alquilar una OntiBike ha cambiado mi forma de moverme por la ciudad. Es rápido, divertido y ecológico. ¡Totalmente recomendado!"</p>
          <p className="font-bold mt-2">- Nombre del Usuario</p>
        </div>

        {/* Testimonio 2 */}
        <div className="max-w-md p-4 bg-white shadow-lg rounded-lg mx-4 animate-fade-in-right">
          <img src={bikeImage} alt="Usuario" className="rounded-full w-20 h-20 mx-auto"/>
          <p className="text-gray-600 mt-4">"Alquilar una OntiBike ha cambiado mi forma de moverme por la ciudad. Es rápido, divertido y ecológico. ¡Totalmente recomendado!"</p>
          <p className="font-bold mt-2">- Nombre del Usuario</p>
        </div>

        {/* Testimonio 3 */}
        <div className="max-w-md p-4 bg-white shadow-lg rounded-lg mx-4 animate-fade-in-right">
          <img src={bikeImage} alt="Usuario" className="rounded-full w-20 h-20 mx-auto"/>
          <p className="text-gray-600 mt-4">"Alquilar una OntiBike ha cambiado mi forma de moverme por la ciudad. Es rápido, divertido y ecológico. ¡Totalmente recomendado!"</p>
          <p className="font-bold mt-2">- Nombre del Usuario</p>
        </div>
      </div>
    </div>
    </div>
  );
};


export default HomeDesktop;