import React, { Suspense } from 'react'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { Toaster } from 'react-hot-toast'
import Layout from '@/components/Layout/Layout';

////////////// PAGES //////////////
const LoginPage = React.lazy(() => import('@/pages/Login/Login'))
const Home = React.lazy(() => import('@/pages/Home/Home'))
const Incidents = React.lazy(() => import('@/pages/Incidents/Incidents'))
//////////////////////  PROTECTED ROUTE  //////////////////////
import ProtectedRoute from '@/components/ProtectedRoute/ProtectedRoute'

//////////////////////  CONTEXT  //////////////////////
import { AuthContextProvider } from '@/context/auth/AuthContext'




function App() {


  return (
    <div>
      <Suspense fallback={<div>Loading...</div>}>
        <BrowserRouter>
          <AuthContextProvider>
            <Routes>
              <Route path="/login" element={<LoginPage />} />
              <Route path="/" element={
                <ProtectedRoute>
                  <Layout>
                    <Home />
                  </Layout>
                </ProtectedRoute>
              } />
              <Route path="/incidents" element={
                <ProtectedRoute>
                  <Layout>
                    <Incidents />
                  </Layout>
                </ProtectedRoute>
              } />
            </Routes>
          </AuthContextProvider>
        </BrowserRouter>
      </Suspense>
      <Toaster />
    </div>
  )
}

export default App
