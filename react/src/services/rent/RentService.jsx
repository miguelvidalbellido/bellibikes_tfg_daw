import api from '../api'
import RentEndpoints from './RentEndpoint'

const RentService = {
    
    getRents() {
        return api().get(RentEndpoints.GET)
    },

    getRent(uuid) {
        return api().get(RentEndpoints.GETONE+`/${uuid}/`)
    },

    addRent(data) {
        return api().post(RentEndpoints.CREATE, {'rent': data})
    },

    updateRent(uuid, data) {
        return api().put(RentEndpoints.UPDATE+`/${uuid}`, {'rent': data})
    },

    deleteRent(uuid) {
        return api().delete(RentEndpoints.DELETE+`/${uuid}`)
    }

}

export default RentService