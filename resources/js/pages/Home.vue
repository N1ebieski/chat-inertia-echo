<template>
    <b-container>
        <chat-index :messages="messages" class="mb-3" />
    </b-container>
</template>

<script>
import ChatIndex from '../components/chat/ChatIndex.vue'
import Default from '../layouts/Default.vue'

export default {
    metaInfo() {
        return {
            title: 'Simple Chat via Laravel Echo Server'
        }
    },
    components: {
        'chat-index': ChatIndex
    },
    layout: Default,
    props: {
        messages: Object
    }
}
</script>
