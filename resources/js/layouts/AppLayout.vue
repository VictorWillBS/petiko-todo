<script setup lang="ts">
import Navbar from '@/components/Navbar.vue';
import Sidebar from '@/components/Sidebar.vue';
import type { BreadcrumbItemType } from '@/types';
import { Head } from '@inertiajs/vue3';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
    head?: string;
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <div class="flex min-h-screen flex-col bg-neutral-900">
        <Head :title="head" />
        <Navbar />

        <div class="relative flex flex-1 flex-col overflow-auto">
            <Sidebar />
            <div
                :breadcrumbs="breadcrumbs"
                class="flex max-h-[calc(100vh-6rem)] flex-1 flex-col overflow-y-auto lg:ms-80"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
