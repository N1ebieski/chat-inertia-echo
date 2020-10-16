export default class HasError {
    constructor(options = {}) {
        this.errors = options.errors
    }

    hasError() {
        if (this.hasErrors()) {
            if (typeof this.errors[name] !== 'undefined') {
                return false
            }

            return true
        }

        return null
    }

    hasErrors() {
        return Object.keys(this.errors).length !== 0
    }

    clearErrors() {
        this.errors = {}
    }
}
