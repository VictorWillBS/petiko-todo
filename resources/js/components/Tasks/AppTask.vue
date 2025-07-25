<script setup lang="ts">
import { useWorkspaceForm } from '@/composables/useWorkspaceForm';
import { formatDate } from '@/helpers/formater';
import { User } from '@/types';
import { Task } from '@/types/Tasks/index';
import ButtonIcon from '../Buttons/ButtonIcon.vue';
import AppForm from './AppForm.vue';

interface Props {
    task: Task;
}
type FormData = {
    status: string;
};

const props = defineProps<Props>();

const {
    form,
    patch,
    destroy: destroyData,
} = useWorkspaceForm<FormData>({
    status: props.task.status,
});

function destroy() {
    destroyData('tasks.destroy', [props.task.id], {
        preserveScroll: true,
    });
}

function updateStatus(newStatus: Pick<Task, 'status'>['status']) {
    form.status = newStatus;

    patch('tasks.updateStatus', [props.task.id], {
        preserveScroll: true,
    });
}

defineExpose({ destroy });
</script>
<template>
    <li class="border-b border-neutral-300 py-2">
        <div
            class="flex items-center justify-between"
            :class="{ 'opacity-50': task.status === 'completed' }"
        >
            <span class="text-lg capitalize">{{ task.title }}</span>
            <span class="text-sm text-gray-500">{{ formatDate(task.created_at) }}</span>
        </div>
        <div class="flex grow flex-wrap gap-8">
            <div
                class="flex-1 min-w-xs"
                :class="{ 'opacity-50': task.status === 'completed' }"
            >
                <p class="mt-1 text-gray-600 line-clamp-3">{{ task.description }}</p>
                <div class="mt-2 flex items-center gap-2">
                    <span class="text-sm text-gray-500">Due: {{ formatDate(task.due_date) }}</span>
                    <span class="text-sm text-gray-500">Status: {{ task.status }}</span>
                </div>
                <div class="mt-2 flex items-center gap-2">
                    <span class="text-sm text-gray-500 capitalize">
                        Signees: {{ task.signees?.map((signee: User) => signee.name).join(', ') }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-2 pe-4">
                <ButtonIcon
                    name="check"
                    variant="success"
                    @click="updateStatus('completed')"
                    v-if="task.status !== 'completed'"
                    data-test-id="mark-completed-btn"
                />
                <ButtonIcon
                    name="undo2"
                    variant="violet"
                    @click="updateStatus('pending')"
                    v-if="task.status === 'completed'"
                    data-test-id="mark-pending-btn"
                />
                <AppForm
                    :task="task"
                    type="edit"
                    v-if="task.status !== 'completed'"
                    data-test-id="edit-btn"
                />
                <ButtonIcon
                    name="trash"
                    variant="danger"
                    @click="destroy"
                    data-test-id="delete-btn"
                />
            </div>
        </div>
    </li>
</template>
