import api from '../api'
import IncidentsStagesEndpoints from './IncidentsStagesEndpoints'

const IncidentStages = {

    getStagesOneIncident(uuid) {
        return api().get(IncidentsStagesEndpoints.GETALLOFINCIDENT+`/${uuid}/`)
    },

    addStage(data) {
        return api().post(IncidentsStagesEndpoints.CREATE, {"incident": data})
    },

    getStages() {
        return api().get(IncidentsStagesEndpoints.GETALL)
    },

    getStagesUser() {
        return api().get(IncidentsStagesEndpoints.NOTIFYS)
    },

    checkVeiw(data) {
        return api().put(IncidentsStagesEndpoints.CHECKVIEW, {"stageincident": data})
    }

}

export default IncidentStages