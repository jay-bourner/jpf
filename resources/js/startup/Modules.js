import { SvgIcons } from '../features/SvgIcons';
import { Consent } from './Consent';
import { Header } from '../admin/Header';
import { Textarea } from '../forms/Textarea';
import { Classes } from '../admin/classes/Classes';
import { ContactForm } from '../forms/ContactForm';

class Modules {
    constructor() {
        const modules = [
            { class: Consent },
            { class: SvgIcons },
            { class: Header },
            { class: Textarea },
            { class: Classes },
            { class: ContactForm },
        ];

        modules.forEach((Module) => {
            new Module.class();
        });
    }
}
export { Modules };