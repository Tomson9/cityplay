<script setup>
import { useForm } from '@inertiajs/vue3'
import PlayerLayout from '@/Layouts/PlayerLayout.vue'

defineOptions({
    layout: PlayerLayout
})

const props = defineProps({
    game: Object,
})

const form = useForm({
    difficulty: 1,
    transport_type: 'walking',
    team_size: 1,
    children_under_10: 0,
})

const submit = () => {
    form.post(route('games.storeSession', props.game.id))
}
</script>

<template>
    <div class="max-w-xl mx-auto">

        <h1 class="text-2xl font-bold mb-6">
            Démarrer : {{ game.title }}
        </h1>

        <form @submit.prevent="submit">

            <div class="mb-4">
                <label>Difficulté</label>

                <select v-model="form.difficulty">
                    <option :value="1">Facile</option>
                    <option :value="2">Moyen</option>
                    <option :value="3">Difficile</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Transport</label>

                <select v-model="form.transport_type">
                    <option value="walking">À pied</option>
                    <option value="bike">Vélo</option>
                    <option value="car">Voiture</option>
                </select>
            </div>

            <div class="mb-4">
                <label>Taille équipe</label>

                <input
                    type="number"
                    v-model="form.team_size"
                />
            </div>

            <button class="bg-black text-white px-4 py-2">
                Commencer
            </button>

        </form>
    </div>
</template>