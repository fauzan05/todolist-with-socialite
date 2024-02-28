<style>
    .red-text{
        color: red;
        cursor: pointer;
    }
</style>
<template>
    <div class="row d-flex flex-row justify-content-center gap-3">
       <div class="card col-5">
        <create-todo :todos="todos"/>
       </div>
        <div class="card col-5">
            <h2 class="text-center my-3">Semua Todo</h2>
            <div class="card-body py-3">
                <div class="media py-3 border my-3 rounded" v-for="(todo, index) in todos" :key="index">
                    <div class="text-end">
                        <span @click="deleteTodo(todo)" class="red-text me-2">Hapus</span>
                    </div>
                    <div class="media-body text-center">
                        <h6><strong>Kategori : {{ todo.category ? todo.category.name : '' }}</strong></h6>
                        <span>Isi : <br>{{ todo.content }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import CreateTodo from "./CreateTodo.vue";
export default {
    data() {
        return {
            todos: []
        }
    },
    components: {
        CreateTodo
    },
    methods: {
        deleteTodo(todo) {
            // console.log(todo.id);
            axios.post('/todos/delete/' + todo.id).then(() => {
                this.getTodos();
            }).catch((err) => {
            console.log(err);
        });
        },
        getTodos() {
            axios.get('/todos').then((response) => {
                this.todos = response.data.data
            }).catch((err) => {
                console.log(err);
            })
        }
    },
    mounted() {
        // mengambil data json pada endpoint /todos
        axios.get('/todos').then((response) => {
            this.todos = response.data.data;
            console.log(response.data.data)
            // console.log(this.todos)
        }).catch((err) => {
            console.log(err);
        });
    }
}
</script>