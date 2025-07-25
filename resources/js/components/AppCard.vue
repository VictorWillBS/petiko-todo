<script setup lang="ts">
interface Props {
    title: string;
}

withDefaults(defineProps<Props>(), {
    title: () => '',
});
</script>
<template>
    <div class="flex flex-1 justify-center gap-4 p-8">
        <div class="flex flex-1 flex-col rounded-2xl bg-gray-100 p-8">
            <div class="mb-2 flex justify-between">
                <h1 class="text-2xl font-bold ">
                    {{ title }}
                </h1>

                <slot name="headerAdOnRight" />
            </div>
            <div class="border-y border-gray-300">
                <slot />
            </div>
            <div class="">
                <slot name="footer" />
            </div>
        </div>
    </div>
</template>
