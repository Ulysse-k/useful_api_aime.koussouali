<template>
  <aside class="bg-gray-800 fixed h-screen w-64">
    <div class="p-4">
      <h1 class="text-2xl font-bold text-white">Dashboard</h1>
    </div>
    <nav class="mt-8">
      <ul>
        <li>
          <router-link to='/' class="flex items-center p-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">Home</router-link>
          <router-link to='/' class="flex items-center p-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">Module 1</router-link>
          <router-link to='/' class="flex items-center p-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">Module 2</router-link>
          <router-link to='/' class="flex items-center p-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">Module 3</router-link>
        </li>

        <li v-for="m in modules" :key="m.id">
            <router-link to='/' class="flex items-center p-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md">{{ m.name }}</router-link>
        </li>
      </ul>
    </nav>
  </aside>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { RouterLink } from 'vue-router';

const modules = ref('')
// const m = ref('')


async function getModules() {
  const url = "http://127.0.0.1:8000/api/modules";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Response status: ${response.status}`);
    }

    const result = await response.json();
    modules.value = result.value
    console.log(result);
  } catch (error) {
    console.error(error.message);
  }
}

onMounted( () => {
getModules()
})
</script>

<style scoped>

</style>