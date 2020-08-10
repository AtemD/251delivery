<template>
    <span class="badge">{{cartcount}}</span>
</template>

<script>
    export default {
        props:['cartcount'],

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
