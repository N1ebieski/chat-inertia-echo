<template>
    <div class="h-100">
        <navbar />
        <div class="content">
            <slot />
        </div>
    </div>
</template>

<script>
import Navbar from '../components/Navbar.vue'
import toast from '../mixins/toast.js'

export default {
    metaInfo() {
        return {
            titleTemplate: (title) => {
                return title ? `${title} - ${this.$page.app.name}` : this.$page.app.name
            }
        }
    },
    components: {
        navbar: Navbar
    },
    mixins: [toast]
}
</script>

<style>
.content {
    margin-top: 85px;
}
.transition {
    transition: all 0.9s ease-out 0s;
}
</style>
