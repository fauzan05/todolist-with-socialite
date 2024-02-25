<template>
    <div class="card-body">
        <div class="alert alert-success" role="alert" v-if="isAktif">
            Berhasil membuat akun! Silahkan login!
        </div>
        <form @submit.prevent="register" class="m-4">
            <div class="form-group my-3">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" v-model="createForm.name" required>
            </div>
            <div class="form-group my-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" v-model="createForm.email" required>
            </div>
            <div class="form-group my-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" v-model="createForm.password" required>
            </div>
            <div class="form-group my-3">
                <label for="password">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirmPassword" v-model="createForm.confirmPassword"
                    required>
            </div>
            <button type="submit" class="btn btn-primary mb-3" style="width: 100%;">Register</button>
        </form>
        <div class="text-center my-3">
            <a href="/login">Login Kembali</a>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'

export default {
    data() {
        return {
            createForm: {
                errors: [],
                name: '',
                email: '',
                password: '',
                confirmPassword: ''
            },
            isAktif: ref(false) // Pindahkan isAktif ke dalam data
        };
    },
    methods: {
        register() {
            if (this.createForm.password != this.createForm.confirmPassword) {
                console.log("password tidak sama");
                this.createForm.password = "";
                this.createForm.confirmPassword = "";
            } else {
                this.persistClient(
                    "post",
                    "/register",
                    this.createForm
                )
            }
        },
        persistClient(method, uri, form) {
            form.errors = [];
            axios[method](uri, form)
                .then(() => {
                    this.isAktif = ref(true); // Mengubah nilai isAktif menjadi true saat registrasi berhasil
                    form.name = "";
                    form.email = "";
                    form.password = "";
                    form.confirmPassword = "";
                    form.errors = [];
                })
                .catch((error) => {
                   console.log(error);
                })
        }
    }
};
</script>
