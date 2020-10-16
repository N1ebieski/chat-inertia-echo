<template>
    <b-navbar
        toggleable="lg"
        type="light"
        variant="light"
        fixed="top"
        class="border border-bottom"
    >
        <b-navbar-brand>
            <inertia-link :href="$route('web.chat.index')" class="navbar-brand">
                {{ $page.app.name }}
            </inertia-link>
        </b-navbar-brand>

        <b-navbar-toggle target="nav-collapse" class="border-0" />

        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav class="mr-auto">
                <b-nav-item>
                    <inertia-link class="nav-link" :href="$route('web.progress')">
                        Potwierdzenie
                    </inertia-link>
                </b-nav-item>
            </b-navbar-nav>
            <b-navbar-nav class="ml-auto">
                <b-nav-item-dropdown
                    v-if="$page.auth.check"
                    :text="$page.auth.user.data.name"
                    variant="light"
                    right
                >
                    <template v-slot:button-content>
                        {{ $page.auth.user.data.name }}
                    </template>
                    <b-dropdown-item>
                        <logout />
                    </b-dropdown-item>
                </b-nav-item-dropdown>
                <b-nav-item v-else>
                    <inertia-link class="btn btn-primary" :href="$route('login')">
                        Zaloguj się
                    </inertia-link>
                </b-nav-item>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
import Logout from '../components/Logout.vue'

export default {
    components: {
        logout: Logout
    }
}
</script>
