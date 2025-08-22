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
                        <option value="Monday" :selected="day === option.day">Monday</option>
                        <option value="Tuesday" :selected="day === option.day">Tuesday</option>
                        <option value="Wednesday" :selected="day === option.day">Wednesday</option>
                        <option value="Thursday" :selected="day === option.day">Thursday</option>
                        <option value="Friday" :selected="day === option.day">Friday</option>
                        <option value="Saturday" :selected="day === option.day">Saturday</option>
                        <option value="Sunday" :selected="day === option.day">Sunday</option>
                    </select>

                    <label>Start Time</label>
                    <input class="modal-input" type="time" v-model="start_time" />

                    <label>Finish Time</label>
                    <input class="modal-input" type="time" v-model="end_time" />

                    <label>Frequency</label>
                    <select class="modal-input" v-model="frequency">
                        <option value="weekly" :selected="frequency === option.frequency">Weekly</option>
                        <option value="custom" :selected="frequency === option.frequency">Custom</option>
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

        const postResult = ref('');
        const postError = ref('');
        
        const classId = document.querySelector('.class-view__heading').dataset.classId;
        
        const directModal = ref(props);
        const classOptionId = ref(props.classOptionId);

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

        if(classOptionId.value) {
            const getOption = async () => { 
                FetchAPI.get('/api/option/' + classOptionId.value, option).then(() => {
                    title.value = 'Edit Option';
                    venue_id.value = option.value.venue_id;
                    day.value = option.value.day;
                    start_time.value = option.value.start_time;
                    end_time.value = option.value.end_time;
                    frequency.value = option.value.frequency;

                    console.log('option: ', option.value);

                    console.log('venue_id: ', venue_id.value);
                    console.log('day: ', day.value);
                    console.log('start_time: ', start_time.value);
                    console.log('end_time: ', end_time.value);
                    console.log('frequency: ', frequency.value);
                })
            }

            getOption()
        }


        // make all select boxes and options into objects and loop through
        // giving the ability to select the correct option dynamically
        
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
            handleSubmit,
            showLoader,
            toggleModal,
            option
        };
    },
}
</script>