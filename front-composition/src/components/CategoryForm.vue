<script setup>
import { ref } from 'vue';

const name = ref('');

const emit = defineEmits(['category-added'])

function submit() {
    const data = new FormData();
    data.append('name', name.value);

    fetch('http://localhost:8080/add_category.php', {
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
        <fieldset>
            <legend>Adicionar categoria</legend>
            <input type="text" required v-model="name" name="category" placeholder="Category">
            <button>Enviar</button>
        </fieldset>
    </form>
</template>
