import asyncHandler from "express-async-handler";
import { Request, Response } from "express";
import { Resend } from "resend";
import EmailModel from "../models/emailModel";
import EmailSender from "../utils/emailSender";

const resend = new Resend(process.env.RESEND_API_KEY);

export const sendEmail = asyncHandler(
  async (req: Request, res: Response): Promise<void> => {

    const { from, to, subject, emailType, emailData } = req.body;

    if (!from || !to || !subject || !emailType || !emailData) {
        res.status(400).json({ error: "All fields are required" });
        return;
    }

    if (!from.includes("@bellidel.eu")) {
      res.status(400).json({ error: "Email must be @bellidel.eu" });
      return;
    }

    // CREATE EMAIL MODEL
    const emailModel = new EmailModel(emailType, emailData);
    const emailSender = new EmailSender();
    const html = emailSender.generateHtml(emailModel);


    const { data, error } = await resend.emails.send({
      from: from,
      to: [to],
      subject: subject,
      html: html,
    });

    if (error) {
      res.status(400).json({ error });
      return;
    }

    res.status(200).json({ data });
  }
);

module.exports = { sendEmail };