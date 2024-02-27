
import React, { useEffect } from 'react'
import RegisterWebComponent from '@/components/client/auth/registerWeb/registerWeb'
import { useAuth } from "../../hooks/auth/useAuth";
import { useNavigate } from "react-router-dom";

const RegisterWeb = () => {
    const { isCorrect, useRegister, errorMSG } = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        if (isCorrect) {
            navigate('/');
        }
    }, [isCorrect, navigate]);
    
    return (
        <div>
            <RegisterWebComponent sendData={(data) => useRegister(data)} errorMSG={errorMSG}/>
        </div>
    )
}

export default RegisterWeb