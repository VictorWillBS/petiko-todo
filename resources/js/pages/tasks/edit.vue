<script setup lang="ts">
import AppCard from '@/components/AppCard.vue';
import AppForm from '@/components/Tasks/AppForm.vue';
import AppTask from '@/components/Tasks/AppTask.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Task } from '@/types/Tasks/index';
import { User } from '@/types/Users'
import { useForm } from '@inertiajs/vue3'
import { computed, provide } from 'vue';

interface Props {
    task: Task;
    colaborators?: Task[];
    wsId?: number;
    auth: User;
}

const props = defineProps<Props>();
const form = useForm({...props.task})

provide('colaborators', props.colaborators ?? []);
provide('wsId', props.wsId ?? []);
provide('auth', {});
</script>
<template>
    <AppLayout>
        <AppCard :title="`${task.title} #${task.id}`">
            <template #headerAdOnRight>
                <AppForm />
            </template>

            <template #footer>
                <div class="">Paginação</div>
                <div class="">{{ wsId }}</div>
            </template>
        </AppCard>
    </AppLayout>
</template>
