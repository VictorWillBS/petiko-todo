<script setup lang="ts">
import ButtonIcon from './Buttons/ButtonIcon.vue';

interface Props {
    sidebarOpen: boolean;
}

const emit = defineEmits(['update:sidebarOpen']);
defineProps<Props>();
</script>
<template>
    <div
        class="flex h-24 items-center justify-between gap-4 border-0 border-b border-white/20 bg-linear-30 from-blue-950 to-neutral-950 to-30% px-4 sm:gap-16 sm:px-8"
    >
        <ButtonIcon
            :name="sidebarOpen ? 'ChevronLeft' : 'menu'"
            variant="outlined"
            class="text-white"
            @click="emit('update:sidebarOpen', !sidebarOpen)"
        />
        <div class="text-white">
            <h1 class="text-xl font-bold sm:text-4xl">To-do</h1>
        </div>

        <div class="flex items-center gap-4">
            <div class="h-12 w-12 flex-none overflow-hidden rounded-full border border-neutral-200/20 bg-white">
                <img
                    src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairDreads02&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=Blue03&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Brown"
                    alt="Dark skin Man with Dreads Hair Smiling with Cumbia Graphic Hoodie"
                />
            </div>
        </div>
    </div>
</template>
