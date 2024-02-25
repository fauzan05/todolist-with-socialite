import './bootstrap';
import { createApp } from 'vue';
import Counter from './components/Counter.vue';
import Register from './components/auth/Register.vue';
import Login from './components/auth/Login.vue';
import CreateTodo from './components/todo/CreateTodo.vue';
import ShowTodos from './components/todo/ShowTodos.vue';

const app = createApp();
app.component('counter', Counter);
app.component('register', Register);
app.component('login', Login);
app.component('create-todo', CreateTodo);
app.component('show-todos', ShowTodos);

app.mount('#app');
