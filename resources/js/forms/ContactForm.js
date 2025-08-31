import { createApp } from 'vue';
import Loader from '../components/Loader.vue';

class ContactForm {
    constructor() {
        this.contactForm = document.querySelector('#contact-form');
        
        if (!this.contactForm) { return; }

        this.submitBtn = this.contactForm.querySelector('button[type="submit"]');
        this.submitBtn.addEventListener('click', () => {
            this.showLoader();
        });
    }

    showLoader() {
        const modalsContainer = document.querySelector('#modals');
        let showModal = true;
        createApp(Loader, {showModal}).mount(modalsContainer);
    }
}

export { ContactForm };