import api from '../api'
import BikeEndpoints from './BikesEndpoint'

const BikeService = {
    
    getBikes() {
        return api().get(BikeEndpoints.GET)
    },

    checkBike(uuid) {
        return api().get(`checkAvailable/${uuid}/`)
    },

    addBike(data) {
        return api().post(BikeEndpoints.CREATE, {'bike': data})
    },

    updateBike(uuid, data) {
        console.log({'bike': data})
        return api().put(BikeEndpoints.UPDATE+`/${uuid}`, {'bike': data})
    },

    deleteBike(uuid) {
        return api().delete(BikeEndpoints.DELETE+`/${uuid}`)
    }

}

export default BikeService