import api from '../api'
import SlotEndpoints from './SlotsEndpoint'

const SlotService = {
    
    getSlots() {
        return api().get(SlotEndpoints.GET)
    },

    addSlot(data) {
        return api().post(SlotEndpoints.CREATE, {'slot': data})
    },

    updateSlot(uuid, data) {
        return api().put(SlotEndpoints.UPDATE+`/${uuid}`, {'slot': data})
    },

    deleteSlot(uuid) {
        return api().delete(SlotEndpoints.DELETE+`/${uuid}`)
    }

}

export default SlotService