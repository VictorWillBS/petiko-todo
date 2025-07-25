<script setup lang="ts">
interface Props {
    name: string;
    email: string;
    dark?: boolean;
}

defineProps<Props>();
</script>
<template>
    <div class="flex items-center gap-2 px-4 text-sm">
        <div class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-gray-200">
            <img
                :src="`https://ui-avatars.com/api/?color=${dark ? 'ffffff' : ''}&background=${dark ? '162456' : 'ffffff'}&name=${name.replace(' ', '+')}`"
                alt="Avatar"
                class="h-full w-full rounded-full object-cover"
            />
        </div>
        <div class="line-clamp-2 truncate">
            <span class="font-bold break-all capitalize">{{ name.split(' ').slice(0, 2).join(' ') }}</span>
            <span class="over"> -{{ email }} </span>
        </div>
    </div>
</template>
