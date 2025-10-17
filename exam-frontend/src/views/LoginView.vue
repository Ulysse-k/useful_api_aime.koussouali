<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()

const email = ref('')
const password = ref('')


const login = async () => {
    try {
        await authStore.login({
      email: email.value,
      password: password.value,
    })
    email.value = ''
    password.value = ''
    } catch (error) {
    error.value = error.response
    console.log({error});
    }    
}


</script>

<template>
  <main>
    <div class="flex items-center text-black justify-center min-h-screen bg-gray-300">
      <div class="w-full max-w-md p-7 space-y-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center text-900">Sign In</h1>

        <form @submit.prevent="login" class="space-y-4">
          <div>
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

          </div>

          <div class="pt-3">
            <button
              type="submit"
              class="w-full flex items-center justify-center gap-1 px-4 py-2 text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-700">
              Se connecter
            </button>
          </div>
        </form>

        <div class="flex justify-center gap-3">
          <p class="pt-2">
            Vous n'avez pas de compte
            <router-link to="/register" class="font-medium text-blue-600 hover:underline">   Créer un compte</router-link>
          </p>

          </div>
      </div>
    </div>
  </main>
</template>

