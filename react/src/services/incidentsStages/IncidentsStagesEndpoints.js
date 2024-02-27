const authBase = 'stages'

const IncidentStagesConstants = {
    'CREATE': `${authBase}`,
    'GETALL': `${authBase}`,
    'GETALLOFINCIDENT': `stagesincident`,
    'UPDATE': `${authBase}`,
    'NOTIFYS': `${authBase}/notifypending`,
    'CHECKVIEW': `${authBase}/confirmview`
}

export default IncidentStagesConstants