import api from '../api'
import ScannerEndpoints from './ScannerEndpoints'


const ScannerService = {
    
        getCheckScanner() {
            return api().get(ScannerEndpoints.CHECKSCANNERUSER)
        },

        postAsociateScanner(data) {
            return api().post(ScannerEndpoints.ASOCIATE, {"scanner": {"uuid_scanner": data}})
        }
    
}

export default ScannerService