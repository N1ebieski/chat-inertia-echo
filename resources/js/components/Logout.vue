<template>
    <a @click.prevent="logout()">
        Wyloguj się
    </a>
</template>

<script>
export default {
    methods: {
        async logout() {
            await this.$inertia.post(this.$route('logout'))

            this.$root.$emit('toast', {
                variant: 'success',
                title: 'Autentykacja',
                body: 'Pomyślnie wylogowano'
            })
        }
    }
}
</script>
