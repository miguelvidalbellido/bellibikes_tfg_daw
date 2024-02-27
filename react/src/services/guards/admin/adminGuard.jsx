import React, { useContext } from 'react'
import { useNavigate, Navigate, Outlet } from 'react-router-dom'

import AuthContextProvider from '@/context/auth/AuthContext'

const AdminGuard = () => {

    const { isAdmin } = useContext(AuthContextProvider)


    return isAdmin ? <Outlet/> : <Navigate to="/"/>

}

export default AdminGuard
