<script setup>
import { useForm } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineOptions({
    layout: AdminLayout
})

defineProps({
    games: Array,
})

const form = useForm({
    game_id: '',
    name: '',
    latitude: '',
    longitude: '',
    description: '',
    order: 0,
})

const submit = () => {
    form.post(route('admin.places.store'))
}
</script>

<template>
    <div class="p-6 max-w-3xl">

        <h1 class="text-2xl font-bold mb-6">
            Ajouter un lieu
        </h1>

        <form @submit.prevent="submit" class="space-y-4">

            <div>
                <label class="block mb-1">
                    Parcours
                </label>

                <select
                    v-model="form.game_id"
                    class="w-full border rounded p-2"
                >
                    <option value="">
                        Sélectionner
                    </option>

                    <option
                        v-for="game in games"
                        :key="game.id"
                        :value="game.id"
                    >
                        {{ game.title }}
                    </option>
                </select>
            </div>

            <div>
                <label class="block mb-1">
                    Nom du lieu
                </label>

                <input
                    v-model="form.name"
                    type="text"
                    class="w-full border rounded p-2"
                >
            </div>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <label class="block mb-1">
                        Latitude
                    </label>

                    <input
                        v-model="form.latitude"
                        type="number"
                        step="0.0000001"
                        class="w-full border rounded p-2"
                    >
                </div>

                <div>
                    <label class="block mb-1">
                        Longitude
                    </label>

                    <input
                        v-model="form.longitude"
                        type="number"
                        step="0.0000001"
                        class="w-full border rounded p-2"
                    >
                </div>

            </div>

            <div>
                <label class="block mb-1">
                    Description
                </label>

                <textarea
                    v-model="form.description"
                    rows="5"
                    class="w-full border rounded p-2"
                />
            </div>

            <div>
                <label class="block mb-1">
                    Ordre
                </label>

                <input
                    v-model="form.order"
                    type="number"
                    class="w-full border rounded p-2"
                >
            </div>

            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 rounded"
            >
                Enregistrer
            </button>

        </form>

    </div>
</template>