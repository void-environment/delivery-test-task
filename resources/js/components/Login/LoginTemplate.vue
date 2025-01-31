<template>

    <div class="login-container">
        <h2>Вход</h2>
        <form @submit.prevent="login">

            <div class="form-group">
                <label for="email">Email</label>
                <input v-model="form.email" type="email" id="email" required>
                <span v-if="errors.email" class="error">{{ errors.email }}</span>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input v-model="form.password" type="password" id="password" required>
                <span v-if="errors.password" class="error">{{ errors.password }}</span>
            </div>

            <button type="submit">Войти</button>

            <p v-if="message" class="error">{{ message }}</p>
        </form>
    </div>
    
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

const form = ref({
    email: "",
    password: ""
});

const errors = ref({});
const message = ref("");

const login = async () => {
    errors.value = {};
    message.value = "";

    try {
        const response = await axios.post("/api/login", form.value);
        localStorage.setItem("token", response.data.token);
        axios.defaults.headers.common["Authorization"] = `Bearer ${response.data.token}`;
        router.push("/dashboard");
    } catch (error) {
        if (error.response && error.response.status === 422) {
            errors.value = error.response.data.errors || {};
            message.value = error.response.data.message || "Ошибка авторизации.";
        } else {
            message.value = "Ошибка сервера.";
        }
    }
};
</script>

<style scoped>
.login-container {
    max-width: 300px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background: #f9f9f9;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background: #42b983;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.error {
    color: red;
    font-size: 0.9em;
}
</style>
