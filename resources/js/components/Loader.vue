<template>
    <Modal v-if="showModal" @close="toggleModal">
        <div class="loader">
            <SvgIcons :icon="icon" />
        </div>
    </Modal>
    <div class="loader" v-if="!showModal">
        <SvgIcons :icon="icon" />
    </div>
</template>

<script>
import { ref } from 'vue';
import SvgIcons from './SvgIcons.vue';
import Modal from './Modal.vue';

export default {
    name: 'Loader',
    props: ['showModal'],
    components: {
        SvgIcons,
        Modal
    },
    setup(props) {
        const showModal = ref(false)

        if (props.showModal) {
            showModal.value = props.showModal
        }

        return { showModal }
    },
    data() {
        return {
            icon: 'spinner',
            showLoader: false,
        };
    },
    methods: {
        toggleModal() {
            this.showLoader = !this.showLoader
        },
    }
}
</script>