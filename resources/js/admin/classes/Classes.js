

import { vue, createApp } from 'vue';

import ClassesOptions from '../components/ClassesOptions.vue';
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


        // for(let option of this.editOptions) {
        //     const optionId = option.dataset.optionId;

        //     const value = {
        //         optionId: optionId
        //     }
        //     console.log(optionId);
        //     const Vue = createApp(EditOptions, value);
        //     Vue.mount(option);


        //     // option.addEventListener('click', () => {
        //     //     // e.preventDefault();
        //     //     const optionId = option.getAttribute('data-option-id');
        //     //     console.log('Edit option clicked for option ID:', optionId);
        //     //     // this.openEditOptionModal(optionId);
        //     // });
        // }
        
        // console.log(ClassesOptions);
        // new Vue({

        //     el: '#classesOptions',
        //     data: {
        //         options: [],
        //         venues: [],
        //         selectedVenue: null,
        //         frequency: '',
        //         day: '',
        //         errors: {}
        //     },
        //     methods: {
        //     },
        // })
    }
}

export { Classes };