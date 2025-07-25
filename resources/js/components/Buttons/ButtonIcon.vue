<script setup lang="ts">
import type { Component } from 'vue';
import { variant as variantClass, VariantType } from '.';
import Icon from '../Icon.vue';

interface Props {
    name: string;
    variant?: VariantType;
    disabled?: boolean;
    as?: string | Component;
}

withDefaults(defineProps<Props>(), {
    as: 'button',
    variant: 'custom',
});
</script>
<template>
    <component
        :is="as"
        class="flex h-fit cursor-pointer items-center gap-2 rounded-xl p-2"
        :class="[variantClass[variant], { 'cursor-not-allowed opacity-50': disabled }]"
        :disabled="disabled"
    >
        <Icon
            :name="name"
            class="h-5 w-5"
        ></Icon>
        <slot />
    </component>
</template>
