<script setup>
import { router } from '@inertiajs/vue3'

defineProps({
    places: Array,
})

const destroyPlace = (id) => {
    if (confirm('Supprimer ce lieu ?')) {
        router.delete(route('admin.places.destroy', id))
    }
}
</script>

<template>
    <div class="p-6">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">
                Lieux
            </h1>

            <a
                :href="route('admin.places.create')"
                class="px-4 py-2 bg-blue-200  rounded"
            >
                Ajouter un lieu
            </a>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">

            <table class="w-full">

                <thead>
                    <tr class="border-b">
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Parcours</th>
                        <th class="p-3 text-left">Latitude</th>
                        <th class="p-3 text-left">Longitude</th>
                        <th class="p-3 text-left">Ordre</th>
                        <th class="p-3"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="place in places"
                        :key="place.id"
                        class="border-b"
                    >
                        <td class="p-3">
                            {{ place.name }}
                        </td>

                        <td class="p-3">
                            {{ place.game.title }}
                        </td>

                        <td class="p-3">
                            {{ place.latitude }}
                        </td>

                        <td class="p-3">
                            {{ place.longitude }}
                        </td>

                        <td class="p-3">
                            {{ place.order }}
                        </td>

                        <td class="p-3">
                            <div class="flex gap-2">

                                <a
                                    :href="route('admin.places.edit', place.id)"
                                    class="px-3 py-1 bg-orange-500 rounded"
                                >
                                    Modifier
                                </a>

                                <button
                                    @click="destroyPlace(place.id)"
                                    class="px-3 py-1 bg-red-600 rounded"
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