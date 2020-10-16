export default {
    computed: {
        errors: {
            get() {
                return this.$page.errors
            },
            set(newValue) {
                this.$page.errors = newValue
            }
        }
    },
    methods: {
        hasError(name) {
            if (this.hasErrors()) {
                if (typeof this.errors[name] !== 'undefined') {
                    return false
                }

                return true
            }

            return null
        },
        hasErrors() {
            return Object.keys(this.errors).length !== 0
        },
        clearErrors() {
            this.errors = {}
        }
    }
}
