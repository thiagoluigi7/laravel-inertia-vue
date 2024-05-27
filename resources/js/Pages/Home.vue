<script setup>
import axios from 'axios'
import { ref, onMounted, computed } from 'vue'

const quotes = ref([])
const getQuotes = () => {
  const request = axios
    .get('https://type.fit/api/quotes')
    .then((response) => {
      const minCeiled = Math.ceil(0)
      const maxFloored = Math.floor(response.data.length)
      const i = Math.floor(Math.random() * (maxFloored - minCeiled) + minCeiled)
      return response.data[i]
    })
    .then((data) => {
      data.author = data.author.split(',')[0]
      quotes.value = data
    })
}

onMounted(() => {
  getQuotes()
})
</script>

<template>
  <Head title=" | Home" />
  <div class="grid grid-flow-row p-10">
    <h1 class="text-7xl mb-20">Home page</h1>
    <div class="grid">
      <p class="text-4xl">{{ quotes.text }}</p>
      <p class="justify-self-end text-xl">{{ quotes.author }}</p>
    </div>
  </div>
</template>
