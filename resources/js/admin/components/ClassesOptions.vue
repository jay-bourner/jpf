<template>
    <button @click="toggleModal">
        <span class="add-icon"></span>
        Add Option
    </button>
    <teleport to="#modals" v-if="showModal">
        <Modal @close="toggleModal">
            <div v-if="!showLoader">
                <h4>{{ title }}</h4>
                <button @click="submitOption">submit</button>
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

<style>
    h4 {
        border-bottom: 1px solid #ddd;
        display: inline-block;
        text-align: center;
        width: 100%;
        padding-bottom: 10px;
        margin-top: 0;
    }
</style>