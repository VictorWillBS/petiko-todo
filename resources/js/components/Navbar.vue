<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import Icon from './Icon.vue'
</script>
<template>
    <div
        class="flex h-24 items-center justify-between border-0 border-b border-white/20 bg-linear-30 from-blue-950 to-neutral-950 to-30% px-8"
    >
        <div class="text-white">
            <h1 class="text-4xl font-bold">To-do</h1>
        </div>
        <input
            type="text"
            placeholder="Search task (name, description, signee...)"
            disabled
            class="w-full max-w-lg cursor-not-allowed rounded bg-white px-4 py-2"
        />
        <div class="flex items-center gap-4">
            <div class="h-12 w-12 flex-none overflow-hidden rounded-full border border-neutral-200/20 bg-white">
                <img
                    src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairDreads02&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=Blue03&eyeType=Happy&eyebrowType=Default&mouthType=Smile&skinColor=Brown"
                    alt="Dark skin Man with Dreads Hair Smiling with Cumbia Graphic Hoodie"
                />
            </div>
            <Link
                name="logut"
                class="
                    text-white
                    flex
                    h-fit
                    w-full
                    items-center
                    justify-center
                    gap-2
                    rounded-xl
                    border
                    px-8
                    py-2
                    text-sm
                    font-bold
                    transition
                    border-white
                    hover:bg-white/10
                    lg:hidden
                "
                method="post"
                :href="route('logout')"
            >
                <Icon name="logOut" />
                Logout
            </Link>
        </div>
    </div>
</template>
