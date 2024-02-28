<template >
    <h2 class="text-center my-3">Buat Todo</h2>
    <div class="d-flex flex-column align-items-center justify-content-center">
        <form @submit.prevent="createTodos" action="#" class="row d-flex flex-column align-items-center justify-content-center">
            <div class="my-3 col-12">
                <label for="exampleFormControlTextarea1" class="form-label">Isi Todo</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="content"></textarea>
            </div>
            <div class="my-3 col-12">
                <select class="form-select" aria-label="Default select example" v-model="selected_category">
                        <option value="" disabled selected>Pilih</option>
                        <option :value="category.id" v-for="(category, index) in categories" :key="index">{{ category.name }}</option>
                </select>
            </div>
            <button type="submit" class="btn btn-dark mb-3">Buat Todo</button>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            categories: [],
            content: null,
            selected_category: null
        }
    },
    props: {
        todos: Array
    },
    methods: {
        createTodos() {
            // console.log(this.content + this.selected_category);
            axios.post('/todos', {
                content: this.content,
                category_id: this.selected_category // Sertakan selected_category dalam data yang dikirimkan
            }).then((response) => {
                this.todos.unshift(response.data.data);
                // this.getTodos();
                // console.log(response.data)
                // console.log(this.todos)
                this.content = null;
            }).catch(err => {
                console.log(err);
            });
        },
    },
    mounted() {
        // mengambil data json pada endpoint /categories
        axios.get('/categories').then((response) => {
            this.categories = response.data.data;
        }).catch((err) => {
            console.log(err);
        });
    }
}
</script>
