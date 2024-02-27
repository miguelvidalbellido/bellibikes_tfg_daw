const hbs = require('handlebars');
const fs = require('fs');
import * as path from 'path';


class EmailSender {
    constructor() {}

    generateHtml(emailModel: any) {
        const templatePath = path.join(__dirname, '../templates', `${emailModel.type}Email.hbs`);
        
        const templateSource = fs.readFileSync(templatePath, 'utf-8');

        const template = hbs.compile(templateSource);

        return template(emailModel.data);
    }
}

export default EmailSender;