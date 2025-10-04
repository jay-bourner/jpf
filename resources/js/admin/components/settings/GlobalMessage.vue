<template>
    <div>
        <h2>Do you want to set a global message?</h2>
        <label class="switch">
            <input type="checkbox" v-model="checked">
            <span class="slider"></span>
        </label>
        <div v-if="checked" class="globalMessageForm">
            <h3>Global message is enabled</h3>
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

export default {
    name: 'GlobalMessage',
    setup() {
        const checked = ref(false);

        return {
            checked,
        };
    }
}
</script>

<style lang="scss" scoped>
.switch {
    --secondary-container: #3a4b39;
    --primary: #7bb4a5;
    font-size: 17px;
    position: relative;
    display: inline-block;
    width: 3.7em;
    height: 1.8em;
}

.switch input {
    display: none;
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #313033;
    transition: .2s;
    border-radius: 30px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 1.4em;
    width: 1.4em;
    border-radius: 20px;
    left: 0.2em;
    bottom: 0.2em;
    background-color: #aeaaae;
    transition: .4s;
}

input:checked + .slider::before {
    background-color: var(--primary);
}

input:checked + .slider {
    background-color: var(--secondary-container);
}

input:focus + .slider {
    box-shadow: 0 0 1px var(--secondary-container);
}

input:checked + .slider:before {
    transform: translateX(1.9em);
}

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