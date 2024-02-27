import React, { useContext, useState } from 'react';
import { motion, useAnimation } from 'framer-motion';
import './homeWelcome.css';
import { useNavigate } from 'react-router-dom';
import AuthContext  from "@/context/auth/AuthContext"
import { useAuth } from '@/hooks/auth/useAuth';

const HomeWelcome = () => {
  const controls = useAnimation();
  const homeDataControls = useAnimation();
  const [statusExpand, setStatusExpand] = useState(false);
  const navigate = useNavigate();
  const { user, isAuth } = useContext(AuthContext);
  const { useLogout } = useAuth();

  const expand = () => {
    setStatusExpand(!statusExpand);
    controls.start({ y: '10px' });
    homeDataControls.start({ height: '600px', justifyContent: 'initial' });
  }

  const collapse = () => {
    setStatusExpand(!statusExpand);
    controls.start({ y: '0%' });
    homeDataControls.start({ height: '150px', justifyContent: 'center' });
  }

  const redirects = {
    login: () => {
      navigate('/login')
    },
    register: () => {
      navigate('/register')
    },
    rentqr: () => {
      navigate('/rentQR')
    },
    profile: () => {
      navigate('/profile')
    }
  }

  const viewExpand = statusExpand ? (
    <>        
      <div id="user-info" className="p-4 bg-white shadow-lg rounded-lg m-4">
        <h1 className="text-xl font-semibold text-gray-800">Información de Usuario</h1>
        <p className="mt-2 text-gray-600"><strong>Nombre de usuario:</strong> <span className="text-gray-700">{user.username}</span></p>
        <p className="mt-2 text-gray-600"><strong>Correo electrónico:</strong> <span className="text-gray-700">{user.email}</span></p>
        <p className="mt-2 text-gray-600"><strong>Plan:</strong> <span className="text-green-500">Premium</span></p>
      </div>
    </>
  ) : ( 
      <>
      </>
  )

  const view = isAuth ? (
    <>
        <span>Bienvenido a bikesOnt</span>
        <div className='home_buttons'>
          <button className='home_button' onClick={() => redirects.profile()}>Profile</button>
          <span>o</span>
          <button className="home_button" onClick={() => useLogout()}>Logout</button>
        </div> 

        {viewExpand}
    </>
  ) : ( 
      <>
        <span>Bienvenido a bikesOnt</span>
        <div className='home_buttons'>
          <button className='home_button' onClick={() => redirects.register()}>Registrarse</button>
          <span>o</span>
          <button className="home_button" onClick={() => redirects.login()}>Acceder</button>
        </div> 
      </>
  )

  return (
    <motion.div className="container"
      drag="y"
      dragConstraints={{ top: 0, bottom: 0 }}
      onDragEnd={(event, info) => {
        const dragThreshold = window.innerHeight * 0.30;
        if (Math.abs(info.point.y) >= dragThreshold) {
          statusExpand ?
            collapse() :
            expand();
        } else {
          collapse();
        }
      }}
      animate={controls}
    >
      <motion.div className='home_data_initial' animate={homeDataControls}>
        {view}
      </motion.div>
    </motion.div>
  );
};

export default HomeWelcome;
