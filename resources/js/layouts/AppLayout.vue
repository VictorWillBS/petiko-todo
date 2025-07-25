<script setup lang="ts">
import Navbar from '@/components/Navbar.vue';
import Sidebar from '@/components/Sidebar.vue';
import { Head } from '@inertiajs/vue3';

interface Props {
    head?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="flex min-h-screen flex-col bg-neutral-900">
        <Head :title="head" />
        <Navbar />
        <div class="relative flex flex-1 flex-col overflow-auto">
            <Sidebar />
            <div
                class="flex max-h-[calc(100vh-6rem)] flex-1 flex-col overflow-y-auto lg:ms-80"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
