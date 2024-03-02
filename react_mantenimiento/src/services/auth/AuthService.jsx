import api from '../api';
import AuthEndpoints from './AuthEndpoints';
const AuthService = {
    Register(data) {
        return api().post(AuthEndpoints.REGISTER, { 'user': data });
    },

    Login(data) {
        return api().post(AuthEndpoints.LOGIN, { 'user': data });
    },

    getUser() {
        return api().get(AuthEndpoints.GETUSER);
    },

    Logout() {
        return api().post(AuthEndpoints.LOGOUT);
    },
}

export default AuthService;