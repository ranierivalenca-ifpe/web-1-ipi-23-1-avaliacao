<script setup>
import { ref, onMounted } from 'vue'

import Category from './components/Category.vue'
import CategoryForm from './components/CategoryForm.vue'
import ItemForm from './components/ItemForm.vue'


const categories = ref([])

function load() {
  fetch('http://localhost:8080/get_categories.php')
    .then(res => res.json())
    .then(data => {
      categories.value = data
    })
}

onMounted(() => {
  load()
})
</script>

<template>
  <main>
    <div>
      <h1>Items perdidos</h1>
      <div class="categories">
        <Category v-for="category in categories" :key="category.id" :category="category" @category-removed="load" />
      </div>
    </div>
  
    <div>
      <CategoryForm @category-added="load" />
      <ItemForm @item-added="load" :categories="categories" />
    </div>
  </main>

</template>

<style scoped>
main {
  display: grid;
  grid-template-columns: 3fr 1fr;
  gap: 2em;
}
.categories {
  display: flex;
  flex-direction: column;
}
</style>