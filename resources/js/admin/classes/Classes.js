

import { createApp } from 'vue';

import EditOptions from '../components/EditOptions.vue';


class Classes {
    constructor() {
        this.admin = document.querySelector('#jpf-admin');
        
        if (!this.admin) { return; }

        this.sidebarDropDown = this.admin.querySelector('.admin-sidebar__dropdown--container');
        this.sidebarDropdownHeading = this.admin.querySelector('.admin-sidebar__dropdown--heading');
        this.sidebarDropdownList = this.admin.querySelector('.admin-sidebar__dropdown--list');
        this.editOptions = this.admin.querySelectorAll('.edit-option');
        
        this.sidebarDropdownHeading.addEventListener('click', () => {
            this.sidebarDropdownHeading.classList.toggle('active');
            this.sidebarDropdownList.classList.toggle('open');
        });

        this.editOptions.forEach(option => {
            const optionId = option.getAttribute('data-option-id');
            createApp(EditOptions, { optionId }).mount(option);
        });
    }
}

export { Classes };