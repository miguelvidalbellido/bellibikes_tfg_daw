// Create a middleware to verify if the petition has a token to has a same value that the token in .env file
// If the token is valid, the middleware will call the next function
// If the token is invalid, the middleware will return a 401 error

import { Request, Response, NextFunction } from 'express';
import dotenv from 'dotenv';

// Cargar variables de entorno desde .env
dotenv.config();

export default function verifyToken(req: Request, res: Response, next: NextFunction): void {
  const token = req.body.token;
  console.log(req.body)
  const secretTokenLaravel = process.env.TOKEN_LARAVEL;
  const secretTokenSpring = process.env.TOKEN_SPRING;
  
  console.log("Conexioon");
  console.log(req.body);
  if (!token) {
    console.log("Token no proporcionado");
    res.status(400).send('Token no proporcionado');
    return;
  }

  if (token === secretTokenLaravel || token === secretTokenSpring) {
    console.log("Token correcto");
    next();
  } else {
    res.status(403).send('Acceso denegado');
    return;
  }

}

module.exports = verifyToken;