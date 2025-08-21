import { data } from "jquery";

const FetchAPI = {
    async getFetch(url) {
        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            // console.log('Data fetched:', data);
            return data;
        } catch (err) {
            return err.message;
        }
    },

    async get(url, ref, counter = null) {
        await this.getFetch(url).then(response => {
            ref.value = response;
            if(counter) {
                counter.value = ref.value.length;
            }
        }).catch(err => {
            ref.error.value = err;
            console.error('Error fetching data:', ref.error.value);
        });
    },

    async postFetch(endpoint, data) {
        try {
            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return await response.json();
        } catch (err) {
            return err.message;
        }
    },

    async post(url, obj)  {
        await this.postFetch(url, obj).then(response => {
            postResult.value = response;
            if(response.success) {
                window.location.reload();
            }
            console.log('post response', postResult.value);
        }).catch(err => {
            postError = err;
            console.error('Error fetching data:', postError);
        });
    }

    // getFormData(form) {
    //     const formData = new FormData();
    //     const inputs = form.querySelectorAll('input, select, textarea');

    //     inputs.forEach(input => {
    //         if (input.name) {
    //             formData.append(input.name, input.value);
    //         }
    //     });

    //     return formData;
    // }

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
    // async get(url) {
    //     let results;
    //     // return url;
    //     fetch(`/api/${url}`)
    //     .then(response => response.json())
    //     .then(data => {
    //         results = data;
    //     })
    //     .catch(error => {
    //         console.error('Error fetching venues:', error);
    //     });

    //     return results;
    // }
    // async get(endpoint, params = {}) {
    //     const url = new URL(`/api/${endpoint}`);
    //     Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
        
    //     const response = await fetch(url);
    //     if (!response.ok) {
    //         throw new Error(`HTTP error! status: ${response.status}`);
    //     }
    //     return response.json();
    // },

    // async post(endpoint, data) {
    //     const response = await fetch(`/api/${endpoint}`, {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //         body: JSON.stringify(data)
    //     });
        
    //     if (!response.ok) {
    //         throw new Error(`HTTP error! status: ${response.status}`);
    //     }
    //     return response.json();
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

export default FetchAPI;