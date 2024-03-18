const authBase = 'users/'

const AuthConstants = {
    'REGISTER': `${authBase}register`,
    'LOGIN': `${authBase}login`,
    'GETUSER': `${authBase}getUserData`,
    'LOGOUT': `logout`,
    'GETPROFILE': `dataProfile`,
    'EDITUSER': `${authBase}editUser`,
    'GETUSERS': `${authBase}getAllUsers`,
    'NOTIFYUSERMAIL': `${authBase}notifyUserViaEmail`,
}

export default AuthConstants