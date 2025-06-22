import { LocalStorageHandler } from "./LocalStorageHandler";
import { Popup } from "./Popup";
import { Navigation } from "./Navigation";
import { SvgIcons } from '../components/SvgIcons';

// import { Admin } from "../pages/admin/Admin";
// import { Services } from '../pages/Services';


class StartUp {
    constructor() {
        // this.cookiConfirmation = LocalStorageHandler.retrieveLocalStorageObject('CookieConfirmation');

        // if(!this.cookiConfirmation || LocalStorageHandler.expired(this.cookiConfirmation[0].cookie)) {
        //     new Popup('cookie');
        // }

        const modules = [
            { class: SvgIcons },
        ];

        modules.forEach((Class) => {
            new Class.class();
        });
    }
}

export { StartUp }