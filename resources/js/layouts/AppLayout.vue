<script setup lang="ts">
import Navbar from '@/components/Navbar.vue';
import Sidebar from '@/components/Sidebar.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

import { useToast } from 'vue-toastification';

interface Props {
    head?: string;
}
interface Flash {
    success?: string;
    error?: string;
}

defineProps<Props>();
const toast = useToast();
const page = usePage();
const sidebarOpen = ref(page.props.sidebarOpen);

watch(
    () => page.props.flash as Flash,
    (flash: Flash) => {
        if (flash.success) toast.success(flash.success);
        if (flash.error) toast.error(flash.error);
    },
    { deep: true, immediate: true },
);
</script>

<template>
    <div class="flex min-h-screen flex-col bg-neutral-900">
        <Head :title="head" />
        <Navbar
            :sidebarOpen="sidebarOpen"
            @update:sidebarOpen="sidebarOpen = $event"
        />
        <div class="relative flex flex-1 flex-col overflow-auto">
            <Sidebar v-if="sidebarOpen" />
            <div
                class="flex max-h-[calc(100vh-6rem)] flex-1 flex-col overflow-y-auto"
                :class="{ 'lg:ms-80': sidebarOpen }"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
