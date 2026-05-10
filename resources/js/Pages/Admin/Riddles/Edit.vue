<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    riddle: Object,
    places: Array,
})

const form = useForm({
    place_id: props.riddle.place_id,
    difficulty: props.riddle.difficulty,
    question: props.riddle.question,
    image: null,
})

const submit = () => {
    form.post(
        route('admin.riddles.update', props.riddle.id),
        {
            forceFormData: true,
            _method: 'put',
        }
    )
}
</script>

<template>
    <div class="p-6 max-w-3xl">

        <h1 class="text-2xl font-bold mb-6">
            Modifier une énigme
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

            <div v-if="riddle.image">

                <label class="block mb-2">
                    Image actuelle
                </label>

                <img
                    :src="`/storage/${riddle.image}`"
                    class="w-40 rounded"
                >

            </div>

            <div>
                <label class="block mb-1">
                    Nouvelle image
                </label>

                <input
                    type="file"
                    @input="form.image = $event.target.files[0]"
                    class="w-full"
                >
            </div>

            <button
                type="submit"
                class="px-4 py-2 bg-orange-500 text-white rounded"
            >
                Modifier
            </button>

        </form>

    </div>
</template>