import React, { Suspense, useEffect } from 'react'
import './App.css'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { isMobile } from 'react-device-detect'

// Import context
import { AuthContextProvider } from './context/auth/AuthContext'
import { StationsContextProvider } from './context/Stations/StationsContext'
import { BikesContextProvider } from './context/Bikes/BikesContext'
import { SlotsContextProvider } from './context/Slots/SlotsContext'
import { WebSocketContextProvider } from './context/ws/WebSocket'
import { RentContextProvider } from './context/Rent/RentContext'
import { FSProductsContextProvider } from './context/FS_products/FSProducts' 
import { IncidentContextProvider } from './context/Incident/IncidentContext' 
import { IncidentsStagesContextProvider } from './context/IncidentStages/IncidentStages'
// Import Guards
import AdminGuard from '@/services/guards/admin/adminGuard'
import AuthGuard from '@/services/guards/auth/authGuard'

// Import Pages Mobile
const Home = React.lazy(() => import("./pages/Home/Home"))
const Login = React.lazy(() => import("./pages/auth/Login"))
const Register = React.lazy(() => import("./pages/auth/Register"))
const StationApp = React.lazy(() => import("./pages/stations/StationApp"))
const QrStartRent = React.lazy(() => import("./pages/qrStartRent/qrStartRent"))
const RentView = React.lazy(() => import("./pages/rentView/RentView"))
const QrScanner = React.lazy(() => import("./pages/qrScanner/QrScanner"))
const DataFinishRent = React.lazy(() => import("./pages/dataFinishRent/dataFinishRent"))
const ReportIncident = React.lazy(() => import("./pages/reportIncident/ReportIncident"))
const Notifies = React.lazy(() => import("./pages/notifiesList/NotifiesList"))
const Profile = React.lazy(() => import("./pages/profile/Profile"))

// Import Pages Web
const HomeWeb = React.lazy(() => import("./pages/Home/HomeWeb"))
const LoginWeb = React.lazy(() => import("./pages/auth/LoginWeb"))
const PricingWeb = React.lazy(() => import("./pages/pricing/pricingWeb/PricingWeb"))
const NavbarWeb = React.lazy(() => import("./components/client/navbar/navbarWeb/navbarWeb"))
const AdminDashboard = React.lazy(() => import("./pages/adminDashboard/AdminDashboard"))
const RegisterWeb = React.lazy(() => import("./pages/auth/registerWeb"))

// Components shadcn ui
import { Toaster } from '@/components/ui/toaster'

function App() {


  
  return (
    <div className="App">
      <Suspense fallback={<></>}>
        <BrowserRouter>
          <AuthContextProvider>
            <StationsContextProvider>
              <BikesContextProvider>
                <SlotsContextProvider>
                  <RentContextProvider>
                    <FSProductsContextProvider>
                      <IncidentContextProvider>
                        <IncidentsStagesContextProvider>
                      <WebSocketContextProvider>
                      {isMobile ? null : <NavbarWeb />}
                      <Routes>
                        {isMobile 
                        ? (
                          <>
                            <Route path="/" element={<Home />} />
                            <Route path="/station/:stationUUID" element={<StationApp />} />
                            <Route path="/startRent/:bikeUUID" element={<QrStartRent />} />
                            <Route path="/rentView/:bikeUUID" element={<RentView />} />
                            <Route path="/qrScanner" element={<QrScanner />} />
                            <Route path="/rentalDetails/:uuidRent" element={<DataFinishRent />} />
                            <Route path="/reportIncident" element={<ReportIncident />} />
                            <Route path="/notifies" element={<Notifies />} />
                            <Route path="/profile" element={<Profile />} />
                            <Route element={<AuthGuard />} >
                              <Route path="/login" element={<Login />} />
                              <Route path="/register" element={<Register />} />
                            </Route>
                          </>
                        ) : (
                          <>
                              <Route path="/" element={<HomeWeb />} />
                              <Route path="/prices" element={<PricingWeb />} />
                            <Route element={<AuthGuard />} >
                              <Route path="/login" element={<LoginWeb />} />
                              <Route path="/register" element={<RegisterWeb />} />
                            </Route>
                            <Route element={<AdminGuard />} >
                              <Route path="/dashboard" element={<AdminDashboard />} />
                            </Route>
                          </>
                        )
                        }
                      </Routes>
                      <Toaster />
                      </WebSocketContextProvider>
                      </IncidentsStagesContextProvider>
                      </IncidentContextProvider>
                    </FSProductsContextProvider>
                  </RentContextProvider>
                </SlotsContextProvider>
              </BikesContextProvider>
            </StationsContextProvider>
          </AuthContextProvider>
        </BrowserRouter>
      </Suspense>
    </div>
  )
}

export default App