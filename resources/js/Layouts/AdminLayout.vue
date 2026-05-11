<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const user = usePage().props.auth.user
</script>

<template>

    <div class="min-h-screen flex bg-gray-100">

        <!-- Sidebar -->
        <aside class="w-64 bg-black text-white">

            <div class="p-6 text-2xl font-bold">
                Admin
            </div>

            <nav class="mt-6 flex flex-col gap-2 px-4">

                <Link :href="route('admin.games.index')" class="px-4 py-2 rounded hover:bg-gray-800">
                    Games
                </Link>

                <Link :href="route('admin.places.index')" class="px-4 py-2 rounded hover:bg-gray-800">
                    Places
                </Link>

                <Link :href="route('admin.riddles.index')" class="px-4 py-2 rounded hover:bg-gray-800">
                    Riddles
                </Link>

            </nav>

        </aside>

        <!-- Content -->
        <main class="flex-1">

            <header class="bg-white shadow px-6 py-4 flex justify-between">

                <h1 class="font-bold">
                    Admin Panel
                </h1>

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
            </header>

            <div class="p-6">
                <slot />
            </div>

        </main>

    </div>

</template>