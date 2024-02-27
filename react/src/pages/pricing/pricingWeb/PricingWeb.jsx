import React, { useState } from 'react';
import PricingSection from '@/components/client/prices/pricingSection';
import { useFSProducts } from '@/hooks/FSProducts/useFSProducts';
import { useAuth } from '@/hooks/auth/useAuth';
import { useToast } from '@/components/ui/use-toast'
import { useNavigate } from 'react-router-dom';

const PricingPage = () => {
  const { toast } = useToast()
  const navigate = useNavigate()
  const { fsProducts, addPlanUser } = useFSProducts()
  const [typeProducts, setTypeProducts] = useState('ANUAL')
  const { isAuth } = useAuth()

  const redirects = {
    login: () => {
      navigate(`/login`)
    }
  }
  
  const handleTypeProducts = (type) => {
    setTypeProducts(type)
  }

  const handleAddPlanUser = (data) => {

    isAuth 
    ? addPlanUser({idproducto: data}) 
    : (
        toast({
          title: 'Inicia Sessión Para Continuar',
          description: `Redireccionando...`,
          status: 'error',
          duration: 5000
        }),
        redirects.login()
      )
  }

  return ( 
    <div className="font-sans bg-gray-100">
      <div className="min-h-screen flex justify-center items-center">
        <div className="">
          <div className="text-center font-semibold">
            <h1 className="text-5xl">
              <span className="text-blue-700 tracking-wide">Flexible </span>
              <span>Plans</span>
            </h1>
            <p className="pt-6 text-xl text-gray-400 font-normal w-full px-8 md:w-full">
              Choose a plan that works best for you and<br/> your team.
            </p>
            <button 
              onClick={() => handleTypeProducts('ANUAL')}
              className={typeProducts === 'ANUAL' ? 'w-40 h-12 bg-blue-600 text-white rounded-xl m-4' : 'w-40 h-12 bg-gray-600 text-white rounded-xl m-4'}>
              <span className="font-semibold">Planes Anuales</span>
            </button>
            <button 
              onClick={() => handleTypeProducts('MENSUAL')}
              className={typeProducts === 'MENSUAL' ? 'w-40 h-12 bg-blue-600 text-white rounded-xl m-4' : 'w-40 h-12 bg-gray-600 text-white rounded-xl m-4'}>
              <span className="font-semibold">Planes Mensuales</span>
            </button>
            <button 
              onClick={() => handleTypeProducts('PAY-AS-YOU-GO')}
              className={typeProducts === 'PAY-AS-YOU-GO' ? 'w-40 h-12 bg-blue-600 text-white rounded-xl m-4' : 'w-40 h-12 bg-gray-600 text-white rounded-xl m-4'}>
              <span className="font-semibold">Pago por Viaje</span>
            </button>
          </div>
          <div className="pt-24 flex flex-row">
            {
              fsProducts && fsProducts.length > 0 ? <PricingSection products={fsProducts.filter(element => element.observaciones === typeProducts)} addPlan={handleAddPlanUser} /> : <p>Loading...</p>
            }
          </div>
        </div>
      </div>
    </div>
  );
};

export default PricingPage;
