import React, { useEffect } from "react";
import LoginForm from "../../components/client/auth/login/loginForm";
import { useAuth } from "../../hooks/auth/useAuth";
import { useNavigate } from "react-router-dom";

const Login = () => {
    const { isCorrect, useLogin, errorMSG } = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        if (isCorrect) {
            navigate('/');
        }
    }, [isCorrect, navigate]);

    return (
        <LoginForm sendData={(data) => useLogin(data)} errorMSG={errorMSG}/>
    )
}

export default Login;