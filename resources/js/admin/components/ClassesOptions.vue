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
                        <option v-for="venue in venues" :key="venue.id" :value="venue.id" :selected="venue.id === option.venue_id">
                            {{ venue.name }}
                        </option>
                    </select>
                    
                    <label>Day</label>
                    <select class="modal-input" v-model="day">
                        <option v-for="day in daysList" :key="day" :value="day" :selected="day === option.day">{{ day }}</option>
                    </select>

                    <label>Start Time</label>
                    <input class="modal-input" type="time" v-model="start_time" />

                    <label>Finish Time</label>
                    <input class="modal-input" type="time" v-model="end_time" />

                    <label>Frequency</label>
                    <select class="modal-input" v-model="frequency">
                        <option v-for="frequency in frequencyList" :key="frequency" :value="frequency" :selected="frequency === option.frequency">{{ frequency }}</option>
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
    props: [ 'instantDisplay', 'classOptionId' ],
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
        const option = ref({})

        const daysList = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        const frequencyList = ['Weekly', 'Custom'];

        const directModal = ref(props);
        const classOptionId = ref(props.classOptionId);

        const handleSubmit = async () => {
            showLoader.value = true;

            const classId = document.querySelector('.class-view__heading').dataset.classId;

            const postData = {
                _token: document.querySelector('input[name="_token"]').value,
                class_id: parseInt(classId),
                venue_id: venue_id.value,
                day: day.value,
                start_time: start_time.value,
                end_time: end_time.value,
                frequency: frequency.value
            };

            if(typeof(classOptionId.value) !== 'undefined') {
                postData._method = 'PUT';
                await FetchAPI.put(`/api/options/update/${classOptionId.value}`, postData);
            } else {
                await FetchAPI.post('/api/classes/options', postData);
            }
        }

        const setVenues = async () => { 
            FetchAPI.get('/api/venues', venues) 
        };

        if(classOptionId.value) {
            const getOption = async () => { 
                FetchAPI.get('/api/option/' + classOptionId.value, option).then(() => {
                    title.value = 'Edit Option';
                    venue_id.value = option.value.venue_id;
                    day.value = option.value.day;
                    start_time.value = option.value.start_time;
                    end_time.value = option.value.end_time;
                    frequency.value = option.value.frequency;
                })
            }

            getOption()
        }

        const toggleModal = () => {
            showModal.value = !showModal.value
            showLoader.value = false; // Reset loader state when toggling modal
        }

        if (directModal.value.instantDisplay) {
            toggleModal();
            showButton.value = false;
        }

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
            daysList,
            frequencyList,
            handleSubmit,
            showLoader,
            toggleModal,
            option
        };
    },
}
</script>