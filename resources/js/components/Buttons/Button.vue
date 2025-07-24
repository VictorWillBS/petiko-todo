<script setup lang="ts">
import { variant as variantClass, VariantType } from '.';

interface Props {
    variant: VariantType;
    disabled?: boolean;
}

defineProps<Props>();
</script>
<template>
    <button
        class="h-fit rounded-xl py-2 px-4"
        :class="[variantClass[variant], { 'cursor-not-allowed opacity-50': disabled }]"
        :disabled="disabled"
    >
        <slot />
    </button>
</template>
