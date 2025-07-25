class Header {
    constructor() {
        this.actions = document.querySelector('#admin-actions');

        if (this.actions) {
            this.actionLinks = this.actions.querySelectorAll('a');

            this.actionLinks.forEach(link => {
                link.addEventListener('click', () => {
                    const action = link.dataset.action;
                    if (action && action == 'submit-form') {
                        const form = document.querySelector('form');
                        if (form) {
                            form.submit();
                        } else {
                            console.warn('No form found to submit.');
                        }
                    } 
                });
            });
        }
    }

    // handleActionClick(target) {
    //     const action = target.dataset.action;
    //     if (action) {
    //         console.log(`Action triggered: ${action}`);
    //     }
    // }
}

export { Header }