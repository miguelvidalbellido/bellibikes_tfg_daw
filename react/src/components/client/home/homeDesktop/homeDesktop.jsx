import React from 'react';
import bikeImage from './bike_home.png';
import puzzle from '@/assets/atis-assets/elements/puzzle.svg'
import userCircle from '@/assets/atis-assets/elements/user-circle.svg'
import thumb from '@/assets/atis-assets/elements/thumb-up.svg'
import terminal from '@/assets/atis-assets/elements/terminal.svg'
import greenDark from '@/assets/atis-assets/elements/green-dark-up.svg'
import bulletRight from '@/assets/atis-assets/elements/bullets-gray-right.svg'
import bulletLeft from '@/assets/atis-assets/elements/bullets-gray-left.svg'
import portadaimg from '@/assets/imgs/portada_reduce.webp'
import bicis1 from '@/assets/imgs/bicis1.webp'
import bicis2 from '@/assets/imgs/bicis2.webp'
import bicis3 from '@/assets/imgs/bicis3.webp'

const HomeDesktop = () => {
  return (
<>
     
<section className='relative bg-gray-50 md:mt-10'>
          
          <div className='relative bg-gray-50 pt-12 lg:pt-20 pb-12 md:pb-24'>
            <div className='container mx-auto px-4'>
              <div className='flex flex-wrap -mx-4'>
                <div className='w-full lg:w-1/2 px-4 mb-12 md:mb-20 lg:mb-0 flex items-center'>
                  <div className='w-full text-center lg:text-left'>
                    <div className='max-w-md mx-auto lg:mx-0'>
                      <h2 className='mb-3 text-4xl lg:text-5xl font-bold font-heading'>
                        <span>Muevete sin&nbsp;</span>
                        <span className='text-green-600'>problemas</span>
                      </h2>
                    </div>
                    <div className='max-w-sm mx-auto lg:mx-0'>
                      <p className='mb-6 text-gray-400 leading-loose'>
                        Bellibikes facilita la movilidad en tu municpio para que
                        te despreocupes de vehículos
                      </p>
                      <div>
                        <a
                          className='inline-block mb-3 lg:mb-0 lg:mr-3 w-full lg:w-auto py-2 px-6 leading-loose bg-green-600 hover:bg-green-700 text-white font-semibold rounded-l-xl rounded-t-xl transition duration-200'
                          href='#'
                        >
                          Iniciate
                        </a>
                        <a
                          className='inline-block w-full lg:w-auto py-2 px-6 leading-loose font-semibold bg-white hover:bg-gray-50 rounded-l-xl rounded-t-xl transition duration-200'
                          href='#'
                        >
                          Como funciona
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <div className='w-full lg:w-1/2 px-4 flex items-center justify-center'>
                  <div className='relative' style={{ zIndex: 0 }}>
                    <img
                      className='h-96 w-full max-w-lg object-cover rounded-3xl md:rounded-br-none'
                      src={portadaimg}
                      alt=''
                    />
                    <img
                      className='hidden md:block absolute'
                      style={{ top: '-2rem', right: '3rem', zIndex: -1 }}
                      src={greenDark}
                      alt=''
                    />
                    <img
                      className='hidden md:block absolute'
                      style={{ bottom: '-2rem', right: '-2rem', zIndex: -1 }}
                      src={greenDark}
                      alt=''
                    />
                    <img
                      className='hidden md:block absolute'
                      style={{ top: '3rem', right: '-3rem', zIndex: -1 }}
                      src={bulletRight}
                      alt=''
                    />
                    <img
                      className='hidden md:block absolute'
                      style={{ bottom: '2.5rem', left: '-4.5rem', zIndex: -1 }}
                      src={bulletLeft}
                      alt=''
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className='hidden navbar-menu fixed top-0 left-0 bottom-0 w-5/6 max-w-sm z-50'>
            <div className='navbar-backdrop fixed inset-0 bg-gray-800 opacity-25' />
            <nav className='relative flex flex-col py-6 px-6 h-full w-full bg-white border-r overflow-y-auto'>
              <div className='flex items-center mb-8'>
                <a className='mr-auto text-3xl font-bold leading-none' href='#'>
                  <img
                    className='h-10'
                    src='atis-assets/logo/atis/atis-mono-black.svg'
                    alt=''
                    width='auto'
                  />
                </a>
                <button className='navbar-close'>
                  <svg
                    className='h-6 w-6 text-gray-400 cursor-pointer hover:text-gray-500'
                    xmlns='http://www.w3.org/2000/svg'
                    fill='none'
                    viewBox='0 0 24 24'
                    stroke='currentColor'
                  >
                    <path
                      strokeLinecap='round'
                      strokeLinejoin='round'
                      strokeWidth={2}
                      d='M6 18L18 6M6 6l12 12'
                    />
                  </svg>
                </button>
              </div>
              <div>
                <ul>
                  <li className='mb-1'>
                    <a
                      className='block p-4 text-sm font-semibold text-gray-400 hover:bg-green-50 hover:text-green-600 rounded'
                      href='#'
                    >
                      Start
                    </a>
                  </li>
                  <li className='mb-1'>
                    <a
                      className='block p-4 text-sm font-semibold text-gray-400 hover:bg-green-50 hover:text-green-600 rounded'
                      href='#'
                    >
                      About Us
                    </a>
                  </li>
                  <li className='mb-1'>
                    <a
                      className='block p-4 text-sm font-semibold text-gray-400 hover:bg-green-50 hover:text-green-600 rounded'
                      href='#'
                    >
                      Services
                    </a>
                  </li>
                  <li className='mb-1'>
                    <a
                      className='block p-4 text-sm font-semibold text-gray-400 hover:bg-green-50 hover:text-green-600 rounded'
                      href='#'
                    >
                      Platform
                    </a>
                  </li>
                  <li className='mb-1'>
                    <a
                      className='block p-4 text-sm font-semibold text-gray-400 hover:bg-green-50 hover:text-green-600 rounded'
                      href='#'
                    >
                      Testimonials
                    </a>
                  </li>
                </ul>
              </div>
              <div className='mt-auto'>
                <div className='pt-6'>
                  <a
                    className='block px-4 py-3 mb-3 leading-loose text-xs text-center font-semibold leading-none bg-gray-50 hover:bg-gray-100 rounded-l-xl rounded-t-xl'
                    href='#'
                  >
                    Sign In
                  </a>
                  <a
                    className='block px-4 py-3 mb-2 leading-loose text-xs text-center text-white font-semibold bg-green-600 hover:bg-green-700 rounded-l-xl rounded-t-xl'
                    href='#'
                  >
                    Sign Up
                  </a>
                </div>
                <p className='my-4 text-xs text-center text-gray-400'>
                  <span>© 2020 All rights reserved.</span>
                </p>
                <div className='text-center'>
                  <a className='inline-block px-1' href='#'>
                    <img src='atis-assets/social/facebook.svg' alt='' />
                  </a>
                  <a className='inline-block px-1' href='#'>
                    <img src='atis-assets/social/twitter.svg' alt='' />
                  </a>
                  <a className='inline-block px-1' href='#'>
                    <img src='atis-assets/social/instagram.svg' alt='' />
                  </a>
                </div>
              </div>
            </nav>
          </div>
        </section>
        <section className='py-20 bg-gray-50'>
          <div className='container mx-auto px-4'>
            <div className='flex flex-wrap text-center -mx-4'>
              <div className='mb-8 w-full lg:w-1/4 px-4'>
                <div className='relative py-10 bg-white shadow rounded'>
                  <img
                    className='h-40 absolute inset-0 mt-2 mx-auto'
                    src={puzzle}
                    alt=''
                  />
                  <h4 className='mb-1 text-green-600'>Ahorro medio</h4>
                  <span className='text-3xl lg:text-4xl font-bold'>
                    2.110 €
                  </span>
                </div>
              </div>
              <div className='mb-8 w-full lg:w-1/4 px-4'>
                <div className='relative py-10 bg-white shadow rounded'>
                  <img
                    className='h-40 absolute inset-0 mt-2 mx-auto'
                    src={userCircle}
                    alt=''
                  />
                  <h4 className='mb-2 text-green-600'>Usuarios Actuales</h4>
                  <span className='text-3xl lg:text-4xl font-bold'>
                    122.102
                  </span>
                </div>
              </div>
              <div className='mb-8 w-full lg:w-1/4 px-4'>
                <div className='relative py-10 bg-white shadow rounded'>
                  <img
                    className='h-40 absolute inset-0 mt-2 mx-auto'
                    src={thumb}
                    alt=''
                  />
                  <h4 className='mb-2 text-green-600'>Alquileres diarios</h4>
                  <span className='text-3xl lg:text-4xl font-bold'>
                    35.120
                  </span>
                </div>
              </div>
              <div className='mb-8 w-full lg:w-1/4 px-4'>
                <div className='relative py-10 bg-white shadow rounded'>
                  <img
                    className='h-40 absolute inset-0 mt-2 mx-auto'
                    src={terminal}
                    alt=''
                  />
                  <h4 className='mb-2 text-green-600'>Reducción de contaminación</h4>
                  <span className='text-3xl lg:text-4xl font-bold'>23%</span>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section>
          <div className='skew skew-top mr-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 10 0 10' />
            </svg>
          </div>
          <div className='skew skew-top ml-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 10 10 0 10 10' />
            </svg>
          </div>
          <div className='py-20 bg-gray-50 radius-for-skewed'>
            <div className='container mx-auto px-4'>
              <div className='flex flex-wrap items-center -mx-4'>
                <div className='mb-12 lg:mb-0 w-full lg:w-1/2 px-4'>
                  <div className='max-w-md'>
                    {/* <span className='text-green-600 font-bold'>
                      Dolor sit amet consectutar
                    </span> */}
                    <h2 className='mb-6 text-4xl lg:text-5xl font-bold font-heading'>
                      Un estilo saludable y sostenible
                    </h2>
                    <ul>
                      <li className='flex mb-4'>
                        <div>
                          <svg
                            className='mr-3 w-8 h-8 text-green-600'
                            xmlns='http://www.w3.org/2000/svg'
                            fill='none'
                            viewBox='0 0 24 24'
                            stroke='currentColor'
                          >
                            <path
                              strokeLinecap='round'
                              strokeLinejoin='round'
                              strokeWidth={2}
                              d='M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'
                            />
                          </svg>
                        </div>
                        <div className='max-w-xs'>
                          <h3 className='font-bold font-heading'>
                            Registro sin complicaciones
                          </h3>
                          <p className='text-gray-500 leading-loose'>
                            Con BelliBikes, el proceso de registro es rápido y sin
                            complicaciones.
                          </p>
                        </div>
                      </li>
                      <li className='flex mb-4'>
                        <div>
                          <svg
                            className='mr-3 w-8 h-8 text-green-600'
                            xmlns='http://www.w3.org/2000/svg'
                            fill='none'
                            viewBox='0 0 24 24'
                            stroke='currentColor'
                          >
                            <path
                              strokeLinecap='round'
                              strokeLinejoin='round'
                              strokeWidth={2}
                              d='M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'
                            />
                          </svg>
                        </div>
                        <div className='max-w-xs'>
                          <h3 className='font-bold font-heading'>
                            Seguridad y conveniencia
                          </h3>
                          <p className='text-gray-500 leading-loose'>
                            La seguridad es una prioridad en BelliBikes
                          </p>
                        </div>
                      </li>
                      <li className='flex'>
                        <div>
                          <svg
                            className='mr-3 w-8 h-8 text-green-600'
                            xmlns='http://www.w3.org/2000/svg'
                            fill='none'
                            viewBox='0 0 24 24'
                            stroke='currentColor'
                          >
                            <path
                              strokeLinecap='round'
                              strokeLinejoin='round'
                              strokeWidth={2}
                              d='M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'
                            />
                          </svg>
                        </div>
                        <div className='max-w-xs'>
                          <h3 className='font-bold font-heading'>
                            Tarifas flexibles y transparentes
                          </h3>
                          <p className='text-gray-500 leading-loose'>
                            Desde alquileres por hora hasta suscripciones
                            anuales.
                          </p>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <div className='flex flex-wrap items-center w-full lg:w-1/2 px-4'>
                  <div className='mb-6 w-full lg:w-1/2 px-3'>
                    <img
                      className='mb-6 w-full h-64 object-cover rounded-lg'
                      src={bicis1}
                      alt='Imagen de gente en atardecer con las bicis'
                    />
                    <img
                      className='w-full h-64 object-cover rounded-lg'
                      src={bicis2}
                      alt='Imagen de gente con las bicis eléctricas'
                    />
                  </div>
                  <div className='w-full lg:w-1/2 px-3'>
                    <img
                      className='w-full h-64 object-cover rounded-lg'
                      src={bicis3}
                      alt='Imagen de amigos con las bicis'
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className='skew skew-bottom mr-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 0 0 10' />
            </svg>
          </div>
          <div className='skew skew-bottom ml-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 0 10 10' />
            </svg>
          </div>
        </section>
        <section>
          <div className='skew skew-top mr-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 10 0 10' />
            </svg>
          </div>
          <div className='skew skew-top ml-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 10 10 0 10 10' />
            </svg>
          </div>
          <div className='py-20 bg-gray-50 radius-for-skewed'>
            <div className='container mx-auto px-4'>
              <div className='max-w-xl mx-auto mb-10 text-center'>
                <span className='text-green-600 font-bold'>
                  Te contamos un poco más
                </span>
                <h2 className='text-4xl lg:text-5xl font-bold font-heading'>
                  Conoce nuestro increíble equipo
                </h2>
              </div>
              <div className='flex flex-wrap'>
                <div className='mb-6 w-full md:w-1/2 lg:w-1/3 px-3'>
                  <div className='py-24 bg-white rounded shadow text-center'>
                    <img
                      className='mx-auto mb-8 w-24 h-24 rounded-full object-cover'
                      src='https://images.unsplash.com/photo-1580852300654-03c803a14e24?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80'
                      alt=''
                    />
                    <h4 className='mb-2 text-2xl font-bold font-heading'>
                      Danny Bailey
                    </h4>
                    <p className='text-gray-500'>CEO</p>
                  </div>
                </div>
                <div className='mb-6 w-full md:w-1/2 lg:w-1/3 px-3'>
                  <div className='py-24 bg-white rounded shadow text-center'>
                    <img
                      className='mx-auto mb-8 w-24 h-24 rounded-full object-cover'
                      src='https://images.unsplash.com/photo-1559548331-f9cb98001426?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80'
                      alt=''
                    />
                    <h4 className='mb-2 text-2xl font-bold font-heading'>
                      Ian Brown
                    </h4>
                    <p className='text-gray-500'>Head of Development</p>
                  </div>
                </div>
                <div className='mb-6 w-full md:w-1/2 lg:w-1/3 px-3'>
                  <div className='py-24 bg-white rounded shadow text-center'>
                    <img
                      className='mx-auto mb-8 w-24 h-24 rounded-full object-cover'
                      src='https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80'
                      alt=''
                    />
                    <h4 className='mb-2 text-2xl font-bold font-heading'>
                      Daisy Carter
                    </h4>
                    <p className='text-gray-500'>Product Development</p>
                  </div>
                </div>
                <div className='mb-6 w-full md:w-1/2 lg:w-1/3 px-3'>
                  <div className='py-24 bg-white rounded shadow text-center'>
                    <img
                      className='mx-auto mb-8 w-24 h-24 rounded-full object-cover'
                      src='https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=600&q=80'
                      alt=''
                    />
                    <h4 className='mb-2 text-2xl font-bold font-heading'>
                      Dennis Robertson
                    </h4>
                    <p className='text-gray-500'>Frontend Developer</p>
                  </div>
                </div>
                <div className='mb-6 w-full md:w-1/2 lg:w-1/3 px-3'>
                  <div className='py-24 bg-white rounded shadow text-center'>
                    <img
                      className='mx-auto mb-8 w-24 h-24 rounded-full object-cover'
                      src='https://images.unsplash.com/photo-1484588168347-9d835bb09939?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80'
                      alt=''
                    />
                    <h4 className='mb-2 text-2xl font-bold font-heading'>
                      Alice Bradley
                    </h4>
                    <p className='text-gray-500'>Backend Developer</p>
                  </div>
                </div>
                <div className='mb-6 w-full md:w-1/2 lg:w-1/3 px-3'>
                  <div className='py-24 bg-white rounded shadow text-center'>
                    <img
                      className='mx-auto mb-8 w-24 h-24 rounded-full object-cover'
                      src='https://images.unsplash.com/photo-1604072366595-e75dc92d6bdc?ixid=MXwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8MTB8fHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=600'
                      alt=''
                    />
                    <h4 className='mb-2 text-2xl font-bold font-heading'>
                      Sahra Ortiz
                    </h4>
                    <p className='text-gray-500'>Product Designer</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div className='skew skew-bottom mr-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 0 0 10' />
            </svg>
          </div>
          <div className='skew skew-bottom ml-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 0 10 10' />
            </svg>
          </div>
        </section>
        <section>
          <div className='skew skew-top mr-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 10 0 10' />
            </svg>
          </div>
          <div className='skew skew-top ml-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 10 10 0 10 10' />
            </svg>
          </div>
          <div className='py-20 bg-gray-50 radius-for-skewed'>
            <div className='container mx-auto px-4'>
              <div className='mb-20 lg:mb-40 max-w-2xl mx-auto text-center'>
                <a
                  className='inline-block mb-6 mx-auto text-3xl font-bold leading-none'
                  href='#'
                >
                  <img
                    className='h-12'
                    src='atis-assets/logo/atis/atis-mono-sign.svg'
                    alt=''
                    width='auto'
                  />
                </a>
                <h2 className='mb-4 text-4xl lg:text-5xl font-bold'>
                  Mucho más que una empresa de alquiler de bicis
                </h2>
                <p className='mb-6 max-w-md mx-auto text-gray-500 leading-loose'>
                  Muévete libremente ayudando a crear un mundo más sostenible.
                </p>
                <a
                  className='inline-block py-2 px-6 bg-green-600 hover:bg-green-700 text-white font-bold rounded-l-xl rounded-t-xl'
                  href='#'
                >
                  Únete
                </a>
              </div>
              <div className='relative flex flex-wrap justify-between'>
                <div className='w-full lg:w-1/3 mb-6'>
                  <ul className='flex flex-wrap justify-center'>
                    <li className='mr-6'>
                      <a className='hover:text-gray-600' href='#'>
                        Inicio
                      </a>
                    </li>
                    <li className='mr-6'>
                      <a className='hover:text-gray-600' href='#'>
                        Precios
                      </a>
                    </li>
                    <li className='mr-6'>
                      <a className='hover:text-gray-600' href='#'>
                        Sobre Nosotros
                      </a>
                    </li>
                    <li>
                      <a className='hover:text-gray-600' href='#'>
                        Contacto
                      </a>
                    </li>
                  </ul>
                </div>
                <div className='mb-6 w-full lg:w-auto lg:absolute lg:left-1/2 lg:transform lg:-translate-x-1/2 flex justify-center lg:space-x-4'>
                  <a href='#'>
                    <img src='atis-assets/social/facebook.svg' alt='' />
                  </a>
                  <a href='#'>
                    <img src='atis-assets/social/twitter.svg' alt='' />
                  </a>
                  <a href='#'>
                    <img src='atis-assets/social/instagram.svg' alt='' />
                  </a>
                </div>
                <div className='w-full lg:w-1/3 flex justify-center lg:justify-end'>
                  <span>BelliBikes, Inc.</span>
                </div>
              </div>
            </div>
          </div>
          <div className='skew skew-bottom mr-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 0 0 10' />
            </svg>
          </div>
          <div className='skew skew-bottom ml-for-radius'>
            <svg
              className='h-8 md:h-12 lg:h-20 w-full text-gray-50'
              viewBox='0 0 10 10'
              preserveAspectRatio='none'
            >
              <polygon fill='currentColor' points='0 0 10 0 10 10' />
            </svg>
          </div>
        </section>
</>
  );
};


export default HomeDesktop;