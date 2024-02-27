"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = __importDefault(require("express"));
const dotenv_1 = __importDefault(require("dotenv"));
const resend_1 = require("resend");
const app = (0, express_1.default)();
const port = 3000;
dotenv_1.default.config();
const resend = new resend_1.Resend(process.env.RESEND_API_KEY);
app.get('/', (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const { data, error } = yield resend.emails.send({
        from: "admin@bellidel.eu",
        to: ["miguel.vidal.bell@gmail.com"],
        subject: "hello world",
        html: "<strong>it works!</strong>",
    });
    if (error) {
        return res.status(400).json({ error });
    }
    res.status(200).json({ data });
}));
app.listen(port, () => {
    console.log(`Servidor escuchando en http://localhost:${port}`);
});
