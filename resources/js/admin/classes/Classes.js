

import { createApp } from 'vue';

// import ClassesOptions from '../components/ClassesOptions.vue';
import EditOptions from '../components/EditOptions.vue';


class Classes {
    constructor() {
        this.admin = document.querySelector('#jpf-admin');
        
        if (!this.admin) { return; }

        // this.sidebarDropDown = this.admin.querySelector('.admin-sidebar__dropdown--heading');
        this.editOptions = this.admin.querySelectorAll('.edit-option');
        
        // this.sidebarDropDown.addEventListener('click', () => {
        //     const container = this.sidebarDropDown.parentElement;
        //     const hasDropdown = container.parentElement;

        //     hasDropdown.classList.toggle('active');
        //     container.classList.toggle('open');
        // });

        this.editOptions.forEach(option => {
            const optionId = option.getAttribute('data-option-id');
            createApp(EditOptions, { optionId }).mount(option);
        });
    }
}

export { Classes };