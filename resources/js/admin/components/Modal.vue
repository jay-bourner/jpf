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

<style scoped>
    .modal {
        min-width: 100px;
        padding: 20px;
        position: absolute;
        background: white;
        border-radius: 10px;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%
    }
    .backdrop {
        top: 0;
        position: fixed;
        background: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        z-index: 10;
    }
    .modal .actions {
        text-align: center;
        margin: 30px 0 10px 0;
    }
    /* .modal .actions a {
        color: #333;
        padding: 8px;
        border: 1px solid #eee;
        border-radius: 5px;
        text-decoration: none;
        margin: 10px;
    } */
    /* .modal.sale {
        background: crimson;
        color: white;
    }
    .modal.sale h1 {
        color: white;
    }
    .modal.sale .actions a {
        color: white;
    } */
</style>