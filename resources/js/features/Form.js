import { Messages } from './Messages.js';

class Form {
    constructor() {
        this.getVenues();
    }

    getVenues() {
        this.venues = null;

        this.get({ 
            url: 'admin/classes/venues',
            dataType: 'json'
        })
        .then(data => {
            this.venues = data;
            this.initializeFormInputs(); 
        })
        .catch(error => {
            console.error('Error fetching venues:', error);
        });
    }

    getFormData(form) {
        this.formElements = form.querySelectorAll('input, select, textarea');

        const formData = new FormData();
        for(const input of this.formElements) {
            if(input.type === 'file') {
                formData.append(input.name, input.files[0]);
                continue;
            }
            formData.append(input.name, input.value);
        }

        return formData;
    }

    initializeFormInputs(data = {}) {
        this.classOptionsFormInputs = {
            inputs: [
                {
                    fieldType: 'select',
                    type: 'select',
                    name: 'venue_id',
                    value: (data.venue) ? data.venue : null,
                    label: 'What venue is the class at?',
                    options: this.venues,
                },
                {
                    fieldType: 'select',
                    type: 'select',
                    name: 'day',
                    value: (data.day) ? data.day : null,
                    label: 'What day is the class?',
                    options: [
                        {
                            value: 'Monday',
                            text: 'Monday'
                        },
                        {
                            value: 'Tuesday',
                            text: 'Tuesday'
                        },
                        {
                            value: 'Wednesday',
                            text: 'Wednesday'
                        },
                        {
                            value: 'Thursday',
                            text: 'Thursday'
                        },
                        {
                            value: 'Friday',
                            text: 'Friday'
                        },
                        {
                            value: 'Saturday',
                            text: 'Saturday'
                        },
                        {
                            value: 'Sunday',
                            text: 'Sunday'
                        }
                    ]
                },
                {
                    fieldType: 'input',
                    type: 'time',
                    name: 'start_time',
                    value: (data.start_time) ? data.start_time : null,
                    label: 'Start Time'
                },
                {
                    fieldType: 'input',
                    type: 'time',
                    name: 'end_time',
                    value: (data.end_time) ? data.end_time : null,
                    label: 'End Time'
                },
                {
                    fieldType: 'select',
                    type: 'select',
                    name: 'frequency',
                    value: (data.frequency) ? data.frequency : null,
                    label: 'How frequent is the class?',
                    options: [
                        {
                            value: 'Custom',
                            text: 'Custom'
                        },
                        {
                            value: 'Weekly',
                            text: 'Weekly'
                        }
                    ]
                },
                {
                    fieldType: 'button',
                    type: 'button',
                    name: 'Save',
                },
            ]
        }
    }

    async get(object) {
        try {
            const response = await fetch(`${object.url}`, {
                method: 'GET',
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            let data = null
            
            if(object.dataType === 'json') {
                data = await response.json();
            } else if(object.dataType === 'html') {
                data = await response.text();
            }

            return data;
        } catch (error) {
            console.error('Error:', error);
            throw error;
        }
    }

    async post(object, form = '') {
        try {
            let formData = '';

            if(form !== '') {
                formData = this.getFormData(form);
            }

            if(object.formData) {
                formData = object.formData;
            }

            const response = await fetch(`${object.url}`, {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error:', error);
            throw error;
        }
    }

    // temp functions for testing 
    async requestOptions(obj) {
        let formData = new FormData();

        for(const [key, value] of Object.entries(obj.data)) {
            formData.append(key, value);
        }

        return fetch(`${obj.url}`, {
            method: obj.type,
            dataType: obj.dataType,
            body: formData,
            // contentType: false,
            // processData: false,
            // cache: false
        })
        .then(response => response.json())
        .then(json => {
            return json;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    async request(obj, form = '') {
        // if(form !== '') {
            const formData = this.getFormData(form);
        // }
        
        return fetch(`${obj.url}`, {
            method: obj.type,
            dataType: obj.dataType,
            body: formData,
            // contentType: false,
            // processData: false,
            // cache: false
        })
        .then(response => response.json())
        .then(json => {
            return json;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    async delete(obj) {
        const formData = new FormData();
        formData.append('id', obj.id);
        formData.append('name', obj.name);

        return fetch(obj.url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(json => {
            return json
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    classOptionForm(data = {}) {
        this.initializeFormInputs(data);

        const optionsForm = document.createElement('div');
        optionsForm.classList.add('options-form');

        this.classOptionsFormInputs.inputs.forEach(input => {
            const inputDiv = document.createElement('div');
            inputDiv.classList.add('input-group');

            if(input.label) {
                const label = document.createElement('label');
                label.innerText = input.label;
                inputDiv.append(label);
            }

            if(input.fieldType === 'input') {
                const inputElement = document.createElement('input');
                inputElement.type = input.type;
                inputElement.name = input.name;
                inputElement.value = data[input.name] || '';
                inputElement.placeholder = input.label;

                inputDiv.append(inputElement);
            }

            if(input.fieldType === 'select') {
                const selectElement = document.createElement('select');
                selectElement.name = input.name;

                input.options.forEach(option => {
                    if(option.id) {
                        option.value = option.id;
                    }

                    if(option.name) {
                        option.text = option.name;
                    }

                    const optionElement = document.createElement('option');
                    optionElement.value = option.value;
                    optionElement.text = option.text;

                    if(input.value) {
                        if(input.value === option.text) {
                            optionElement.selected = true;
                        }
                    }

                    selectElement.append(optionElement);
                });

                inputDiv.append(selectElement);
            }

            if(input.fieldType === 'button') {
                const buttonElement = document.createElement('button');
                buttonElement.type = 'button';
                buttonElement.name = input.name;
                buttonElement.innerText = input.name || 'Save';
                buttonElement.classList.add('jp-btn--md', 'jp-btn-gry');

                buttonElement.addEventListener('click', () => {
                    const infoPanel = document.querySelector('.info-panel');
                    const class_id = infoPanel.dataset.classPanelId;

                    const formData = this.getFormData(optionsForm);
                    formData.append('class_id', class_id);
                    let api_function = 'saveOptions';

                    if(data.option_id) {
                        formData.append('option_id', data.option_id);
                        api_function = 'updateOptions';
                    }

                    this.post({
                        url: `admin/classes/${api_function}`,
                        formData: formData
                    })
                    .then(data => {
                        if(data.result == 'success') {
                            let success = {
                                'type': 'success',
                                'message': 'Success'
                            }
                            Messages.showMessage(infoPanel, success);
                            
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                        
                        if(data.result == 'error') {
                            let error = {
                                'type': 'warning',
                                'message': 'Something went wrong. Please try again'
                            }
                            Messages.showMessage(infoPanel, error);
                        }
                    })
                });

                inputDiv.append(buttonElement);
            }
            optionsForm.append(inputDiv);
        });

        return optionsForm;
    }

    // for outputting formdata to console
    test(formData) {
        for(const [key, value] of formData.entries()) {
            console.log(key + '- ' + value);           
        }
    }
}

export { Form };