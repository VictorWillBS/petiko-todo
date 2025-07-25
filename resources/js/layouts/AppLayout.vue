<script setup lang="ts">
import Navbar from '@/components/Navbar.vue';
import Sidebar from '@/components/Sidebar.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { watch } from 'vue';
import { useToast } from 'vue-toastification';

interface Props {
    head?: string;
}

defineProps<Props>();
const toast = useToast();
const page = usePage();

watch(
    () => page.props.flash,
    (flash) => {
        if (flash.success) toast.success(flash.success);
        if (flash.error) toast.error(flash.error);
    },
    { deep: true, immediate: true },
);
</script>

<template>
    <div class="flex min-h-screen flex-col bg-neutral-900">
        <Head :title="head" />
        <Navbar />
        <div class="relative flex flex-1 flex-col overflow-auto">
            <Sidebar />
            <div class="flex max-h-[calc(100vh-6rem)] flex-1 flex-col overflow-y-auto lg:ms-80">
                <slot />
            </div>
        </div>
    </div>
</template>
