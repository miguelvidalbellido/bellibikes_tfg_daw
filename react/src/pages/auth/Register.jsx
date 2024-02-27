import React, { useEffect } from "react"
import RegisterForm from "../../components/client/auth/register/RegisterFrom"
import { useAuth } from "../../hooks/auth/useAuth"
import { useNavigate } from "react-router-dom"

const Register = () => {
    const { isCorrect, useRegister, errorMSG } = useAuth()
    const navigate = useNavigate()

    useEffect(() => {
        if (isCorrect) {
            navigate('/')
        }
    }, [isCorrect, navigate])

    return (
        <RegisterForm sendData={(data) => useRegister(data)} errorMSG={errorMSG}/>
    )
}

export default Register