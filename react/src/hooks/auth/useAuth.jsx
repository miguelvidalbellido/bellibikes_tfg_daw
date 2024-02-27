import { useCallback, useContext, useState, useEffect } from "react"
import AuthContext from "../../context/auth/AuthContext";
import AuthService from "../../services/auth/AuthService";
import JwtService from "../../services/auth/JwtService";
import { Navigate, useInRouterContext, useNavigate } from "react-router-dom";
import { useToast } from '@/components/ui/use-toast'

export function useAuth() {
    const navigate = useNavigate()
    const { user, setUser, token, setToken, isAuth, setIsAuth, isAdmin, setIsAdmin } = useContext(AuthContext);
    const [isCorrect, setIsCorrect] = useState(false);
    const [profileData, setProfileData] = useState({});
    const [profileRents, setProfileRents] = useState([]);
    const [errorMSG, setErrorMSG] = useState("");
    const [userScooter, setUserScooter] = useState({});
    const [error_scooterMSG, setError_scooterMSG] = useState("");
    const [stats, setStats] = useState(0);
    const [allUsers, setAllUsers] = useState([]);
    const { toast } = useToast()

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
                    toast({
                        title: 'Bienvenido de nuevo!!',
                        description: `Hola ${data.user.username}`,
                        status: 'success',
                        duration: 5000
                    })
                    setTimeout(() => { setIsCorrect(false); }, 1000);
                    
                }
            })
            .catch((e) => {
                console.error(e);
                setErrorMSG(e.response.data[0]);
                toast({
                    title: 'Ha ocurrido un error',
                    description: 'Por favor, revisa tus credenciales',
                    status: 'error',
                    duration: 5000
                })
            });
    }, [setUser]);

    const useLogout = useCallback(() => {
        AuthService.Logout()
        JwtService.destroyToken()
        setToken(false)
        setIsAuth(false)
        setIsAdmin(false)
        setUser({})
        navigate('/')
        toast({
            title: 'Sesión cerrada',
            description: `Hasta la proxima`,
            status: 'success',
            duration: 5000
        })
    }, [])


    const useRegister = useCallback((data) => {
        AuthService.Register(data)
            .then(({ data, status }) => {
                if (status === 201) {
                    setIsCorrect(true);
                    toast({
                        title: 'Inicia sesion para accedera tu cuenta!!',
                        description: `Hola ${data.user.username}`,
                        status: 'success',
                        duration: 5000
                    })
                    setTimeout(() => { setIsCorrect(false); }, 1000);
                    navigate('/login')
                }
            })
            .catch((e) => {
                console.error(e);
                setErrorMSG(e.response.data[0]);
                toast({
                    title: 'Ha ocurrido un error',
                    description: 'Por favor, revisa tus credenciales',
                    status: 'error',
                    duration: 5000
                })
            });
    }, [setUser]);

    const useProfile = useCallback((data) => {
        AuthService.Profile()
            .then(({ data, status }) => {
                if (status === 200) {
                    setProfileData(data.user.user);
                    setProfileRents(data.rents);
                }
            })
            .catch((e) => {
                console.error(e);
                setErrorMSG(e.response.data[0]);
            });
    }, []);

    return {  useLogout, isCorrect, user, setUser, allUsers, isAuth, setAllUsers, useLogin, useRegister, profileData, setProfileData, profileRents, setProfileRents, errorMSG, setErrorMSG, userScooter, setUserScooter, error_scooterMSG, setError_scooterMSG, stats, setStats, useProfile }
}