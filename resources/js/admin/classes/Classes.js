

import { createApp } from 'vue';

import EditOptions from '../components/EditOptions.vue';


class Classes {
    constructor() {
        this.admin = document.querySelector('#jpf-admin');
        
        if (!this.admin) { return; }
        
        this.classesList = this.admin.querySelector('#classesList');
        this.classesView = this.admin.querySelector('#classes-view');

        if(this.classesList) {
            const deactiveBtn = this.admin.querySelector('[data-action="disable-classes"]');
            const deleteBtn = this.admin.querySelector('[data-action="delete-classes"]');

            deactiveBtn?.addEventListener('click', () => {
                const selectedClasses = this.#getSelectedClasses();

                this.#disableClasses(selectedClasses);
            });

            deleteBtn?.addEventListener('click', () => {
                const selectedClasses = this.#getSelectedClasses();

                this.#deleteClasses(selectedClasses);
            });
        }

        if(this.classesView) {
            this.#buildEditOptions();
        }
    }

    #buildEditOptions() {
        this.editOptions = this.admin.querySelectorAll('.edit-option');

        this.editOptions.forEach(option => {
            const optionId = option.getAttribute('data-option-id');
            createApp(EditOptions, { optionId }).mount(option);
        });
    }

    #getSelectedClasses() {
        const selectedClasses = Array.from(this.classesList.querySelectorAll('input[name="selected_classes[]"]:checked'))
            .map(checkbox => checkbox.value);

        return selectedClasses;
    }

    #disableClasses(selectedClasses) {
        console.log(selectedClasses);
    }

    #deleteClasses(selectedClasses) {
        console.log(selectedClasses);
    }
}

export { Classes };