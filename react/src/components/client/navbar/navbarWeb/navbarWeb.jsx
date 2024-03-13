import React, { useContext, useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import profileImgTest from "./profile_test.webp";
import AuthContext from "@/context/auth/AuthContext";
import { useAuth } from "@/hooks/auth/useAuth";
import { useLocation } from "react-router-dom";

const NavbarWeb = () => {
  const { user, isAuth, isAdmin } = useContext(AuthContext);
  const navigate = useNavigate();
  const { useLogout } = useAuth();
  let location = useLocation();

  const redirects = {
    home: () => navigate("/"),
    login: () => navigate("/login"),
    prices: () => navigate("/prices"),
    dashboard: () => navigate("/dashboard"),
  };

  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const handleScroll = () => {
      const offset = window.scrollY;
      if (offset > 0) {
        setScrolled(true);
      } else {
        setScrolled(false);
      }
    };

    window.addEventListener("scroll", handleScroll);

    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  const checkAuth = isAuth ? (
    <>
      <a
        className="ml-4 bg-green-400 px-4 py-2 rounded-md cursor-pointer hover:bg-red-600 text-white"
        onClick={useLogout}
      >
        Cerrar Sessión
      </a>
    </>
  ) : (
    <a
      onClick={redirects.login}
      className="mx-2 cursor-pointer hover:text-green-600"
    >
      Iniciar Sesión
    </a>
  );

  const checkAdmin = isAdmin ? (
    <a
      className="ml-4 bg-green-500 px-4 py-2 rounded-md cursor-pointer hover:bg-green-600 text-white"
      onClick={redirects.dashboard}
    >
      Panel de Administración
    </a>
  ) : null;

  if (location.pathname === '/dashboard') {
    return null;
  }

  return (
    <nav
      className={`fixed w-full z-50 top-0 ${
        scrolled ? "bg-gray-500 text-white" : "bg-gray-200 text-gray-800"
      } backdrop-blur-md shadow-lg flex items-center justify-between px-4 py-3 transition-colors duration-300`}
    >
      <div
        className="font-bold text-xl cursor-pointer hover:text-green-600"
        onClick={redirects.home}
      >
        BelliBikes
      </div>
      <div className="flex items-center">
        <a
          onClick={redirects.home}
          className="cursor-pointer hover:text-green-600"
        >
          Inicio
        </a>
        <a
          className="ml-4 cursor-pointer hover:text-green-600"
          onClick={redirects.prices}
        >
          Precios
        </a>
        <a className="ml-4 cursor-pointer hover:text-green-600">Plataforma</a>
        {checkAdmin}
        {checkAuth}
      </div>
    </nav>
  );
};

export default NavbarWeb;
