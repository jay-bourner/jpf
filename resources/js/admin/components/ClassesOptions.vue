<template>
    <button @click="toggleModal">
        <span class="add-icon"></span>
        <span class="icon-btn-text">Add Option</span>
    </button>
    <teleport to="#modals" v-if="showModal">
        <Modal @close="toggleModal" class="classesOptionsModal">
            <div v-if="!showLoader">
                <h4>{{ title }}</h4>

                <form @submit.prevent="handleSubmit">
                    <label>Venue</label>
                    <select class="modal-input" v-model="venue_id">
                        <option v-for="venue in venues" :key="venue.id" :value="venue.id">
                            {{ venue.name }}
                        </option>
                    </select>
                    
                    <label>Day</label>
                    <select class="modal-input" v-model="day">
                        <option value="monday" selected>Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                        <option value="sunday">Sunday</option>
                    </select>

                    <label>Start Time</label>
                    <input class="modal-input" type="time" v-model="start_time" />

                    <label>Finish Time</label>
                    <input class="modal-input" type="time" v-model="end_time" />

                    <label>Frequency</label>
                    <select class="modal-input" v-model="frequency">
                        <option value="weekly">Weekly</option>
                        <option value="custom">Custom</option>
                    </select>
                    <button>submit</button>
                </form>
            </div>
            <div v-else>
                <Loader />
            </div>
        </Modal>
    </teleport>
</template>

<script>
import { ref } from 'vue';

import Modal from '../../components/Modal.vue';
import Loader from '../../components/Loader.vue';

import FetchAPI from '../APIs/FetchAPI'

export default {
    name: 'ClassesOptions',
    components: {
        Modal,
        Loader
    },
    setup() {
        const venues = ref('');

        const venue_id = ref('');
        const day = ref('');
        const start_time = ref('');
        const end_time = ref('');
        const frequency = ref('');

        const postResult = ref('');
        const postError = ref('');

        const showLoader = ref(false);
        
        const classId = document.querySelector('.class-view__heading').dataset.classId;
        
        const handleSubmit = async () => {
            showLoader.value = true;

            const postData = {
                _token: document.querySelector('input[name="_token"]').value,
                class_id: classId,
                venue_id: venue_id.value,
                day: day.value,
                start_time: start_time.value,
                end_time: end_time.value,
                frequency: frequency.value
            };

            await post('/api/classes/options', postData);
        }

        const setVenues = async () => { 
            get('/api/venues', venues) 
        };

        const get = async (url, ref) => {
            await FetchAPI.get(url).then(response => {
                ref.value = response;
            }).catch(err => {
                ref.error.value = err;
                console.error('Error fetching data:', ref.error.value);
            });
        }

        const post = async (url, obj) => {
            await FetchAPI.post(url, obj).then(response => {
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

        setVenues()

        return {
            venues,
            venue_id,
            day,
            start_time,
            end_time,
            frequency,
            handleSubmit,
            showLoader,
        };
    },
    data() {
        return {
            title: 'Add Option',
            showModal: false,
            showLoader: false,
        };
    },
    methods: {
        toggleModal() {
            this.showModal = !this.showModal
            this.showLoader = false; // Reset loader state when toggling modal
        },
    }
}
</script>