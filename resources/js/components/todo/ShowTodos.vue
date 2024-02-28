<template>
    <div class="row d-flex flex-row justify-content-center gap-3">
       <div class="card col-5">
        <create-todo/>
       </div>
        <div class="card col-5">
            <h2 class="text-center my-3">Semua Todo</h2>
            <div class="card-body py-3">
                <div class="media py-3 border" v-for="(todo, index) in todos" :key="index">
                    <div class="media-body">
                        <h5 class="mt-0">{{ todo.user ? todo.user.name : '' }}</h5>
                        <h6><strong>Category : {{ todo.category ? todo.category.name : '' }}</strong></h6>
                        {{ todo.body }}
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
    mounted() {
        // mengambil data json pada endpoint /todos
        axios.get('/api/todos').then((response) => {
            this.todos = response.data.data;
            console.log(response.data)
            // console.log(this.todos)
        }).catch((err) => {
            console.log(err);
        });
    }
}
</script>