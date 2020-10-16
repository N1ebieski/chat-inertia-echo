<template>
    <b-button v-bind="$attrs" :disabled="busy">
        <b-spinner v-if="busy" small class="mb-1" />
        <span v-if="busy">Sending...</span>
        <span v-else>{{ title }}</span>
    </b-button>
</template>

<script>
export default {
    props: {
        busy: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            required: true
        }
    }
}
</script>
