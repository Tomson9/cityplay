<script setup>
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineOptions({
    layout: AdminLayout
})

defineProps({
    games: Array,
})

const destroyGame = (id) => {
    if (confirm('Supprimer ce parcours ?')) {
        router.delete(route('admin.games.destroy', id))
    }
}
</script>

<template>
    <div class="p-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">
                Parcours
            </h1>

            <a
                :href="route('admin.games.create')"
                class="px-4 py-2 bg-blue-600 rounded"
            >
                Nouveau parcours
            </a>
        </div>

        <div class="bg-white rounded shadow">

            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-left">Titre</th>
                        <th class="p-3 text-left">Description</th>
                        <th class="p-3 w-40"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="game in games"
                        :key="game.id"
                        class="border-b"
                    >
                        <td class="p-3">
                            {{ game.title }}
                        </td>

                        <td class="p-3">
                            {{ game.description }}
                        </td>

                        <td class="p-3">
                            <div v-if="user?.role_id === 1" class="flex gap-2">

                                <a
                                    :href="route('admin.games.edit', game.id)"
                                    class="px-3 py-1 bg-orange-500 rounded"
                                >
                                    Modifier
                                </a>

                                <button
                                    @click="destroyGame(game.id)"
                                    class="px-3 py-1 bg-red-600 rounded"
                                >
                                    Supprimer
                                </button>

                            </div>
                            <div v-else class="flex gap-2">

                                <a
                                    :href="route('gamesession.start', game)"
                                    class="px-3 py-1 bg-orange-500 rounded"
                                >
                                    Commencer
                                </a>

                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>
</template>