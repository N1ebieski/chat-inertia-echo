export default {
    methods: {
        highlight({ ref, variant }) {
            const elem = this.$refs[ref]

            if (typeof elem[0] !== 'undefined') {
                elem[0].classList.add(variant)

                setTimeout(() => this.unhighlight({ ref, variant }), 3000)

                return new Promise(resolve => setTimeout(resolve, 4000))
            }
        },
        unhighlight({ ref, variant }) {
            const elem = this.$refs[ref]

            if (typeof elem[0] !== 'undefined') {
                elem[0].classList.remove(variant)
            }
        }
    }
}
