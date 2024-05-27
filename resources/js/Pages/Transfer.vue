<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import TextInput from '../Components/TextInput.vue'

const page = usePage()
const user = computed(() => page.props.auth.user)

const form = useForm({
  to: null,
  value: null,
})

const submit = () => {
  form.post(route('transactions', { id: parseInt(user.id) }))
}
</script>

<template>
  <Head title=" | Transfer" />
  <h1 class="title">Transfer area</h1>
  <div class="w-2/4 mx-auto">
    <form @submit.prevent="submit">
      <TextInput
        name="to"
        type="text"
        v-model="form.to"
        :message="form.errors.to"
      />

      <TextInput
        name="value"
        type="text"
        v-model="form.value"
        :message="form.errors.value"
      />

      <div>
        <button class="primary-btn" :disabled="form.processing">
          Transfer
        </button>
      </div>
    </form>
  </div>
</template>
