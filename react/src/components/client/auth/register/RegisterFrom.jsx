import React from "react"
import AuthForm from "../authForm"
import '../login/loginForm.css'
import logo from '../login/logo.png'
import { useNavigate } from "react-router-dom"

const RegisterForm = ({sendData, errorMSG}) => {

    const navigate = useNavigate()

    const redirects = {
        home: () => {
            navigate('/')
        }
    }

    const type = 'register'

    return (
        <div className='container_login'>
          <span onClick={() => redirects.home()} className='close'>X</span>
          <div className='container_img'>
            <img className='img' src={logo} />
          </div>
          <div className='container_form'>
            <AuthForm sendData={(data) => sendData(data)} errorMSG={errorMSG} type={type}></AuthForm>
          </div>
        </div>
      );
}

export default RegisterForm