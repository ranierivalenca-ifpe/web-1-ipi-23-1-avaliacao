<script setup>
const props = defineProps({
    'item': Object
})

function changeStatus() {
    const body = new FormData()

    body.append('id', props.item.id)
    body.append('status', props.item.status == 'Perdido' ? 'Achado' : 'Perdido')

    fetch('http://localhost:8080/change_status.php', {
        method: 'POST',
        body
    })
    .then(res => res.json())
    .then(data => {
        if (!data.success) {
            alert('Deu ruim')
            return
        }

        props.item.status = data.status
    })
}
</script>

<template>
    <div :class="{lost: item.status == 'Perdido', found: item.status == 'Achado'}">
        <h3>{{ item.name }}</h3>
        <p>
            {{ item.description }}
            <br>
            <small>{{ item.owner }} - {{ item.contact }}</small>
        </p>
        <button @click="changeStatus">
            Marcar como 
            {{ item.status == 'Perdido' ? 'Achado' : 'Perdido' }}
        </button>
    </div>
</template>

<style scoped>
div {
    padding: .5em;
    border-radius: .5em;
    box-shadow: 1px 1px .5em gray;
}
h3 {
    font-weight: bold;
    border-bottom: 1px solid gray;
    margin-bottom: .5em;
}
.lost {
    box-shadow: 1px 1px .5em red;
}
.found {
    box-shadow: 1px 1px .5em green;
}
</style>