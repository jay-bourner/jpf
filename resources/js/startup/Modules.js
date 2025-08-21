import { SvgIcons } from '../features/SvgIcons';
import { Consent } from './Consent';
import { Header } from '../admin/Header';
import { Textarea } from '../forms/Textarea';
import { Classes } from '../admin/classes/Classes';

class Modules {
    constructor() {
        const modules = [
            { class: Consent },
            { class: SvgIcons },
            { class: Header },
            { class: Textarea },
            { class: Classes }
        ];

        modules.forEach((Module) => {
            new Module.class();
        });
    }
}
export { Modules };