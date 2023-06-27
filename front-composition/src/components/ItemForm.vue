<script setup>
import { onMounted, ref } from 'vue';

const categories = ref([]);
const name = ref('');
const description = ref('');
const category = ref('');
const emit = defineEmits(['item-added'])

onMounted(() => {
    fetch('http://127.0.0.1:8080/get_categories.php')
        .then(res => res.json())
        .then(data => {
        categories.value = data
        })
})

function submit() {
    const body = new FormData();

    body.append('name', name.value);
    body.append('description', description.value);
    body.append('category_id', category.value);
    body.append('date', new Date().toISOString().slice(0, 19).replace('T', ' '))
    body.append('status', 'Perdido')

    fetch('http://127.0.0.1:8080/add_item.php', {
        method: 'POST',
        body
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert('Deu ruim')
            return
        }

        name.value = ''
        description.value = ''
        category.value = ''
        emit('item-added', data.item)
    })
}

</script>

<template>
    <form @submit.prevent="submit">
        <input type="text" v-model="name">
        <input type="text" v-model="description">
        <select v-model="category">
            <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
            </option>
        </select> 
        <button>Enviar</button>
    </form>
</template>