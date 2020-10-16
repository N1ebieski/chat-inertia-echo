<template>
    <div>
        <a href="#" @click.prevent="edit()">Edit</a>
        <b-modal
            :id="`chat-edit-${message.id}`"
            @ok="update($event)"
            title="Edit message"
            centered
        >
            <p class="my-4">
                <b-form-textarea
                    v-model.trim="form.content"
                    :state="hasError('content')"
                    id="content"
                    placeholder="Enter message"
                />
                <has-error field="content" />
            </p>
            <template v-slot:modal-footer="{ ok, cancel }">
                <b-button variant="secondary" @click="cancel()">
                    Cancel
                </b-button>
                <form-button
                    :busy="form.busy"
                    title="Send"
                    variant="primary"
                    @click.native="ok()"
                />
            </template>
        </b-modal>
    </div>
</template>

<script>
import FormButton from '../../components/FormButton.vue'

export default {
    props: {
        message: {
            type: Object,
            required: true
        }
    },
    components: {
        'form-button': FormButton
    },
    data() {
        return {
            form: {
                content: this.message.content,
                busy: false
            }
        }
    },
    methods: {
        edit() {
            this.clearErrors()

            this.$bvModal.show(`chat-edit-${this.message.id}`)
        },
        async update(bvModalEvt) {
            bvModalEvt.preventDefault()

            this.form.busy = true

            await this.$inertia.put(
                this.$route('web.chat.update', [this.message.id]),
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
                this.$bvModal.hide(`chat-edit-${this.message.id}`)

                this.$emit('chat-update', this.message.id)
            }

            this.form.busy = false
        }
    }
}
</script>
