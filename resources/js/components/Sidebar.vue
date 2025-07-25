<script setup lang="ts">
import type { User } from '@/types/Users';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ButtonIcon from './Buttons/ButtonIcon.vue';
import Icon from './Icon.vue';
import UserShort from './User/UserShort.vue';

const page = usePage();

const user = computed<User>(() => page.props.auth.user);
const form = useForm({ ...user.value });
const collaborators = computed(() => (page.props.collaborators ?? []) as User[]);

function changeRole() {
    form.is_admin = !user.value.is_admin;

    form.post(route('user.changeRole'));
}
</script>

<template>
    <div
        class="gradient absolute top-0 left-0 hidden h-full w-xs flex-col gap-8 divide-y rounded-br-4xl py-8 text-white lg:flex"
    >
        <div class="px-4 pb-4">
            <div></div>
            <div class="flex items-center gap-2">
                <Icon name="circleUser" />
                <h6 class="font-bold">My Account</h6>
            </div>
            <div class="flex flex-col gap-4 p-2">
                <div class="flex flex-col gap-1">
                    <div>
                        <div class="flex items-center gap-2">
                            <Icon name="user" />
                            <p>{{ user.name }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <Icon name="mail" />
                            <p>{{ user.email }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <Icon name="shield" />
                            <p>{{ user.is_admin ? 'Adminstrator' : 'User' }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    <ButtonIcon
                        class="justify-center"
                        variant="outlined"
                        name="RefreshCcw"
                        @click="changeRole"
                    >
                        Change Role ({{ !user.is_admin ? 'Admin' : 'User' }})
                    </ButtonIcon>
                </div>
            </div>
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
                <ButtonIcon
                    :as="Link"
                    name="logut"
                    variant="outlined"
                    class="flex h-fit w-full items-center justify-center"
                    method="post"
                    :href="route('logout')"
                >
                    <Icon name="logOut" />
                    Logout
                </ButtonIcon>
            </div>
        </div>
    </div>
</template>

<style scoped>
.gradient {
    background-image: linear-gradient(0, #162456 0%, #0a0a0a 31%, #0a0a0a 80%, #111b38 100%);
}
</style>
