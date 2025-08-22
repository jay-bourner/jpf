<template>
    <SvgIcons :icon="icon" @click="showOptionsForm" />
    <div v-if="showModal" class="modal-container">
        <ClassesOptions :instantDisplay="instantDisplay" :classOptionId="optionId" />
    </div>
</template>

<script>
import { ref } from 'vue';
import SvgIcons from '../../components/SvgIcons.vue';
import ClassesOptions from './ClassesOptions.vue';

export default {
    name: 'EditOptions',
    props: ['optionId'],
    components: {
        ClassesOptions,
        SvgIcons
    },
    setup(props) {
        const optionId = ref(props.optionId)
        const showModal = ref(false)
        const instantDisplay = 'true'

        const showOptionsForm = () => {
            showModal.value = !showModal.value;
        }

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