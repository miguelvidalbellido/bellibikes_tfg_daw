// USE TYPESCRIPT
class EmailModel {
    type: string;
    data: any;

    constructor(type: string, data: any) {
        this.type = type;
        this.data = data;
    }

    getTemplate() {
        switch (this.type) {
            case "createBooking":
                return '../templates/createBooking.hbs';
            case "confirmBooking":
                return '../templates/confirmBooking.hbs';
            case 'createAccount':
                return '../templates/createAccount.hbs';
            default:
                throw new Error('Email type not found');
        }
    }
}

export default EmailModel;