<template>
    <GlobalMessage />
    <MyDetails />
</template>

<script>
import { ref } from 'vue';

import GlobalMessage from './GlobalMessage.vue';
import MyDetails from './MyDetails.vue';

export default {
    name: 'Settings',
    components: {
        GlobalMessage,
        MyDetails
    },
}
</script>

<style lang="scss" scoped>
</style>