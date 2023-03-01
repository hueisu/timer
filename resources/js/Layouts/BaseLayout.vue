<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "@vue/reactivity";

const user = computed(() => usePage().props.auth.user);
</script>
<template>
    <div class="h-screen font-mono">
        <header>
            <nav class="bg-teal-600 text-white">
                <div class="text-center text-4xl py-4 font-black">Timer</div>
                <div
                    class="absolute right-2 top-4 hover:text-gray-300 border-2 px-2 py-1"
                >
                    <Link
                        v-if="user"
                        :href="route('logout')"
                        method="post"
                        as="button"
                        >Log out</Link
                    >
                    <Link v-else :href="route('login')" as="button"
                        >Log in</Link
                    >
                </div>
            </nav>
        </header>
        <main class="h-full">
            <slot></slot>
        </main>
        <footer>
            <slot name="footer"></slot>
        </footer>
    </div>
</template>
