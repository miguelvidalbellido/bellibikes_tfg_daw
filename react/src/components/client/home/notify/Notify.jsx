import './notify.css'
import campana from './campana.png'
import notificacion from './notificacion.png'
import { useIncidentStages } from "@/hooks/incidentStages/useIncidentStages"
import { useEffect } from 'react'
import { useAuth } from '@/hooks/auth/useAuth'
import { useNavigate } from 'react-router-dom';

const Notify = () => {
    const { notifyUser,getNotifysUser } = useIncidentStages();
    const { isAuth } = useAuth();
    const navigate = useNavigate();

    const redirects = {
        notifies: () => {
          navigate('/notifies')
        }
      }

    useEffect(() => {
        
        if (isAuth) getNotifysUser()
    }, [isAuth]);

    return (
        <div style={{ position: 'fixed', zIndex: 500, top: '1rem', right: '3rem' }}>
            <span style={{ position: 'fixed', zIndex: 501 }}>
                {
                    isAuth
                    ? notifyUser.length > 0
                        ? <img src={notificacion} alt="Notificación" className="w-3/4 shake-animation" onClick={() => redirects.notifies()}/>
                        : <img src={campana} alt="Campana" className="w-3/4" />
                        : <img src={campana} alt="Campana" className="w-3/4" />
                }
            </span>
        </div>
    )
}

export default Notify