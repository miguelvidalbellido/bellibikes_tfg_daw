import express from 'express';
import { appendFile } from 'fs';
const router = express.Router();
const mailsController = require('../controllers/mailsController');
const verifyConnection = require('../middleware/verifyConnection');

router.post('/', verifyConnection, mailsController.sendEmail);

module.exports = router;