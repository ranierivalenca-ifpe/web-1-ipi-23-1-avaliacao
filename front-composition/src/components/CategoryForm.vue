<script setup>
import { ref } from 'vue';

const name = ref('');

const emit = defineEmits(['category-added'])

function submit() {
    const data = new FormData();
    data.append('name', name.value);

    fetch('http://127.0.0.1:8080/add_category.php', {
        method: 'POST',
        body: data
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert('Deu ruim')
            return
        }

        name.value = ''
        emit('category-added', data.category)
    })
}
</script>

<template>
    <form @submit.prevent="submit">
        <input type="text" v-model="name">
        <button>Enviar</button>
    </form>
</template>