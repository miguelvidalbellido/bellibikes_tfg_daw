import api from '../api'
import StatsEndpoints from './StatsEndpoint'

const StatsService = {

    getDashboardHome() {
        return api().get(StatsEndpoints.DASHBOARDHOME)
    },

    getDashboardStations() {
        return api().get(StatsEndpoints.DASHBOARDSTATIONS)
    },

    getDashboardSlots() {
        return api().get(StatsEndpoints.DASHBOARDSLOTS)
    },

    getDashboardBikes() {
        return api().get(StatsEndpoints.DASHBOARDBIKES)
    }
}

export default StatsService