<template>
    <span class="svg-icon svg-icon--plus">
        <svg width="30px" height="30px">
            <use href="/image/svg/sprite-sheet/sprite-sheet-3.svg#plus"></use>
        </svg>
    </span>
</template>

<script>
export default {
    name: 'SvgIcons',
    props: {
        icon: {
            type: String,
            required: true
        }
    },
    // computed: {
    //     iconPath() {
    //         return `/image/svg/sprite-sheet/sprite-sheet-3.svg#${this.icon}`;
    //     }
    // }
}
</script>