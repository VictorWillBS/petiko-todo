<script setup lang="ts">
import AppCard from '@/components/AppCard.vue';
import Button from '@/components/Buttons/Button.vue';
import Icon from '@/components/Icon.vue';
import Paginator from '@/components/Paginator/Paginator.vue';
import AppForm from '@/components/Tasks/AppForm.vue';
import AppTask from '@/components/Tasks/AppTask.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { PaginatedResponse } from '@/types';
import { Task } from '@/types/Tasks/index';
import { User } from '@/types/Users';
import { computed, provide, ref } from 'vue';

interface Props {
    tasks?: PaginatedResponse<Task>;
    colaborators?: Task[];
    wsId?: number;
    auth: User;
}

const props = defineProps<Props>();

const showAll = ref(true);
const pendingTasks = computed(() => props.tasks?.data.filter((task: Task) => task.status === 'pending'));
const taskFiltered = computed(() => (showAll.value ? props.tasks?.data : pendingTasks.value));

provide('colaborators', props.colaborators ?? []);
provide('wsId', props.wsId ?? []);
provide('auth', props.auth ?? {});
</script>
<template>
    <AppLayout head="Tasks">
        <AppCard :title="`Tasks (${tasks?.total_pending} ${tasks?.total_pending === 1 ? 'remaining' : 'remaings'})`">
            <template #headerAdOnRight>
                <div class="flex grow justify-center gap-2 sm:grow-0">
                    <Button
                        :variant="showAll ? 'success' : 'violet'"
                        class="font-bold"
                        @click="showAll = !showAll"
                    >
                        {{ showAll ? 'Hide' : 'Show' }} completed
                    </Button>
                    <AppForm type="create" />
                </div>
            </template>
            <div class="max-h-[35rem] overflow-y-auto border-y border-gray-300 pe-4">
                <ul v-if="taskFiltered?.length">
                    <AppTask
                        :task="task"
                        v-for="task in taskFiltered"
                        :key="task.id"
                    />
                </ul>
                <div
                    class="flex grow flex-col items-center justify-center gap-2 py-20"
                    v-else
                >
                    <div class="flex items-center gap-2 text-xl font-bold text-gray-500">
                        <Icon
                            name="heartCrack"
                            class="size-5"
                        />
                        <h3 class="">Nothing here yet...</h3>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-500">Try to create a new task!</h3>
                </div>
            </div>
            <template #footer>
                <Paginator :links="tasks?.links ?? []" />
            </template>
        </AppCard>
    </AppLayout>
</template>
