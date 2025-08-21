<template>
    <button v-if="showButton" @click="toggleModal">
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
    props: [ 'instantDisplay' ],
    setup(props) {
        const title = ref('Add Option');
        const showModal = ref(false);
        const showLoader = ref(false);
        const showButton = ref(true);

        const venues = ref('');

        const venue_id = ref('');
        const day = ref('');
        const start_time = ref('');
        const end_time = ref('');
        const frequency = ref('');

        const postResult = ref('');
        const postError = ref('');
        
        const classId = document.querySelector('.class-view__heading').dataset.classId;
        
        const directModal = ref(props);

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

            await FetchAPI.post('/api/classes/options', postData);
        }

        const setVenues = async () => { 
            FetchAPI.get('/api/venues', venues) 
        };

        const toggleModal = () => {
            showModal.value = !showModal.value
            showLoader.value = false; // Reset loader state when toggling modal
        }
        // const instantDisplay = props.instantDisplay

        if (directModal.value.instantDisplay) {
            toggleModal();
            showButton.value = false;
        }

        // console.log(props)
        console.log(directModal.value.instantDisplay)
        setVenues()

        return {
            title,
            showModal,
            showLoader,
            showButton,
            venues,
            venue_id,
            day,
            start_time,
            end_time,
            frequency,
            handleSubmit,
            showLoader,
            toggleModal
        };
    },
    // data() {

    //     return {
    //     };
    // },
    // methods: {
        
    // }
}
</script>