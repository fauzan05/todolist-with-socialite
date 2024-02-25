<template>
    <div class="card-body">
        <div class="alert alert-danger" role="alert" v-if="isErrorActive">
            Email atau password salah!
        </div>
        <form @submit.prevent="login" class="m-4">
            <div class="form-group my-3">
                <label for="email">Email</label>
                <input ref="input" type="email" class="form-control" id="email" v-model="loginForm.email" required>
            </div>
            <div class="form-group my-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" v-model="loginForm.password" required>
            </div>
            <div class="form-check form-switch my-3">
                <input class="form-check-input" v-model="loginForm.rememberMe" type="checkbox" role="switch"
                    id="flexSwitchCheckChecked" checked>
                <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary mb-3" style="width: 100%;">Login</button>
        </form>
        <div class="text-center my-3">
            <a href="/login">Registrasi Akun</a>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';

export default {
    data() {
        return {
            loginForm: {
                errors: [],
                email: '',
                password: '',
                rememberMe: false,
            },
            isErrorActive: ref(false), // Pindahkan isAktif ke dalam data
        };
    },
    setup() {
        const input = ref(null);
        onMounted(() => {
            input.value.focus();
        });
        return {
            input
        }
    },
    methods: {
        login() {
            this.persistClient(
                "post",
                "/login",
                this.loginForm
            )
        },
        persistClient(method, uri, form) {
            form.errors = [];
            axios[method](uri, form)
                .then(() => {
                        form.name = "";
                        form.email = "";
                        form.password = "";
                        form.confirmPassword = "";
                        form.errors = [];
                        window.location.href = '/';
                })
                .catch((error) => {
                    console.log("error : " + error.response);
                    this.isErrorActive = true; // Set isErrorActive directly to true
                })
        }
    }
};
</script>
