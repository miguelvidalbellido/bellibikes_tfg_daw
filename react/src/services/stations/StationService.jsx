import api from '../api'
import StationEndpoints from './StationsEndpoint'

const StationService = {
    
    getStations() {
        return api().get(StationEndpoints.GET)
    },

    addStation(data) {
        return api().post(StationEndpoints.CREATE, {'station': data})
    },

    updateStation(uuid, data) {
        return api().put(StationEndpoints.UPDATE+`/${uuid}`, {'station': data})
    },

    deleteStation(uuid) {
        return api().delete(StationEndpoints.DELETE+`/${uuid}`)
    }

}

export default StationService