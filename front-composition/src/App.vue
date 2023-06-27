<script setup>
import { ref, onMounted } from 'vue'

import Category from './components/Category.vue'
import CategoryForm from './components/CategoryForm.vue'
import ItemForm from './components/ItemForm.vue'


const categories = ref([])

function load() {
  fetch('http://127.0.0.1:8080/get_categories.php')
    .then(res => res.json())
    .then(data => {
      categories.value = data
    })
}

// function addToCategory(item) {
//   const category_id = item.category_id
//   // categories.value.find(category => category.id === category_id)
// }

onMounted(() => {
  load()
})
</script>

<template>
  <h1>Items perdidos</h1>
  <Category v-for="category in categories" :key="category.id" :category="category" />

  <hr>

  <CategoryForm @category-added="load" />
  <ItemForm @item-added="load" />

</template>
