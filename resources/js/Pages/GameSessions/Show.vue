<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import PlayerLayout from '@/Layouts/PlayerLayout.vue'

defineOptions({
    layout: PlayerLayout
})

const props = defineProps({
    session: Object,
    nextPlace: Object,
    riddle: Object,
})

const user = computed(() => usePage().props.auth?.user)
</script>

<template>
    <div class="p-6 space-y-6">

        <!-- HEADER SESSION -->
        <div class="bg-gray-100 p-4 rounded">
            <h1 class="text-xl font-bold">
                Session #{{ session.id }}
            </h1>

            <p>Joueur: {{ user?.name }}</p>
            <p>Difficulté: {{ session.difficulty }}</p>
            <p>Transport: {{ session.transport_type }}</p>
            <p>Statut: {{ session.status }}</p>
        </div>

        <!-- NEXT PLACE -->
        <div v-if="nextPlace" class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-bold">Prochain lieu</h2>

            <p class="text-md">
                {{ nextPlace.name }}
            </p>

            <p class="text-sm text-gray-500">
                Ordre: {{ nextPlace.order }}
            </p>
        </div>

        <!-- RIDDLE -->
        <div v-if="riddle" class="bg-yellow-100 p-4 rounded shadow">
            <h2 class="text-lg font-bold">Énigme</h2>

            <p class="mt-2">
                {{ riddle.question }}
            </p>

            <p class="text-sm text-gray-600 mt-2">
                Difficulté: {{ riddle.difficulty }}
            </p>
        </div>

        <!-- SI RIEN -->
        <div v-if="!nextPlace" class="text-green-600 font-bold">
            🎉 Tous les lieux ont été validés !
        </div>

    </div>
</template>