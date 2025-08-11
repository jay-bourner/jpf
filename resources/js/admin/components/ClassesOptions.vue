<template>
    <button @click="toggleModal">
        <span class="add-icon"></span>
        <span class="icon-btn-text">Add Option</span>
    </button>
    <teleport to="#modals" v-if="showModal">
        <Modal @close="toggleModal">
            <div v-if="!showLoader">
                <h4>{{ title }}</h4>

                <form>
                    <label>Venue</label>
                    <select class="modal-input">
                        <option value="venue1">Venue 1</option>
                        <option value="venue2">Venue 2</option>
                        <option value="venue3">Venue 3</option>
                    </select>
                    
                    <label>Day</label>
                    <select class="modal-input">
                        <option value="monday" selected>Monday</option>
                        <option value="tuesday">Tuesday</option>
                        <option value="wednesday">Wednesday</option>
                        <option value="thursday">Thursday</option>
                        <option value="friday">Friday</option>
                        <option value="saturday">Saturday</option>
                        <option value="sunday">Sunday</option>
                    </select>

                    <label>Start Time</label>
                    <input class="modal-input" type="time" />

                    <label>Finish Time</label>
                    <input class="modal-input" type="time" />

                    <label>Frequency</label>
                    <select class="modal-input">
                        <option value="custom">Custom</option>
                        <option value="weekly">Weekly</option>
                    </select>
                    <button @click="submitOption">submit</button>
                </form>
            </div>
            <div v-else>
                <Loader />
            </div>
        </Modal>
    </teleport>
</template>

<script>
import Modal from './Modal.vue';
import Loader from './Loader.vue';

export default {
    name: 'ClassesOptions',
    components: {
        Modal,
        Loader
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
        submitOption() {
            this.showLoader = true;
        }
    }
}
</script>