import React from "react";
import AuthFormWeb from "@/components/client/auth/authFormWeb/authFormWeb";
import userCircle from "@/assets/atis-assets/elements/user-circle.svg";

export const metadata = {
    title: "Authentication",
    description: "Authentication forms built using the components.",
}

export default function RegisterWeb({sendData, errorMSG}) {
    const type = 'register'

    return (
      <div className="flex h-screen items-center justify-center p-4 bg-gray-50"> {/* Adjusted background to a lighter shade */}
        <div className="w-full max-w-md"> {/* Increased width of the form container */}
          <div className="mx-auto flex flex-col items-center space-y-8 bg-white rounded-xl shadow-2xl"> {/* Adjusted shadow for depth */}
            <img
              src={userCircle}
              alt="User"
              className="h-20 w-20 mt-8" // Adjusted margin to top
            />
            <div className="w-full px-12 py-8 text-center"> {/* Padding adjusted for more space */}
              <h2 className="text-3xl font-bold text-green-600">BelliBikes</h2> {/* Font size increased */}
              <p className="mt-4 text-lg text-gray-800 pb-5"> {/* Text color for better contrast */}
                Unete a nuestra comunidad de ciclistas.
              </p>
              <AuthFormWeb sendData={sendData} errorMSG={errorMSG} type={type} />
              <p className="mt-4 text-sm text-gray-600">
                By clicking continue, you agree to our terms and conditions.
              </p>
              <div className="mt-4 text-gray-800"> {/* Text color for better contrast */}
                ¿YA TIENES CUENTA? <a href="/login" className="text-green-600 hover:text-green-800">ACCEDER</a> {/* Adjusted link for navigation */}
              </div>
            </div>
          </div>
        </div>
      </div>
    );
}
