<script setup>
import { onMounted, ref } from 'vue';

import LostItem from './Item.vue'

const props = defineProps({
    'category': Object
})
const items = ref([])

onMounted(() => {
    fetch('http://127.0.0.1:8080/get_items.php?category_id=' + props.category.id)
        .then(res => res.json())
        .then(data => {
            console.log(data)
            items.value = data
        })
})
</script>

<template>
    <h2>{{ category.name }}</h2>
    <LostItem v-for="item in items" :key="item.id" :item="item" />
</template>

<style scoped>
h2 {
    color: red;
    text-decoration: underline;
}
</style>
