<template>
    <Head title="Login" />
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <b-container>
                <b-row>
                <b-col lg="12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                    <div>
                        <router-link to="/" class="d-inline-block auth-logo">
                        <img class="avatar-md" src="/images/sei.png" alt="" height="20" />
                        </router-link>
                    </div>
                    <p class="mt-3 fs-15 fw-medium">
                       Science Education Institute
                    </p>
                    </div>
                </b-col>
                </b-row>

                <b-row class="justify-content-center">
                <b-col md="8" lg="6" xl="5">
                    <b-card no-body class="mt-4">
                    <b-card-body class="p-4">
                        <div class="text-center mt-2">
                        <h5 class="text-primary">Scholarship Portal</h5>
                        <p class="text-muted mt-n1">Sign in to continue to Portal.</p>
                        </div>
                        <div class="p-2 mt-4">
                        <b-alert v-model="authError" variant="danger" class="mt-3" dismissible>{{ authError }}</b-alert>

                        <div>
                            
                        </div>

                        <form @submit.prevent="submit">
                            <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="form.email" />
                            <div class="invalid-feedback">
                                <span></span>
                            </div>
                            </div>

                            <div class="mb-3">
                            <div class="float-end">
                                <router-link to="/forgot-password" class="text-muted">Forgot
                                password?</router-link>
                            </div>
                            <label class="form-label" for="password-input">Password</label>
                            <div class="position-relative auth-pass-inputgroup mb-3">
                                <input type="password" v-model="form.password" class="form-control pe-5" placeholder="Enter password"
                                id="password-input" />
                                <b-button variant="link" class="position-absolute end-0 top-0 text-decoration-none text-muted"
                                type="button" id="password-addon">
                                <i class="ri-eye-fill align-middle"></i>
                                </b-button>
                                <div class="invalid-feedback">
                                <span></span>
                                </div>
                            </div>
                            </div>

                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" />
                            <label class="form-check-label" for="auth-remember-check">Remember
                                me</label>
                            </div>

                            <div class="mt-4">
                                <div v-if="Object.keys(form.errors).length != 0" class="alert alert-warning text-center mt-4 mb-4" role="alert" v-text="form.errors.email"></div>
                                <b-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" variant="success" class="w-100" type="submit">
                                    Sign In
                                </b-button>
                            </div>

                        </form>
                        </div>
                    </b-card-body>
                    </b-card>

                    <div class="mt-4 text-center">
                    <p class="mb-0">
                        Don't have an account ?
                        <Link to="/register" class="fw-semibold text-primary
                        text-decoration-underline">
                        Signup
                        </Link>
                    </p>
                    </div>
                </b-col>
                </b-row>
            </b-container>
        </div>

      
  </div>
</template>
<script>
export default {
    layout: null,
   
}
</script>
<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: 'kradjumli@gmail.com',
    password: '123456789',
    remember: false
});

const submit = () => {
    form.post('login', {
        onFinish: () => form.reset('password'),
    });
};
</script>