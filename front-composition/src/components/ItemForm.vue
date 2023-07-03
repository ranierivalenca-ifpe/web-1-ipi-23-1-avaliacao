<script setup>
import { ref } from 'vue';

const name = ref('');
const description = ref('');
const category = ref('');
const owner = ref('');
const contact = ref('');

const props = defineProps({
    'categories': Array
})

console.group('ItemForm')
console.log(props.categories)
console.groupEnd()

const emit = defineEmits(['item-added'])

function submit() {
    const body = new FormData();

    body.append('name', name.value);
    body.append('description', description.value);
    body.append('category_id', category.value);
    body.append('owner', owner.value);
    body.append('contact', contact.value);
    body.append('status', 'Perdido')

    fetch('http://localhost:8080/add_item.php', {
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
        owner.value = ''
        contact.value = ''
        emit('item-added', data.item)
    })
}

</script>

<template>
    <form @submit.prevent="submit">
        <fieldset>
            <legend>Adicionar item</legend>

            <input type="text" v-model="name" name="name" placeholder="Name">
            <input type="text" v-model="description" name="description" placeholder="Description">
            <input type="text" v-model="owner" name="owner" placeholder="Owner">
            <input type="text" v-model="contact" name="contact" placeholder="Contact">
            <select v-model="category">
                <option disabled selected="selected">Escolha uma categoria</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                    {{ category.name }}
                </option>
            </select> 
            <button>Enviar</button>
        </fieldset>
    </form>
</template>
