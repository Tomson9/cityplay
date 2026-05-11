<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const user = usePage().props.auth.user
</script>

<template>

    <div class="min-h-screen bg-gray-100 flex flex-col">

        <!-- HEADER -->
        <header class="bg-black text-white shadow">

            <div class="max-w-5xl mx-auto px-4 py-4 flex justify-between">

                <Link
                    :href="route('games.index')"
                    class="text-xl font-bold"
                >
                    Urban Quest
                </Link>

                <div class="hidden sm:ms-6 sm:flex sm:items-center">
                    <!-- Settings Dropdown -->
                    <div class="relative ms-3">
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                        {{ $page.props.auth.user.name }}

                                        <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </div>

            </div>

        </header>

        <!-- PAGE -->
        <main class="flex-1 p-4 max-w-4xl mx-auto w-full">

            <slot />

        </main>

        <!-- MOBILE NAV -->
        <nav
            class="fixed bottom-0 left-0 right-0 bg-white border-t flex justify-around py-3 md:hidden"
        >

            <!-- Games -->
            <Link
                :href="route('games.index')"
                class="flex flex-col items-center text-sm"
            >
                🎮
                <span>Parcours</span>
            </Link>

            <!-- Sessions -->
            <Link
                :href="route('gamesession.index')"
                class="flex flex-col items-center text-sm"
            >
                🧩
                <span>Parties</span>
            </Link>

            <!-- Profile -->
            <Link
                :href="route('profile.edit')"
                class="flex flex-col items-center text-sm"
            >
                👤
                <span>Profil</span>
            </Link>

        </nav>

    </div>

</template>