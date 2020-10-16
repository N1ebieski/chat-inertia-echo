export default {
    created() {
        this.$root.$on('toast', ({ title, body, variant }) => {
            this.$bvToast.toast(body, {
                title: title,
                toaster: 'b-toaster-bottom-right',
                variant: variant,
                appendToast: true
            })
        })
    },
    beforeDestroy() {
        this.$root.$off('toast')
    }
}
