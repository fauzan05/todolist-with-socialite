<template>
        <div class="card-body">
            <form @submit.prevent="createTodo" class="m-4">

            </form>
        </div>
</template>

<script>
import { onMounted, ref } from 'vue';

export default {
    data() {
        return {
            categories: [],
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
        createTodo() {
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
        },
        getCategories() {
            axios.get('api/categories').then((response) => {
                this.categories = response.data.data;
            });
        }
    }
};
</script>