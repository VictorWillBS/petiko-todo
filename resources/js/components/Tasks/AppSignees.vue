<script setup lang="ts">
import { User } from '@/types/Users';
import UserShort from '../User/UserShort.vue';

interface Props {
    modelValue?: number;
    signees: User[];
}

withDefaults(defineProps<Props>(), {
    signees: () => [],
});
</script>
<template>
    <div class="grid grid-cols-2 gap-2">
        <UserShort
            v-bind="colaborator"
            v-for="(colaborator, index) in signees"
            :key="index"
            dark
        />
    </div>
</template>
