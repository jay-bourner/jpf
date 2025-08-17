class FetchAPI {
    constructor() {
        this.baseUrl = '/api';
    }

    async get(endpoint, params = {}) {
        const url = new URL(`${this.baseUrl}/${endpoint}`);
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
        
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    }

    async post(endpoint, data) {
        const response = await fetch(`${this.baseUrl}/${endpoint}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    }
    
    // async get(object) {
    //     try {
    //         const response = await fetch(`${object.url}`, {
    //             method: 'GET',
    //         });

    //         if (!response.ok) {
    //             throw new Error(`HTTP error! status: ${response.status}`);
    //         }

    //         let data = null
            
    //         if(object.dataType === 'json') {
    //             data = await response.json();
    //         } else if(object.dataType === 'html') {
    //             data = await response.text();
    //         }

    //         return data;
    //     } catch (error) {
    //         console.error('Error:', error);
    //         throw error;
    //     }
    // }

    // async post(object, form = '') {
    //     try {
    //         let formData = '';

    //         if(form !== '') {
    //             formData = this.getFormData(form);
    //         }

    //         if(object.formData) {
    //             formData = object.formData;
    //         }

    //         const response = await fetch(`${object.url}`, {
    //             method: 'POST',
    //             body: formData,
    //         });

    //         if (!response.ok) {
    //             throw new Error(`HTTP error! status: ${response.status}`);
    //         }

    //         const data = await response.json();
    //         return data;
    //     } catch (error) {
    //         console.error('Error:', error);
    //         throw error;
    //     }
    // }
}

export { FetchAPI }