import apiFS from "../apiFS";
import api from "../api";
import FsEndpoints from "./FsEndpoint";

const FsService = {
    
    getProducts() {
        return apiFS().get(FsEndpoints.GETFS);
    },

    addProduct(data) {
        return api().post(FsEndpoints.POST, {plan: data})
    },

    checkDataPlan() {
        return api().get(FsEndpoints.GET+`/checkDataPlan`)
    }

}

export default FsService