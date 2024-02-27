import React, { useEffect, useState, useContext } from "react"
import { useNavigate, useLocation } from "react-router-dom"
import profileImgTest from './profile_test.webp'
import AuthContext from '@/context/auth/AuthContext'
import { useAuth } from '@/hooks/auth/useAuth'

const NavbarWeb = () => {

    const { user, isAuth, isAdmin} = useContext(AuthContext)

    const navigate = useNavigate()

    const { useLogout } = useAuth()

    const redirects = {
        home: () => navigate('/'),
        login: () => navigate('/login'),
        prices: () => navigate('/prices'),
        dashboard: () => navigate('/dashboard')
    }

    const checkAuth = isAuth ?
    (
        <>
            <a className="ml-4">Panel de control</a>
            <a className="ml-4" onClick={() => useLogout()}>Cerrar Sesión</a>
            <img src={profileImgTest} alt="Perfil" className="ml-4 w-10 h-10 rounded-full"/>
        </>
    )
    : <a onClick={() => redirects.login()} className="mx-2">Inciar Sesión</a>

    const checkAdmin = isAdmin ? <a className="ml-4" onClick={() => redirects.dashboard()}>Dashboard</a> : null
    
  return (
    <nav className="flex items-center justify-between bg-gray-800 p-4 text-white">
      <div className="font-bold text-xl cursor-pointer" onClick={() => redirects.home()}>OntiBikes</div>
      <div className="flex items-center">
        <a onClick={() => redirects.home()}>Inicio</a>
        <a className="ml-4" onClick={() => redirects.prices()}>Precios</a>
        <a className="ml-4">Enlace 2</a>
        {checkAdmin}
        {checkAuth}
      </div>
    </nav>
  );
};

export default NavbarWeb;
