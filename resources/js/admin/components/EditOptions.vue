<template>
    <SvgIcons :icon="icon" @click="showOptionsForm" />
    <div v-if="showModal" class="modal-container">
        <ClassesOptions :instantDisplay="instantDisplay" />
    </div>
</template>

<script>
import { ref } from 'vue';
import SvgIcons from '../../components/SvgIcons.vue';
import ClassesOptions from './ClassesOptions.vue';

export default {
    name: 'EditOptions',
    components: {
        ClassesOptions,
        SvgIcons
    },
    setup() {
        const optionId = ref(null)
        const showModal = ref(false)

        const showOptionsForm = () => {
            showModal.value = !showModal.value;
        }

        const instantDisplay = 'true'

        return {
            icon: 'pencil',
            optionId,
            showModal,
            showOptionsForm,
            instantDisplay
        };
    },
}
</script>

<style>

</style>