import React from 'react';

const PricingSection = ({products, addPlan}) => {
    // PAY-AS-YOU-GO
    return (
        <>
        <div className="w-96 p-8 bg-white text-center rounded-3xl pr-16 shadow-xl" key={products[0].idproducto}>
                    <h1 className="text-black font-semibold text-2xl">{products[0].referencia}</h1>
                    <p className="pt-2 tracking-wide">
                        <span className="text-gray-400 align-top">€ </span>
                        <span className="text-3xl font-semibold">{products[0].precio}</span>
                        <span className="text-gray-400 font-medium">/ user</span>
                    </p>
                    <hr className="mt-4 border-1"/>
                    <div className="pt-8">
                        <p className="font-semibold text-gray-400 text-left">
                            <span className="pl-2">
                                {products[0].descripcion}
                            </span>
                        </p>

                        <a className="cursor-pointer" onClick={() => addPlan(products[0].idproducto)}>
                            <p className="w-full py-4 bg-blue-600 mt-8 rounded-xl text-white">
                                <span className="font-medium">
                                    Seleccionar Plan
                                </span>
                            </p>
                        </a>
                    </div>
                </div>

                <div className="w-80 p-8 bg-gray-900 text-center rounded-3xl text-white border-4 shadow-xl border-white transform scale-125" key={products[1].idproducto}>
                    <h1 className="text-white font-semibold text-2xl">{products[1].referencia}</h1>
                    <p className="pt-2 tracking-wide">
                        <span className="text-gray-400 align-top">€</span>
                        <span className="text-3xl font-semibold">{products[1].precio}</span>
                        <span className="text-gray-400 font-medium">/ user</span>
                    </p>
                    <hr className="mt-4 border-1 border-gray-600"/>
                    <div className="pt-8">
                        <p className="font-semibold text-gray-400 text-left pt-5">
                            <span className="pl-2">
                            {products[1].descripcion}
                            </span>
                        </p>

                        <a className="cursor-pointer" onClick={() => addPlan(products[1].idproducto)}>
                            <p className="w-full py-4 bg-blue-600 mt-8 rounded-xl text-white">
                                <span className="font-medium">
                                    Seleccionar Plan
                                </span>
                            </p>
                        </a>
                    </div>
                    <div className="absolute top-4 right-4">
                        <p className="bg-blue-700 font-semibold px-4 py-1 rounded-full uppercase text-xs">Popular</p>
                    </div>
                </div>
                <div className="w-96 p-8 bg-white text-center rounded-3xl pl-16 shadow-xl" key={products[2].idproducto}>
                    <h1 className="text-black font-semibold text-2xl">{products[2].referencia}</h1>
                    <p className="pt-2 tracking-wide">
                        <span className="text-gray-400 align-top">€ </span>
                        <span className="text-3xl font-semibold">{products[2].precio}</span>
                        <span className="text-gray-400 font-medium">/ user</span>
                    </p>
                    <hr className="mt-4 border-1" />
                    <div className="pt-8">
                        <p className="font-semibold text-gray-400 text-left">
                            <span className="pl-2">
                                {products[2].descripcion}
                            </span>
                        </p>

                        <a className="cursor-pointer" onClick={() => addPlan(products[2].idproducto)}>
                            <p className="w-full py-4 bg-blue-600 mt-8 rounded-xl text-white">
                                <span className="font-medium">
                                    Seleccionar Plan
                                </span>
                            </p>
                        </a>
                    </div>
                </div>
                </>
    )
}

export default PricingSection;