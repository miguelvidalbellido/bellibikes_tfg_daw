import React, { useState } from 'react';
import MenuSVG from '@/assets/icons/menu-icon.svg';
import CloseSVG from '@/assets/icons/close-icon.svg';
import HomeIcon from '@/assets/icons/stats.svg';
import IssueIcon from '@/assets/icons/check.svg';
import ProductIcon from '@/assets/icons/scanner.svg';
import { useNavigate } from "react-router-dom";
import { useAuth } from '@/hooks/auth/useAuth';

const Navbar = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const navigate = useNavigate()
  const { user } = useAuth()

  return (
    
    <nav className='bg-white border-b-2'>
      <div className='max-w-6xl mx-auto px-4'>
        <div className='flex justify-between'>
          <div>
            {/* Website Logo */}
            <a onClick={() => navigate('/')} className='flex items-center py-4 px-2'>
              {/* <img src='path-to-your-logo.svg' alt='Logo' className='h-8 w-8 mr-2' /> */}
              <span className='font-semibold text-orange-500 text-lg cursor-pointer'>BelliBikes</span>
            </a>
          </div>
          {/* Primary Navbar items */}
          <div className='hidden md:flex items-center space-x-1'>
            <a onClick={() => navigate('/')} className='py-4 px-2 text-gray-500 font-semibold hover:text-orange-400 flex items-center cursor-pointer'>
            <img src={HomeIcon} alt="Inicio" className="h-5 w-5 mr-2" />
            Inicio
            </a>
            <a onClick={() => navigate('/incidents')} className='py-4 px-2 text-gray-500 font-semibold hover:text-orange-400 flex items-center cursor-pointer'>
            <img src={IssueIcon} alt="Incidencias" className="h-5 w-5 mr-2" />
            Incidencias
            </a>
            <a  onClick={() => navigate('/scan')} className='py-4 px-2 text-gray-500 font-semibold hover:text-orange-400 flex items-center cursor-pointer'>
            <img src={ProductIcon} alt="Escaner" className="h-5 w-5 mr-2 " />
            Escaner
            </a>
        </div>
          {/* Secondary Navbar items */}
          <div className='hidden md:flex items-center space-x-3'>
          <img src='https://picsum.photos/200/300' alt='Perfil de John Doe' className='w-10 h-10 rounded-full border border-gray-300' />
            <a href='#' className='py-4 px-2 text-gray-500 font-semibold flex items-center'>
                {user.username}
            </a>
            </div>
          {/* Mobile menu button */}
          <div className='md:hidden flex items-center'>
            <button type='button' onClick={() => setIsMenuOpen(!isMenuOpen)}>
              <img src={isMenuOpen ? CloseSVG : MenuSVG} alt={isMenuOpen ? 'Cerrar' : 'Menú'} className="h-6 w-6" />
            </button>
          </div>
        </div>
      </div>
      {/* Mobile Menu */}
      <div className={`absolute top-0 inset-x-0 mr-4 p-2 transition transform origin-top-right ${isMenuOpen ? 'block' : 'hidden'}`}>
        <div className='rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden'>
          <div className='px-5 pt-4 flex items-center justify-between'>
            <div>
              <img className='h-8 w-auto' src='path-to-your-logo.svg' alt='' />
            </div>
            <div className='-mr-2'>
              <button type='button' onClick={() => setIsMenuOpen(false)}>
                <img src={CloseSVG} alt='Cerrar' className="h-6 w-6" />
              </button>
            </div>
          </div>
          <div className='px-2 pt-2 pb-3 space-y-1'>
            <a  onClick={() => navigate('/')} className='block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50'>Inicio</a>
            <a  onClick={() => navigate('/incidents')} className='block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50'>Incidencias</a>
            <a  onClick={() => navigate('/scan')} className='block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50'>Escaner</a>
          </div>
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
