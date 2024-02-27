import React, { useState, useEffect, useCallback } from 'react'
import JwtService from '../../services/auth/JwtService'
import AuthService from '../../services/auth/AuthService'
import { useNavigate } from "react-router-dom"

const Context = React.createContext({})

export function AuthContextProvider({ children }) {
    const navigate = useNavigate();
    const [user, setUser] = useState({})
    const [token, setToken] = useState(JwtService.getToken ? JwtService.getToken : false)
    const [isAuth, setIsAuth] = useState(false)
    const [isAdmin, setIsAdmin] = useState(false)

    useEffect(() => {
        if (token) {
            AuthService.getUser()
                .then(({ data, status }) => {
                    if (status === 200) {
                        setToken(data.token)
                        setUser(data.user)
                        setIsAuth(true)
                        setIsAdmin(data.user.type === 'admin')
                    }
                })
                .catch(({ error }) => {
                    console.log('hola refresh')
                });
        }
    }, [token]);

    return <Context.Provider value={{ user, setUser, token, setToken, isAuth, setIsAuth, isAdmin, setIsAdmin }}>
        {children}
    </Context.Provider>
}

export default Context