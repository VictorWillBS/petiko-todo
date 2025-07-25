<script setup lang="ts">
import { variant as variantClass, VariantType } from '.';

interface Props {
    variant?: VariantType;
    disabled?: boolean;
}

withDefaults(defineProps<Props>(), {
    variant: 'custom',
});
</script>
<template>
    <button
        class="h-fit cursor-pointer rounded-xl px-4 py-2 transition"
        :class="{ 'cursor-not-allowed opacity-50': disabled, [variantClass[variant]]: variant }"
        :disabled="disabled"
    >
        <slot />
    </button>
</template>
