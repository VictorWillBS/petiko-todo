<script setup lang="ts">
import { variant as variantClass, VariantType } from '.';

interface Props {
    variant?: VariantType;
    disabled?: boolean;
}

defineProps<Props>();
</script>
<template>
    <button
        class="h-fit rounded-xl px-4 py-2 cursor-pointer"
        :class="{ 'cursor-not-allowed opacity-50': disabled, [variantClass[variant]]: variant }"
        :disabled="disabled"
    >
        <slot />
    </button>
</template>
