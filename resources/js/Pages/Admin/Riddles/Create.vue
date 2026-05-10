<script setup>
import { useForm } from '@inertiajs/vue3'

defineProps({
    places: Array,
})

const form = useForm({
    place_id: '',
    difficulty: 1,
    question: '',
    image: null,
})

const submit = () => {
    form.post(route('admin.riddles.store'))
}
</script>

<template>
    <div class="p-6 max-w-3xl">

        <h1 class="text-2xl font-bold mb-6">
            Créer une énigme
        </h1>

        <form
            @submit.prevent="submit"
            class="space-y-4"
        >

            <div>
                <label class="block mb-1">
                    Lieu
                </label>

                <select
                    v-model="form.place_id"
                    class="w-full border rounded p-2"
                >
                    <option value="">
                        Sélectionner
                    </option>

                    <option
                        v-for="place in places"
                        :key="place.id"
                        :value="place.id"
                    >
                        {{ place.game.title }} - {{ place.name }}
                    </option>

                </select>
            </div>

            <div>
                <label class="block mb-1">
                    Difficulté
                </label>

                <input
                    v-model="form.difficulty"
                    type="number"
                    min="1"
                    max="5"
                    class="w-full border rounded p-2"
                >
            </div>

            <div>
                <label class="block mb-1">
                    Question
                </label>

                <textarea
                    v-model="form.question"
                    rows="5"
                    class="w-full border rounded p-2"
                />
            </div>

            <div>
                <label class="block mb-1">
                    Image
                </label>

                <input
                    type="file"
                    @input="form.image = $event.target.files[0]"
                    class="w-full"
                >
            </div>

            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded"
            >
                Enregistrer
            </button>

        </form>

    </div>
</template>