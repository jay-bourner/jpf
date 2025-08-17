<template>
    <div class="loader">
        <SvgIcons :icon="icon" />
    </div>
</template>

<script>
import SvgIcons from './SvgIcons.vue';

export default {
    name: 'Loader',
    components: {
        SvgIcons
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