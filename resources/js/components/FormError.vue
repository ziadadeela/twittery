<template>
    <div v-if="errors" class="has-error">
        <slot></slot>
        <p v-for="error in errors" class="help-block text-left text-red text-xs italic">
            {{error}}
        </p>
    </div>
    <div v-else>
        <slot></slot>
    </div>

</template>

<script>
    export default {
        props: ['errors'],
        mounted() {

        },
    }
</script>

<style>
    .has-error {
        color: #ff4941;
    }
    .has-error .help-block{

    }
</style>
