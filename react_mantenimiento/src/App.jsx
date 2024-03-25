import React, { Suspense } from "react"
import { BrowserRouter, Routes, Route } from "react-router-dom"
import { Toaster } from "react-hot-toast"
import Layout from "@/components/Layout/Layout"

////////////// PAGES //////////////
// const LoadingPreview = React.lazy(() => import("@/components/LoadingPreview/LoadingPreview"))
import LoadingPreview from "./components/LoadingPreview/LoadingPreview"
const LoginPage = React.lazy(() => import("@/pages/Login/Login"));
const Home = React.lazy(() => import("@/pages/Home/Home"))
const Incidents = React.lazy(() => import("@/pages/Incidents/Incidents"))
const Scan = React.lazy(() => import("@/pages/Scan/Scan"))
//////////////////////  PROTECTED ROUTE  //////////////////////
import ProtectedRoute from "@/components/ProtectedRoute/ProtectedRoute"

//////////////////////  CONTEXT  //////////////////////
import { AuthContextProvider } from "@/context/auth/AuthContext"
import { IncidentContextProvider } from "@/context/Incident/IncidentContext"
import { WebSocketContextProvider } from "./context/ws/WebSocket"
import { ScannerContextProvider } from "./context/Scanner/ScannerContext"
function App() {
  return (
    <div>
      <Suspense fallback={<LoadingPreview />}>
        <BrowserRouter>
          <AuthContextProvider>
            <IncidentContextProvider>
              <ScannerContextProvider>
                <WebSocketContextProvider>
                  <Routes>
                    <Route path="/login" element={<LoginPage />} />
                    <Route
                      path="/"
                      element={
                        <ProtectedRoute>
                          <Layout>
                            <Home />
                          </Layout>
                        </ProtectedRoute>
                      }
                    />
                    <Route
                      path="/incidents"
                      element={
                        <ProtectedRoute>
                          <Layout>
                            <Incidents />
                          </Layout>
                        </ProtectedRoute>
                      }
                    />
                    <Route
                      path="/scan"
                      element={
                        <ProtectedRoute>
                          <Layout>
                            <Scan />
                          </Layout>
                        </ProtectedRoute>
                      }
                    />
                  </Routes>
                </WebSocketContextProvider>
              </ScannerContextProvider>
            </IncidentContextProvider>
          </AuthContextProvider>
        </BrowserRouter>
      </Suspense>
      <Toaster />
    </div>
  );
}

export default App;
