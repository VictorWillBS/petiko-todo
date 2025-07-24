<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import UserShort from './User/UserShort.vue';

const page = usePage();
</script>
<template>
    <div
        class="gradient absolute top-0 left-0 hidden h-full w-xs flex-col gap-8 divide-y rounded-br-4xl py-8 text-white lg:flex"
    >
        <div class="pb-4">
            <h6 class="px-4 font-bold">My Project</h6>
        </div>
        <div class="flex flex-col gap-6 pb-4">
            <h6 class="px-4 font-bold">Colaborators</h6>
            <div class="flex flex-col gap-4">
                <UserShort
                    v-bind="colaborator"
                    v-for="(colaborator, index) in page.props.colaborators"
                    :key="index"
                />
            </div>
            <Link class="block w-full" method="post" :href="route('logout')" as="button">
            <LogOut class="mr-2 h-4 w-4" />
            Log out
        </Link>
        </div>
    </div>
</template>
<style>
.gradient {
    background-image: linear-gradient(0, #162456 0%, #0a0a0a 31%, #0a0a0a 80%, #111b38 100%);
}
</style>
