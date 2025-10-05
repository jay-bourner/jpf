<template>
    <div class="my-details-wrapper">
        <h2>My details</h2>
        <div v-for="element in elements" :key="element.name" class="element">
            <Switch @switched="chengeStateOfSwitch(element)" :parent="'Change ' +element.name" />
            <div class="my-details-input" v-if="(element.name !== 'Password' && element.checked)">
                <label for="">{{ element.name }}</label>
                <input :type="element.type" :placeholder="element.placeholder">
                <button class="jp-btn jp-btn--md jp-btn-grn">Save</button>
            </div>
            <div class="my-details-input change-password" v-if="(element.name === 'Password' && element.checked)">
                <div>
                    <label for="">Old Password</label>
                    <input :type="element.type" :placeholder="element.placeholder">
                </div>
                <div>
                    <label for="">New Password</label>
                    <input :type="element.type" :placeholder="element.placeholder">
                </div>
                <div>
                    <label for="">Confirm Password</label>
                    <input :type="element.type" :placeholder="element.placeholder">
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
    name: 'MyDetails',
    components: {
        Switch
    },
    setup() {
        const elements = ref([
            {
                name: 'Name',
                type: 'text', 
                placeholder: 'Type your first name here...',
                checked: ref(false)
            },
            {
                name: 'Email',
                type: 'email', 
                placeholder: 'Type your email here...',
                checked: ref(false)
            },
            {
                name: 'Password',
                type: 'password', 
                placeholder: 'Type your password here...',
                checked: ref(false)
            }
        ])
        
        const chengeStateOfSwitch = (elem) => {
            elem.checked = !elem.checked
        }

        return {
            elements,
            chengeStateOfSwitch
        };
    }
}
</script>

<style lang="scss" scoped>
.my-details-wrapper {
    margin: 2em 0;

    .element {
        display: flex;
        position: relative;
        align-items: center;
        gap: 1em;
        height: 50px;

        &:last-of-type {
            align-items: start;
            height: fit-content;
        }
    }

    .my-details-input {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1em;
        width: 350px;
        animation: fadeIn 0.3s ease-in-out forwards;

        input {
            width: 300px;
        }
    }

    .my-details-input.change-password {
        flex-direction: column;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1em;
        width: 500px;

        & > div {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1em;
            width: 500px;

            input {
                width: 300px;
            }

            &:last-of-type {
                justify-content: end;
            }
        }
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>