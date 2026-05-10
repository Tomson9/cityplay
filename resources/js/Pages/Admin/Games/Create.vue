<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    title: '',
    description: '',
})

const submit = () => {
    form.post(route('admin.games.store'))
}
</script>

<template>
    <div class="p-6 max-w-2xl">

        <h1 class="text-2xl font-bold mb-6">
            Créer un parcours
        </h1>

        <form @submit.prevent="submit" class="space-y-4">

            <div>
                <label class="block mb-1">
                    Titre
                </label>

                <input
                    v-model="form.title"
                    type="text"
                    class="w-full border rounded p-2"
                >

                <div
                    v-if="form.errors.title"
                    class="text-red-500 text-sm mt-1"
                >
                    {{ form.errors.title }}
                </div>
            </div>

            <div>
                <label class="block mb-1">
                    Description
                </label>

                <textarea
                    v-model="form.description"
                    class="w-full border rounded p-2"
                    rows="5"
                />
            </div>

            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 rounded"
                :disabled="form.processing"
            >
                Enregistrer
            </button>

        </form>

    </div>
</template>