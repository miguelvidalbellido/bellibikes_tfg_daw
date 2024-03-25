import api from '../api'
import ScannerEndpoints from './ScannerEndpoints'


const ScannerService = {
    
        getCheckScanner() {
            return api().get(ScannerEndpoints.CHECKSCANNERUSER)
        },

        postAsociateScanner(data) {
            return api().post(ScannerEndpoints.ASOCIATE, {"scanner": {"uuid_scanner": data}})
        },

        getIncidentsScan(rfid_tag) {
            return api().post(ScannerEndpoints.GETINCIDENTSSCAN, {"rfidScan": {"rfid": rfid_tag}})
        },
    
}

export default ScannerService