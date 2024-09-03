<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const props = defineProps({
  users:Array
});

const searchQuery = ref('');

const filteredUsers = computed(() => {
  const query = searchQuery.value.toLowerCase();
  
  return props.users
    .filter(user => {
      const nameMatch = user.name.toLowerCase().includes(query);
      const departmentMatch = user.department.name.toLowerCase().includes(query);
      const designationMatch = user.designation.name.toLowerCase().includes(query);
      return nameMatch || departmentMatch || designationMatch;
    })
    .sort((a, b) => {
      return a.name.localeCompare(b.name);
    });
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="mb-6">
                            <input v-model="searchQuery" type="text" placeholder="Search name/designation/department" class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-center">
                            <div v-for="user in filteredUsers" :key="user.id" class="bg-white p-4 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold">{{user.name}}</h2>
                                <h3 class="text-lg">{{ user.designation.name }} </h3>
                                <p class="mt-2 text-gray-600">{{user.department.name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
