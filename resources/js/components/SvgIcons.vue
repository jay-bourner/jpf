<template>
    <svg width="30px" height="30px">
        <use :href="icon"></use>
    </svg>
</template>

<script>
export default {
    name: 'SvgIcons',
    props: [
        'icon'
    ],
    data() {
        return {
            icon: `/image/svg/sprite-sheet/sprite-sheet-1.svg#${this.icon}`
        };
    },
}
</script>