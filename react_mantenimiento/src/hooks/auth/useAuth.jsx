import { useCallback, useContext, useState, useEffect } from "react"
import AuthContext from "../../context/auth/AuthContext";
import AuthService from "../../services/auth/AuthService";
import JwtService from "../../services/auth/JwtService";
import { useNavigate } from "react-router-dom";
import toast from 'react-hot-toast';

export function useAuth() {
    const navigate = useNavigate()
    const { user, setUser, token, setToken, isAuth, setIsAuth, isAdmin, setIsAdmin } = useContext(AuthContext);
    const [isCorrect, setIsCorrect] = useState(false);
    const [errorMSG, setErrorMSG] = useState("");

    const useLogin = useCallback((data) => {
        AuthService.Login(data)
            .then(({ data, status }) => {
                if (status === 200) {
                    JwtService.saveToken(data.token);
                    setToken(data.token);
                    setUser(data.user);
                    setIsAuth(true);
                    setIsAdmin(data.user.type === 'admin');
                    setIsCorrect(true);
                    setErrorMSG('');
                    toast.success('Bienvenido de nuevo !!')
                    setTimeout(() => { setIsCorrect(false); }, 1000);
                    navigate('/')
                }
            })
            .catch((e) => {
                console.error(e);
                toast.error('Error al iniciar sesión.')
                setErrorMSG(e.response.data[0]);
                
            });
    }, [setUser]);

    const useLogout = useCallback(() => {
        AuthService.Logout()
        JwtService.destroyToken()
        setToken(false)
        setIsAuth(false)
        setIsAdmin(false)
        setUser({})
        toast.success('Has cerrado sesión.')
        navigate('/')
    }, [])


    return {  useLogout, isCorrect, user, setUser, isAuth, useLogin, errorMSG, setErrorMSG }
}