<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useRouter } from 'vue-router'

const router = useRouter()
const authStore = useAuthStore()

const name = ref ('')
const email = ref('')
const password = ref('')
const password_confirm = ref('')
const error = ref(null)

const register = async () => {
  if (password.value !== password_confirm.value) {
    return "'Les mots de passe ne correspondent pas.'"
  }
  try {
    await authStore.register({
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirm.value,
    })

    name.value = ''
    email.value = ''
    password.value = ''
    password_confirm.value = ''
    
    router.push('/login')
  } catch (error) {
    error.value = error.response
    console.log({error});
  }
}

</script>

<template>
  <main>
    <div class="flex items-center text-black justify-center min-h-screen bg-gray-300 px-4">
      <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-900">Créer un compte</h1>

        <form @submit.prevent="register" class="space-y-4">
          <div>
            <label>Nom</label>
            <input
              v-model="name"
              type="text"
              required
              class="w-full px-3 py-2 mt-1 rounded-md shadow-sm"
            />
            <br />

            <label>Email</label>
            <input
              v-model="email"
              type="email"
              required
              class="w-full px-3 py-2 mt-1 rounded-md shadow-sm"
            />
            <br />

            <label>Mot de passe</label>
            <input
              v-model="password"
              type="password"
              required
              minlength="6"
              class="w-full px-3 py-2 mt-1 rounded-md shadow-sm"
            />
            <br />

            <label>Confirmation de mot de passe</label>
            <input
              v-model="password_confirm"
              type="password"
              required
              minlength="6"
              class="w-full px-3 py-2 mt-7 rounded-md shadow-sm"
            />
            <br />
          </div>

          <div class="pt-3">
            <button
              type="submit"
              class="w-full flex items-center justify-center gap-1 px-4 py-2 text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-700">
              S'inscrire
            </button>
          </div>
        </form>

        <p>
          Déjà un compte ?
          <router-link to="/login" class="font-medium text-blue-600 hover:underline"
            >Se connecter</router-link
          >
        </p>

        <p v-if="error" class="text-sm text-center text-red-600 pt-5">{{ error }}</p>
      </div>
    </div>
  </main>
</template>


