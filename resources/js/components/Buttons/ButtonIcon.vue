<script setup lang="ts">
import { variant as variantClass, VariantType } from '.';
import Icon from '../Icon.vue';

interface Props {
    name: string;
    variant: VariantType;
    disabled?: boolean;
}

defineProps<Props>();
</script>
<template>
    <button
        class="h-fit rounded-xl p-2 flex items-center gap-2 cursor-pointer"
        :class="[variantClass[variant], { 'cursor-not-allowed opacity-50': disabled }]"
        :disabled="disabled"
    >
        <Icon
            :name="name"
            class="h-5 w-5"
        ></Icon>
        <slot/>
    </button>
</template>
