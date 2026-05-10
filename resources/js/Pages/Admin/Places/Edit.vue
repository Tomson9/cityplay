<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    place: Object,
    games: Array,
})

const form = useForm({
    game_id: props.place.game_id,
    name: props.place.name,
    latitude: props.place.latitude,
    longitude: props.place.longitude,
    description: props.place.description,
    order: props.place.order,
})

const submit = () => {
    form.put(route('admin.places.update', props.place.id))
}
</script>

<template>
    <div class="p-6 max-w-3xl">

        <h1 class="text-2xl font-bold mb-6">
            Modifier le lieu
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

                <input
                    v-model="form.latitude"
                    type="number"
                    step="0.0000001"
                    class="border rounded p-2"
                >

                <input
                    v-model="form.longitude"
                    type="number"
                    step="0.0000001"
                    class="border rounded p-2"
                >

            </div>

            <textarea
                v-model="form.description"
                rows="5"
                class="w-full border rounded p-2"
            />

            <input
                v-model="form.order"
                type="number"
                class="w-full border rounded p-2"
            >

            <button
                type="submit"
                class="px-4 py-2 bg-orange-500 rounded"
            >
                Modifier
            </button>

        </form>

    </div>
</template>