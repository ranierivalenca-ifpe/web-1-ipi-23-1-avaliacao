<script setup>
import { onMounted, ref, watch } from 'vue';

import LostItem from './Item.vue'

const emit = defineEmits(['category-removed'])

const props = defineProps({
    'category': Object
})
const items = ref([])
const show = ref(false)

function loadItems() {
    fetch('http://localhost:8080/get_items.php?category_id=' + props.category.id)
        .then(res => res.json())
        .then(data => {
            console.log(data)
            items.value = data
        })
}

onMounted(() => {
    loadItems()
})

watch(() => props.category, () => {
    loadItems()
})

function remove() {
    if (!confirm('Tem certeza? Isso também irá deletar todos os itens associados!')) {
        return
    }
    fetch('http://localhost:8080/remove_category.php?id=' + props.category.id)
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                alert('Deu ruim')
                return
            }

            emit('category-removed', props.category)
        })
}
</script>

<template>
    <div class="category">
        <h2 @click="show = !show">
            {{ category.name }}
            <span>({{ items.length }})</span>
        </h2>
        <div class="delete-button" @click="remove()">
            &times;
        </div>
        <div class="items" v-if="show">
            <LostItem v-for="item in items" :key="item.id" :item="item" />
            <h3 v-if="!items.length">
                Nenhum item desta categoria =)
            </h3>
        </div>
    </div>
</template>

<style scoped>
.category {
    border-top: 1px solid gray;
    position: relative;
    overflow: hidden;
}

h2 {
    font-weight: bold;
    padding: .5em;
    cursor: pointer;
}

h2:hover {
    background-color: #eee;
}
.delete-button {
    position: absolute;
    top: 0;
    right: 0;
    padding: .5em 1em;
    font-size: 1.5em;
    cursor: pointer;
    /* make background reddish */
    background-color: #fdd;
    transform: translateX(100%);
    transition: all .3s;
}

.category:hover  .delete-button {
    transform: translateX(0);
}

.delete-button:hover {
    background-color: #f00;
    color: white;
}

h2 span {
    font-weight: normal;
    font-size: .8em;
    color: gray;
}

h3 {
    padding: .5em;
    color: gray;
}

.items {
    display: flex;
    flex-wrap: wrap;
    gap: 1em;
    padding: 1em;
    margin-top: .5em;
    padding-top: 0;
}</style>
