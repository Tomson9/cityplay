<script setup>
import PlayerLayout from '@/Layouts/PlayerLayout.vue'
import { Link } from '@inertiajs/vue3'

defineOptions({
    layout: PlayerLayout
})

const props = defineProps({
    sessions: Array
})

function destroy(id) {
    if (confirm('Supprimer cette session ?')) {
        router.delete(route('sessions.destroy', id))
    }
}
</script>

<template>

    <div class="max-w-4xl mx-auto">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold">
                Mes parties
            </h1>

            <p class="text-gray-600">
                Reprends ou consulte tes sessions de jeu
            </p>
        </div>

        <!-- EMPTY STATE -->
        <div  class="bg-white p-6 rounded shadow text-center">
            <p class="text-gray-600">
                Aucune partie commencée pour le moment.
            </p>

            <Link
                :href="route('games.index')"
                class="mt-4 inline-block bg-black text-white px-4 py-2 rounded"
            >
                Choisir un parcours
            </Link>
        </div>

        <!-- LIST -->
        <div class="space-y-4">

            <div
                v-for="session in sessions"
                :key="session.id"
                class="bg-white p-4 rounded shadow flex justify-between items-center"
            >

                <!-- INFOS -->
                <div>

                    <h2 class="font-bold text-lg">
                        {{ session.game.title }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        Difficulté : {{ session.difficulty }} •
                        Transport : {{ session.transport_type }}
                    </p>

                    <p class="text-xs mt-1"
                       :class="session.status === 'active' ? 'text-green-600' : 'text-gray-500'"
                    >
                        {{ session.status }}
                    </p>

                </div>

                <!-- ACTION -->
                <div>

                    <Link
                        :href="route('gamesession.show', session.id)"
                        class="bg-black text-white px-4 py-2 rounded text-sm"
                    >
                        {{ session.status === 'active' ? 'Reprendre' : 'Voir' }}
                    </Link>

                </div>
                <button
                    @click="destroy(session.id)"
                    class="bg-red-600 text-white px-3 py-1 rounded text-sm"
                >
                    Supprimer
                </button>
            </div>

        </div>

    </div>

</template>