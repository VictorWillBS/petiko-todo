<script setup lang="ts">
import Button from '../Buttons/Button.vue';

interface Props {
    links: any[];
}

defineProps<Props>();
</script>
<template>
    <nav class="flex items-center justify-center gap-2 py-4">
        <Button
            :variant="link.active ? 'violet' : 'light'"
            class="h-fit rounded-xl px-4 py-2"
            v-for="link in links"
            :key="link.url"
            @click="link.url && $inertia.visit(link.url)"
            v-html="link.label"
        />
    </nav>
</template>
