import React from "react"
import AuthFormWeb from "@/components/client/auth/authFormWeb/authFormWeb"

export const metadata = {
    title: "Authentication",
    description: "Authentication forms built using the components.",
}

export default function RegisterWeb({sendData, errorMSG}) {
    const type = 'register'

  return (
    <>
      <div className="md:hidden">
        
      </div>
      <div className="container relative hidden h-[800px] flex-col items-center justify-center md:grid lg:max-w-none lg:grid-cols-2 lg:px-0">
        
        <div className="relative hidden h-full flex-col bg-muted p-10 text-white lg:flex dark:border-r">
          <div className="absolute inset-0 bg-zinc-900" />
          <div className="relative z-20 flex items-center text-lg font-medium">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              strokeWidth="2"
              strokeLinecap="round"
              strokeLinejoin="round"
              className="mr-2 h-6 w-6"
            >
              <path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3V6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3" />
            </svg>
            OntiBikes
          </div>
          <div className="relative z-20 mt-auto">
            <blockquote className="space-y-2">
              <p className="text-lg">
                &ldquo;¡Descubre OntiBikes - Tu lugar para alquilar bicicletas eléctricas en Ontinyent! 
                Con nuestras bicicletas eléctricas de primera calidad, podrás explorar la ciudad de manera ecológica y emocionante. 
                ¡Reserva hoy y comienza tu aventura en dos ruedas!&rdquo;
              </p>
              <footer className="text-sm">Dev's</footer>
            </blockquote>
          </div>
        </div>
        <div className="lg:p-8">
          <div className="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
            <div className="flex flex-col space-y-2 text-center">
              <h1 className="text-2xl font-semibold tracking-tight text-secondary">
                Inicia Sesión
              </h1>
              <p className="text-sm text-muted-foreground">
                Introduce tus credenciales para crear tu cuenta.
              </p>
            </div>
            <AuthFormWeb sendData={(data) => sendData(data)} errorMSG={errorMSG} type={type}></AuthFormWeb>
            <p className="px-8 text-center text-sm text-muted-foreground">
              By clicking continue, you agree to our{" "}
              .
            </p>
          </div>
        </div>
      </div>
    </>
  )
}
