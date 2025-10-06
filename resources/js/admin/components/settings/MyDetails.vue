<template>
    <div class="my-details-wrapper">
        <h2>My details</h2>
        <div v-for="element in elements" :key="element.name" class="element">
            <div>{{ element.name }}</div>
            <div v-if="!element.setInput">
                <span>{{ element.value }}</span>
            </div>
            <div v-else>
                <div v-if="(element.name !== 'Password')">
                    <input :type="element.type" :placeholder="element.placeholder" :value="element.value">
                </div>
                <div v-else class="change-password">
                    <teleport to="#modals">
                        <Model @close="(element.setInput = !element.setInput)">
                            <h2>Change Password</h2>
                            <div>
                                <input :type="element.type" placeholder="Old Password">
                            </div>
                            <div>
                                <input :type="element.type" placeholder="New Password">
                            </div>
                            <div>
                                <input :type="element.type" placeholder="Confirm Password">
                            </div>
                            <div style="text-align: right; margin-top: 1em;">
                                <button class="jp-btn jp-btn--sm jp-btn-grn" @click="(element.setInput = !element.setInput)">Save</button>
                            </div>
                        </Model>
                    </teleport> 
                </div>
            </div>
            <button v-if="!element.setInput || element.type == 'password'" class="jp-btn jp-btn--sm jp-btn-grn" @click="(element.setInput = !element.setInput)">Change</button>
            <button v-else class="jp-btn jp-btn--sm jp-btn-grn" @click="(element.setInput = !element.setInput)">Save</button>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

import Switch from '../Switch.vue';
import Model from '../../../components/Modal.vue';

export default {
    name: 'MyDetails',
    components: {
        Switch,
        Model
    },
    setup() {
        const elements = ref([
            {
                name: 'Name',
                type: 'text',
                value: 'jaime',
                placeholder: 'Type your first name here...',
                checked: false,
                setInput: false
            },
            {
                name: 'Email',
                type: 'email', 
                value: 'jlhgkfhg@ljfkhgfhkf.com',
                placeholder: 'Type your email here...',
                checked: false,
                setInput: false
            },
            {
                name: 'Password',
                type: 'password',
                value: '********',
                placeholder: 'Type your password here...',
                checked: false,
                setInput: false
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
        justify-content: space-between;
        gap: 1em;
        height: 50px;
        width: 400px;

        > div:first-of-type {
            font-weight: bold;
        }

        > div:nth-of-type(2) {
            width: 100%;

            span, input {
                width: 100%;
                text-align: right;
                display: block;
            }
        }

        button {
            border-radius: 5px;
            width: 75px;
        }
    }

    .change-password {
        input {
            margin-bottom: 0.5em;
        }
    }

    // .my-details-input {
    //     display: flex;
    //     align-items: center;
    //     justify-content: space-between;
    //     gap: 1em;
    //     width: 350px;
    //     animation: fadeIn 0.3s ease-in-out forwards;

    //     input {
    //         width: 300px;
    //     }
    // }

    // .my-details-input.change-password {
    //     flex-direction: column;
    //     display: flex;
    //     align-items: center;
    //     justify-content: space-between;
    //     gap: 1em;
    //     width: 500px;

    //     & > div {
    //         display: flex;
    //         align-items: center;
    //         justify-content: space-between;
    //         gap: 1em;
    //         width: 500px;

    //         input {
    //             width: 300px;
    //         }

    //         &:last-of-type {
    //             justify-content: end;
    //         }
    //     }
    // }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
</style>