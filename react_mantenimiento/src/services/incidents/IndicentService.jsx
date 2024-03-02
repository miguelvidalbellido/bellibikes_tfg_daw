import api from '../api'
import IncidentStagesEndpoints from './IncidentEnpoints'

const IncidentService = {
    
    getIncidents() {
        return api().get(IncidentStagesEndpoints.GETALL)
    },

    addIncident(data) {
        return api().post(IncidentStagesEndpoints.CREATE, {'incident': data})
    }

}

export default IncidentService