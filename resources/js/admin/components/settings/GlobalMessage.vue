<template>
    <div>
        <h2>Do you want to set a global message?</h2>
        <Switch @switched="chengeStateOfSwitch" parent="Global Message"/>
        <div v-if="checked" class="globalMessageForm">
            <div class="globalMessage">
                <label for="">Choose Message</label>
                <input type="text" placeholder="Type your message here...">
            </div>
            <div class="globalMessageDates">
                <div>
                    <label for="">Choose start date</label>
                    <input type="date">
                </div>
                <div>
                    <label for="">Choose end date</label>
                    <input type="date">
                </div>
                <div>
                    <button class="jp-btn jp-btn--md jp-btn-grn">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

import Switch from '../Switch.vue';

export default {
    name: 'GlobalMessage',
    components: {
        Switch
    },
    setup() {
        const checked = ref(false);

        const chengeStateOfSwitch = () => {
            checked.value = !checked.value;
        }

        return {
            checked,
            chengeStateOfSwitch
        };
    }
}
</script>

<style lang="scss" scoped>
.globalMessageForm {
    opacity: 0;
    animation: fadeIn 0.3s ease-in-out forwards;

    input {
        margin-top: 0.5em;
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.globalMessageDates {
    display: flex;
    gap: 2em;
    margin-top: 1em;
}

.globalMessageDates div:last-of-type {
    align-items: end;
    justify-content: end;
    display: flex;

    button {
        width: 100px;
    }
}
</style>