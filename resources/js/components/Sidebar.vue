<script setup lang="ts">
import type { User } from '@/types/Users';
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Icon from './Icon.vue';
import UserShort from './User/UserShort.vue';

const page = usePage();

const collaborators = computed(() => (page.props.collaborators ?? []) as User[]);
</script>

<template>
    <div
        class="gradient absolute top-0 left-0 hidden h-full w-xs flex-col gap-8 divide-y rounded-br-4xl py-8 text-white lg:flex"
    >
        <div class="pb-4">
            <h6 class="px-4 font-bold">My Project</h6>
        </div>

        <div class="flex grow flex-col gap-6 pb-4">
            <h6 class="px-4 font-bold">Colaborators</h6>

            <div class="flex flex-col gap-4">
                <UserShort
                    v-for="(colaborator, index) in collaborators"
                    :key="index"
                    v-bind="colaborator"
                    data-test-id="user-short"
                />
            </div>
            <div class="flex grow justify-center px-6">
                <Link
                    name="logut"
                    class="flex h-fit w-full rounded-xl items-center justify-center gap-2 border border-transparent px-8 py-2 text-sm font-bold transition hover:border-white"
                    method="post"
                    :href="route('logout')"
                    as="button"
                >
                    <Icon name="logOut" />
                    Logout
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.gradient {
    background-image: linear-gradient(0, #162456 0%, #0a0a0a 31%, #0a0a0a 80%, #111b38 100%);
}
</style>
