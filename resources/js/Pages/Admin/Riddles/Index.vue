<script setup>
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineOptions({
    layout: AdminLayout
})

defineProps({
    riddles: Array,
})

const destroyRiddle = (id) => {
    if (confirm('Supprimer cette énigme ?')) {
        router.delete(route('admin.riddles.destroy', id))
    }
}
</script>

<template>
    <div class="p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Énigmes
            </h1>

            <a
                :href="route('admin.riddles.create')"
                class="px-4 py-2 bg-blue-600 text-white rounded"
            >
                Nouvelle énigme
            </a>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">

            <table class="w-full">

                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-left">Lieu</th>
                        <th class="p-3 text-left">Difficulté</th>
                        <th class="p-3 text-left">Question</th>
                        <th class="p-3 text-left">Image</th>
                        <th class="p-3"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="riddle in riddles"
                        :key="riddle.id"
                        class="border-b"
                    >
                        <td class="p-3">
                            {{ riddle.place.name }}
                        </td>

                        <td class="p-3">
                            {{ riddle.difficulty }}/5
                        </td>

                        <td class="p-3">
                            {{ riddle.question }}
                        </td>

                        <td class="p-3">

                            <img
                                v-if="riddle.image"
                                :src="`/storage/${riddle.image}`"
                                class="w-20 h-20 object-cover rounded"
                            >

                        </td>

                        <td class="p-3">
                            <div class="flex gap-2">

                                <a
                                    :href="route('admin.riddles.edit', riddle.id)"
                                    class="px-3 py-1 bg-orange-500 text-white rounded"
                                >
                                    Modifier
                                </a>

                                <button
                                    @click="destroyRiddle(riddle.id)"
                                    class="px-3 py-1 bg-red-600 text-white rounded"
                                >
                                    Supprimer
                                </button>

                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>
</template>