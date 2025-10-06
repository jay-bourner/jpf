<template>
    <div class="switch-wrapper">
        <div v-if="parent" class="switch-parent">
            {{ parent }}
            
            </div>
        <label class="switch">
            <input type="checkbox" @change.self="switchChecked" :checked="checked">
            <span class="slider"></span>
        </label>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name: 'Switch',
    props: ['parent'],
    setup(props, context) {
        const checked = ref(false); 
        
        const switchChecked = () => {
            checked.value = !checked.value
            context.emit('switched', checked.value)
        }

        return { 
            checked,
            switchChecked
        };
    },

}
</script>

<style lang="scss" scoped>
.switch-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 225px;
}

.switch-parent {
    margin-right: 1em;
    vertical-align: middle;
    user-select: none;
}

.switch {
    --secondary-container: #3a4b39;
    --primary: #bfe9de;
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
</style>