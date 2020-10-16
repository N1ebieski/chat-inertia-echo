<template>
    <div>
        <a href="#" @click.prevent="destroy()">Delete</a>
    </div>
</template>

<script>
export default {
    props: {
        message: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            form: {
                busy: false
            }
        }
    },
    methods: {
        async destroy() {
            const confirm = await this.$bvModal.msgBoxConfirm('Are you sure?', {
                centered: true
            })

            if (confirm === true) {
                this.$emit('chat-destroy', this.message.id)

                this.$inertia.delete(
                    this.$route('web.chat.destroy', [this.message.id]),
                    {
                        preserveScroll: true,
                        only: ['messages'],
                        headers: {
                            'X-Socket-Id': this.$echo.socketId()
                        }
                    }
                )
            }
        }
    }
}
</script>
