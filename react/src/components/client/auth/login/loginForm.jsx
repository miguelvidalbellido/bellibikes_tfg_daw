import React from 'react';
import AuthForm from '../authForm';
import './loginForm.css';
import logo from './logo.png';
import { useNavigate } from 'react-router-dom';

const LoginForm = ({sendData, errorMSG}) => {

  const navigate = useNavigate();

  const redirects = {
    home: () => {
      navigate('/')
    }
  }

  const type = 'login'
  

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
};

export default LoginForm;