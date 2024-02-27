import React from 'react';
import './authForm.css';
import { useForm } from 'react-hook-form';
import { useNavigate } from 'react-router-dom';

const AuthForm = ({sendData, errorMSG, type}) => {

  const {register, handleSubmit, formState: {errors} } = useForm();

  const send_data = data => {
    sendData(data);
  };

  const navigate = useNavigate();

  const redirects = {
    login: () => {
      navigate('/login')
    },
    register: () => {
      navigate('/register')
    }
  }

  const inputsForm = type === 'login' ? (
    <>
      <input type="text" placeholder="Username" {...register('username')}/>
      <input type="password" placeholder="Password" {...register('password')}/>
      <div className="button-container">
        <button className="login-btn">Login</button>
        {/* <button className="register-btn">Register</button> */}
      </div>
      <div className="mt-4 text-center">
        <p className="text-sm">
          ¿No tienes una cuenta? 
          <a onClick={() => redirects.register()} className="text-blue-600 hover:text-blue-800">
            Regístrate aquí
          </a>
        </p>
      </div>
    </>    
  ) : (
    <>
      <input type="text" placeholder="Username" {...register('username')}/>
      <input type="password" placeholder="Password" {...register('password')}/>
      <input type="email" placeholder='Email' {...register('email')}/>
      <div className="button-container">
        {/* <button className="login-btn">Login</button> */}
        <button className="register-btn">Register</button>
      </div>
      <div className="mt-4 text-center">
        <p className="text-sm">
          ¿Ya tienes una cuenta? 
          <a onClick={() => redirects.login()} className="text-blue-600 hover:text-blue-800">
            Accede aquí
          </a>
        </p>
      </div>
    </>
  )

  return (
    <div className="login-card">
        <form onSubmit={handleSubmit(send_data)}>
            {inputsForm}
        </form>
    </div>
  );
};

export default AuthForm;
