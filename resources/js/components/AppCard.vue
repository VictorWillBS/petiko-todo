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
            <div class="mb-2 flex justify-between flex-wrap gap-2 grow gap-y-4 sm:gap-y-0 sm:grow-0">
                <h1 class="flex text-2xl font-bold grow justify-center sm:justify-start ">
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
