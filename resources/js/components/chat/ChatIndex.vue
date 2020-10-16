<template>
    <div>
        <div class="list-group list-group-flush">
            <div
                v-for="message in mutMessages"
                class="transition list-group-item"
                :ref="`chat-message-${message.id}`"
                :key="message.id"
            >
                <div class="d-flex">
                    <small>@{{ message.user.name }}</small>
                    <small class="d-flex">
                        <span class="mx-1">|</span>
                        <span>{{ message.created_at_diff }}</span>
                    </small>
                    <small
                        class="d-flex"
                        v-if="can('permission:web.messages.edit') && can(message)"
                    >
                        <span class="mx-1">|</span>
                        <chat-edit
                            :message="message"
                            :key="message.id"
                            @chat-update="update($event)"
                        />
                    </small>
                    <small
                        class="d-flex"
                        v-if="can('permission:web.messages.delete')"
                    >
                        <span class="mx-1">|</span>
                        <chat-delete
                            :message="message"
                            :key="message.id"
                            @chat-destroy="destroy($event)"
                        />
                    </small>
                </div>
                <p class="mb-0">{{ message.content }}</p>
            </div>
        </div>
        <hr class="mt-0" />
        <div v-if="$page.auth.check">
            <chat-create
                v-if="can('permission:web.messages.create')"
                @chat-store="store($event)"
            />
        </div>
        <div v-else>
            <p>
                <inertia-link :href="$route('login')">
                    Log in to reply &raquo;
                </inertia-link>
            </p>
        </div>
    </div>
</template>

<script>
import ChatEdit from './ChatEdit.vue'
import ChatCreate from './ChatCreate.vue'
import ChatDelete from './ChatDelete.vue'
import highlight from '../../mixins/highlight.js'

export default {
    props: {
        messages: Object
    },
    components: {
        'chat-edit': ChatEdit,
        'chat-create': ChatCreate,
        'chat-delete': ChatDelete
    },
    mixins: [highlight],
    created() {
        this.$echo.channel('chat').listen('MessageStore', async ({ message }) => {
            await this.mutMessages.push(message)

            this.highlight({
                ref: `chat-message-${message.id}`,
                variant: 'list-group-item-primary'
            })
        })

        this.$echo.channel('chat').listen('MessageUpdate', async ({ message }) => {
            await this.mutMessages.splice(
                this.mutMessages.findIndex(item => item.id === message.id),
                1,
                message
            )

            this.highlight({
                ref: `chat-message-${message.id}`,
                variant: 'list-group-item-primary'
            })
        })

        this.$echo.channel('chat').listen('MessageDestroy', async ({ message }) => {
            await this.highlight({
                ref: `chat-message-${message.id}`,
                variant: 'list-group-item-danger'
            })

            this.mutMessages.splice(
                this.mutMessages.findIndex(item => item.id === message.id),
                1
            )
        })
    },
    computed: {
        mutMessages() {
            return this.messages.data
        }
    },
    methods: {
        update(id) {
            this.highlight({
                ref: `chat-message-${id}`,
                variant: 'list-group-item-primary'
            })
        },
        destroy(id) {
            this.highlight({
                ref: `chat-message-${id}`,
                variant: 'list-group-item-danger'
            })
        },
        store() {
            const lastMessage = this.mutMessages[this.mutMessages.length - 1]

            this.highlight({
                ref: `chat-message-${lastMessage.id}`,
                variant: 'list-group-item-primary'
            })
        }
    }
}
</script>
