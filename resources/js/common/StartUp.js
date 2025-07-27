import { LocalStorageHandler } from "./LocalStorageHandler";
// import { Popup } from "./Popup";
// import { Navigation } from "./Navigation";
import { SvgIcons } from '../components/SvgIcons';

// import { Admin } from "../pages/admin/Admin";
// import { Services } from '../pages/Services';

import { Header } from '../admin/Header';
import { Textarea } from '../forms/Textarea';


class StartUp {
    constructor() {
        // this.cookiConfirmation = LocalStorageHandler.retrieveLocalStorageObject('CookieConfirmation');

        // if(!this.cookiConfirmation || LocalStorageHandler.expired(this.cookiConfirmation[0].cookie)) {
        //     new Popup('cookie');
        // }

        const modules = [
            { class: SvgIcons },
            { class: Header },
            { class: Textarea },
        ];

        modules.forEach((Module) => {
            new Module.class();
        });
    }
}

export { StartUp }