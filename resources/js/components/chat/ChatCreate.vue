<template>
    <div>
        <form @submit.prevent="store()">
            <div class="form-group">
                <b-form-textarea
                    v-model.trim="form.content"
                    :state="hasError('content')"
                    id="content"
                    placeholder="Enter message"
                />
                <has-error field="content" />
            </div>
            <form-button
                :busy="form.busy"
                title="Send"
                variant="primary"
                type="submit"
            />
        </form>
    </div>
</template>

<script>
import FormButton from '../../components/FormButton.vue'

export default {
    components: {
        'form-button': FormButton
    },
    data() {
        return {
            form: {
                content: '',
                busy: false
            }
        }
    },
    methods: {
        async store() {
            this.form.busy = true
            this.clearErrors()

            await this.$inertia.post(
                this.$route('web.chat.store'),
                this.form,
                {
                    preserveScroll: true,
                    only: ['messages', 'errors'],
                    headers: {
                        'X-Socket-Id': this.$echo.socketId()
                    }
                }
            )

            if (!this.hasErrors()) {
                this.form.content = ''

                this.$emit('chat-store')
            }

            this.form.busy = false
        }
    }
}
</script>
