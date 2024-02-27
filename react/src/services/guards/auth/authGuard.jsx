import React, { useContext } from 'react'
import { useNavigate, Navigate, Outlet } from 'react-router-dom'

import AuthContextProvider from '@/context/auth/AuthContext'

const AuthGuard = () => {

    const { isAuth } = useContext(AuthContextProvider)


    return !isAuth ? <Outlet/> : <Navigate to="/"/>

}

export default AuthGuard
