<template>
    <b-container class="d-flex align-items-center vh-count">
        <div class="row w-100 h-100">
            <div class="col-lg-8 m-auto">
                <b-card>
                    <template v-slot:header>
                        <h5 class="mb-0">
                            {{ title }}
                        </h5>
                    </template>
                    <form @submit.prevent="login()">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">
                                Email
                            </label>
                            <div class="col-md-7">
                                <b-form-input
                                    v-model.trim="form.email"
                                    :state="hasError('email')"
                                    :disabled="form.busy"
                                    name="email"
                                />
                                <has-error field="email" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">
                                Hasło
                            </label>
                            <div class="col-md-7">
                                <b-form-input
                                    v-model.trim="form.password"
                                    :state="hasError('password')"
                                    :disabled="form.busy"
                                    name="password"
                                />
                                <has-error field="password" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3" />
                            <div class="col-md-7 d-flex">
                                <b-form-checkbox
                                    v-model="form.remember"
                                    :disabled="form.busy"
                                    :state="hasError('remember')"
                                    name="remember"
                                >
                                    Zapamiętaj mnie
                                </b-form-checkbox>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 offset-md-3 d-flex">
                                <form-button
                                    :busy="form.busy"
                                    :disabled="form.busy"
                                    title="Zaloguj"
                                    variant="primary"
                                    type="submit"
                                />
                            </div>
                        </div>
                    </form>
                </b-card>
            </div>
        </div>
    </b-container>
</template>

<script>
import FormButton from '../components/FormButton.vue'
import Default from '../layouts/Default.vue'

export default {
    layout: Default,
    metaInfo() {
        return {
            title: this.title
        }
    },
    components: {
        'form-button': FormButton
    },
    data() {
        return {
            form: {
                email: '',
                password: '',
                remember: false,
                busy: false
            },
            title: 'Log In'
        }
    },
    methods: {
        async login() {
            this.form.busy = true
            this.clearErrors()

            await this.$inertia.post(
                this.$route('login'),
                this.form,
                {
                    preserveScroll: true,
                    only: ['errors']
                }
            )

            if (!this.hasErrors()) {
                this.$root.$emit('toast', {
                    variant: 'success',
                    title: 'Autentykacja',
                    body: 'Pomyślnie zalogowano'
                })
            }

            this.form.busy = false
        }
    },
    head() {
        return {
            title: this.title
        }
    }
}
</script>

<style>
.vh-count {
    min-height: calc(100vh - 85px);
}
</style>
