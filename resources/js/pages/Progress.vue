<template>
    <b-container>
        <h1>
            Progress Bar
        </h1>
        <p>
            <inertia-link :href="$route('web.chat.index')">
                {{ $route().current() }}
            </inertia-link>
        </p>
    </b-container>
</template>

<script>
import Default from '../layouts/Default.vue'

export default {
    metaInfo() {
        return {
            title: 'Inertia Progress Bar Check'
        }
    },
    layout: Default
}
</script>