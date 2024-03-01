import axios from 'axios';
import secrets from '../secrets';
import JwtService from './auth/JwtService';

const Axios = () => {
    let api = null;

    if (JwtService.getToken()) {
        api = axios.create({
            baseURL: secrets.URL_DRF,
            headers: {
                "Content-type": "application/json",
                "Authorization": `Bearer ${JwtService.getToken()}`
            }
        });
    } else {
        api = axios.create({
            baseURL: secrets.URL_DRF,
            headers: {
                "Content-type": "application/json",
            }
        });
    }

    api.interceptors.response.use(
        (response) => response,
        (error) => {
            console.log(error);
            if (error.response.status === 403) {
                JwtService.destroyToken();
                window.location.reload();
            }
            return Promise.reject(error);
        }
    );

    return api;
}

export default Axios;