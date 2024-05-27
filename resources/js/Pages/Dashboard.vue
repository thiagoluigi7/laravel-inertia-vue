<script setup>
import axios from 'axios'
import { ref, onMounted, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()
// const user = computed(() => page.props.auth.user)
const authUser = page.props.auth.user

const transactions = ref([])
const user = ref([])

const getTransactions = () => {
  axios
    .get(route('transactions', { id: authUser.id }))
    .then((res) => (transactions.value = res.data))
    .catch((error) => console.log(error))
}

const getUser = () => {
  axios
    .get(route('users', { id: authUser.id }))
    .then((res) => (user.value = res.data))
    .catch((error) => console.log(error))
}

onMounted(() => {
  getUser()
  getTransactions()
})
</script>

<template>
  <Head title=" | Dashboard" />
  <div>
    <div class="flex justify-between px-20">
      <h1 class="title">Welcome {{ user.name }}</h1>
      <h1 class="title">Bank account {{ user.wallet }}</h1>
    </div>
    <div>
      <ul class="title">
        Transactions
        <li v-for="transaction in transactions" :key="transaction.id">
          <div class="flex justify-center gap-2">
            <p>Value {{ transaction.value }} -</p>
            <p v-if="user.id === transaction.from.id">
              To {{ transaction.to.name }} -
            </p>
            <p v-else="">From {{ transaction.from.name }} -</p>
            <p class="text-red-700" v-if="user.id === transaction.from.id">
              Cash out
            </p>
            <p class="text-green-500" v-else="">Cash in</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>
