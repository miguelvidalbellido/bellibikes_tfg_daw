import React from 'react'
import { Navigate } from 'react-router-dom'
import { useAuth } from '@/hooks/auth/useAuth'


const ProtectedRoute = ({ children }) => {
    const { isAuth } = useAuth();

    if (!isAuth) return <Navigate to="/login" />
    
    return children
};

export default ProtectedRoute