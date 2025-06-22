import { SvgIcons } from './SvgIcons';

class Messages {
    static getErrors(json, form) {
        Messages.clearMessages(form);

        if(json.error) {
            for(const [key, value] of Object.entries(json.error)) {
                const input = form.querySelector(`#${key}`);
                input.parentElement.classList.add('error');
                input.insertAdjacentHTML('afterend', `<span class="error-message">${value}</span>`);
            }
            return false;
        }
        return true;
    }

    static addErrorMessages(errors, form) {
        if(errors) {
            for(const [key, value] of Object.entries(errors)) {
                const elem = form.querySelector(`#${key}`);
                elem.parentElement.classList.add('error');
                elem.insertAdjacentHTML('afterend', `<span class="error-message">${value}</span>`);
            }
        }
    }

    static clearMessages(form) {
        const errors = form.querySelectorAll('.error');
        for(const error of errors) {
            error.classList.remove('error');
        }

        const errorMessages = form.querySelectorAll('.error-message');
        for(const errorMessage of errorMessages) {
            errorMessage.remove();
        }

        const successMessages = form.querySelectorAll('.success');
        for(const successMessage of successMessages) {
            successMessage.remove();
        }
    }

    static createBanner(type, message) {
        const banner = document.createElement('div');
        banner.classList.add('alert', `alert-${type}`);

        let icon = '';
        if(type === 'warning') {
            icon = 'warning';
        } else if(type === 'success') {
            icon = 'check-circle';
        }

        const textSpan = document.createElement('span');
        textSpan.innerText = message;

        const svg = SvgIcons.createSpan(icon);
        banner.append(svg, textSpan);
        
        return banner;
    }

    static showMessage(elem, data) {
        console.log(elem)
        const successBanner = Messages.createBanner(data.type, data.message);

        elem.insertAdjacentElement('afterend', successBanner);
    }

    // static adjustPanelSize(elem, size) {
    //     const currentSize = elem.getBoundingClientRect();
    //     let panelSize

    //     if(this.classContent.classList.contains('hide')) {
    //         panelSize = (currentSize.height + size) +'px';
    //     } else {
    //         panelSize = (currentSize.height + size) + 'px';
    //     }

    //     elem.style.height = panelSize;
    // }
}

export { Messages }