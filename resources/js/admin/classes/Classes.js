

import { createApp } from 'vue';

// import ClassesOptions from '../components/ClassesOptions.vue';
import EditOptions from '../components/EditOptions.vue';


class Classes {
    constructor() {
        this.admin = document.querySelector('#jpf-admin');
        
        if (!this.admin) { return; }

        this.editOptions = this.admin.querySelectorAll('.edit-option');
        
        this.editOptions.forEach(option => {
            const optionId = option.getAttribute('data-option-id');
            createApp(EditOptions, { optionId }).mount(option);
        });
    }
}

export { Classes };