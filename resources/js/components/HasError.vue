<template>
    <b-form-invalid-feedback
        v-if="hasError(field) === false"
        :state="false"
    >
        {{ $page.errors[field][0] }}
    </b-form-invalid-feedback>
</template>

<script>
import hasError from '../mixins/hasError.js'

export default {
    props: {
        field: {
            type: String,
            required: true
        }
    },
    mixins: [hasError]
}
</script>
