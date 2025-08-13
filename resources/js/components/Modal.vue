<template>
    <div class="backdrop" @click.self="closeModal">
        <div class="modal">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    methods: {
        closeModal() {
            this.$emit('close')
        }
    },
}
</script>