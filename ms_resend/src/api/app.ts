import express from 'express';
import dotenv from 'dotenv';
import { Resend } from 'resend';

const app = express();
const port = 3000;

app.use(express.json());

dotenv.config();



app.use('/api/send_mail', require('../routes/mailsRoutes'));

app.listen(port, () => {
  console.log(`Servidor escuchando en http://localhost:${port}`);
});