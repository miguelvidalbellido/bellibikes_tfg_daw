import React, { useEffect } from 'react'
import LoginWebComponent from '@/components/client/auth/loginWeb/loginWeb'
import { useAuth } from "../../hooks/auth/useAuth";
import { useNavigate } from "react-router-dom";

const LoginWeb = () => {
    const { isCorrect, useLogin, errorMSG } = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        if (isCorrect) {
            navigate('/');
        }
    }, [isCorrect, navigate]);
    
    return (
        <div>
            <LoginWebComponent sendData={(data) => useLogin(data)} errorMSG={errorMSG}/>
        </div>
    )
}

export default LoginWeb