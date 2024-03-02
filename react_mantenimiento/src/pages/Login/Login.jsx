import React from 'react';
// import background from '@/assets/flex-ui-assets/elements/pattern-white.svg'
import { useAuth } from '@/hooks/auth/useAuth'
import toast from 'react-hot-toast';

export default function Login() {

  const { useLogin } = useAuth();

  const handleSubmit = (e) => {
    e.preventDefault();
    const username = e.target.username.value;
    const password = e.target.password.value;

    // Comprobar si ambos campos tienen datos
    if (username && password) {
      useLogin({ username, password });
      console.log('Formulario enviado');
    } else {
      toast.error('Porfavor, rellena todos los campos')
    }
  };

  return (

      <section
        className='py-24 md:py-32 bg-white'
        // style={{
        //   backgroundImage: `url(${background})`,
        //   backgroundPosition: 'center',
        // }}
      >
        <div className='container px-4 mx-auto'>
          <div className='max-w-sm mx-auto'>
            <div className='mb-6 text-center'>
              <a className='inline-block mb-6' href='#'>
                <img
                  className='h-16'
                  src='flex-ui-assets/logos/flex-circle-yellow.svg'
                  alt=''
                />
              </a>
              <h3 className='mb-4 text-2xl md:text-3xl font-bold'>
                BelliBikes
              </h3>
              <p className='text-lg text-coolGray-500 font-medium'>
                Panel de mantenimiento de bicicletas
              </p>
            </div>
            <form onSubmit={handleSubmit}>
            <div className='mb-6'>
              <label className='block mb-2 text-coolGray-800 font-medium' htmlFor='username'>
                Usuario
              </label>
              <input
                name='username'
                className='appearance-none block w-full p-3 leading-5 text-coolGray-900 border border-coolGray-200 rounded-lg shadow-md placeholder-coolGray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50'
                type='text'
                placeholder='BelliBikesMant'
              />
            </div>
            <div className='mb-4'>
              <label className='block mb-2 text-coolGray-800 font-medium' htmlFor='password'>
                Contraseña
              </label>
              <input
                name='password'
                className='appearance-none block w-full p-3 leading-5 text-coolGray-900 border border-coolGray-200 rounded-lg shadow-md placeholder-coolGray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50'
                type='password'
                placeholder='************'
              />
            </div>
            <button
              type='submit'
              className='inline-block py-3 px-7 mb-6 w-full text-base text-yellow-50 font-medium text-center leading-6 bg-yellow-500 hover:bg-yellow-600 focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 rounded-md shadow-sm'
            >
              Iniciar sesión
            </button>
          </form>
          </div>
        </div>
      </section>
  );
}

