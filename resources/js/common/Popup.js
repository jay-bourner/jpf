import { LocalStorageHandler } from "./LocalStorageHandler";

class Popup {
    constructor(type, element = null) {
        this.container = document.querySelector('.container');

        if(!this.container) { return }

        switch(type) {
            case 'cookie':
                this.#cookieNotification();
                break;
            case 'info':
                this.#infoBox(element);
                break;
            // case 'spinner':
            //     this.#spinner();
            //     break;
            default:
                return;
        }
    }

    #cookieNotification() {
        const cookieDiv = document.createElement('div');
        cookieDiv.classList.add('cookie-notification');

        const cookieText = document.createElement('p');
        cookieText.textContent = "This website uses cookies to ensure you get the best experience on our website.";

        const cookieButton = document.createElement('button');
        cookieButton.textContent = "Got it!";
        cookieButton.classList.add('jp-btn--md');
        cookieButton.addEventListener('click', () => {
            let date = Date.now();
            let sixMonths = 14515200000; // 6 months in milliseconds

            LocalStorageHandler.addToLocalStorageObject('CookieConfirmation', 'cookie', { expiry: date+sixMonths});
            this.#removePopup();
        });
        cookieDiv.append(cookieText, cookieButton);
        
        this.container.appendChild(this.#backdrop(cookieDiv));
    }
    
    #backdrop(elem) {
        const backdrop = document.createElement('div');
        backdrop.classList.add('backdrop');

        backdrop.addEventListener('click', () => {
            backdrop.classList.add('hide');
            setTimeout(() => {
                backdrop.remove();
            }, 300);
        });
        
        backdrop.appendChild(elem);

        return backdrop;
    }
    
    #infoBox(element) {
        this.backdrop = this.#backdrop(element);
        element.addEventListener('click', (e) => {
            e.stopPropagation();
        });
        this.container.appendChild(this.backdrop);
    }

    // #spinner() {
    //     const message = document.querySelector('.popupBox');

    //     if(message) { message.remove(); }

    //     this.#removePopup();

    //     this.backdrop = this.activateBackdrop();

    //     const spinnerDiv = document.createElement('div');
    //     spinnerDiv.classList.add('spinner');

    //     this.backdrop.insertAdjacentHTML('beforeend', spinnerDiv.outerHTML);
    //     Main.body.appendChild(this.backdrop);
    // }


    // #popupBox(messages, messageType) {
    //     const spinner = document.querySelector('.spinner');

    //     if(spinner) { spinner.remove(); }

    //     this.#removePopup();

    //     this.backdrop = this.activateBackdrop()

    //     const boxDiv = document.createElement('div');
    //     boxDiv.classList.add('popupBox');

    //     let closeSpan = document.createElement('span');
    //     closeSpan.classList.add('popupCloseBtn');
    //     closeSpan.append("X");
    //     boxDiv.append(closeSpan);
        
    //     const errorDiv = document.createElement('div');
    //     errorDiv.classList.add(`${messageType}-messages`);

    //     for(const [key, value] of Object.entries(messages)) {
    //         const errorSpan = document.createElement('span')
    //         errorSpan.textContent = value;
    //         errorDiv.append(errorSpan);
    //     }
    //     boxDiv.insertAdjacentHTML('beforeend', errorDiv.outerHTML)
        
    //     this.backdrop.append(boxDiv);
    //     Main.body.appendChild(this.backdrop);
    // }

    #removePopup() {
        this.backdrop = document.querySelector('.backdrop');
        if(this.backdrop) {
            this.backdrop.remove();
        }
    }
}

export { Popup }