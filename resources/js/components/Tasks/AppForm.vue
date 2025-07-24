<script setup lang="ts">
import { Dialog, DialogContent, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { useWorkspaceForm } from '@/composables/useWorkspaceForm';
import { Task } from '@/types/Tasks';
import { computed, inject, ref } from 'vue';
import ButtonIcon from '../Buttons/ButtonIcon.vue';
import InputError from '../InputError.vue';
import DialogDescription from '../ui/dialog/DialogDescription.vue';
import Input from '../ui/input/Input.vue';
import AppSignees from './AppSignees.vue';

interface Props {
    task?: Task;
    type: 'create' | 'edit';
}

const props = withDefaults(defineProps<Props>(), {
    task: () => ({
        title: '',
        description: '',
        due_date: '',
        status: 'pending',
        signees: [],
    }),
});

const auth = inject('auth');

const isOpen = ref(false);

const { form, post, patch } = useWorkspaceForm<Task>(props.task);

const due_date = computed({
    get: () => form.due_date?.replaceAll('/', '-'),
    set: (val: string) => {
        form.due_date = val;
    },
});

function trySave() {
    const options = {
        onSuccess: () => {
            closeModal();
        },
        onError: (errors) => {
            form.clearErrors();
            form.setError(errors);
            console.error('Error saving task:', errors);
        },
    };

    if (form.id) {
        return update(options);
    }

    return create(options);
}

function makeDefaultForm() {
    if (form.signees.length) return;

    form.signees = [auth.user];
}

function create(options: object) {
    return post('tasks.store', [], options);
}

function update(options: object) {
    return patch('tasks.update', [form.id], options);
}

function closeModal() {
    form.reset();
    isOpen.value = false;
}

function updateFormByModalStateChanges(open: boolean) {
    if (open) {
        makeDefaultForm();
        return;
    }

    form.reset();
}
</script>

<template>
    <Dialog
        v-model:open="isOpen"
        @update:open="updateFormByModalStateChanges"
    >
        <DialogTrigger as-child>
            <button
                class="rounded-lg bg-blue-500 px-4 py-2 font-bold text-white"
                v-if="type === 'create'"
            >
                New Task
            </button>
            <ButtonIcon
                variant="info"
                name="squarePen"
                v-else
            />
        </DialogTrigger>

        <DialogContent>
            <DialogHeader>
                <DialogTitle>
                    <h5 class="capitalize">{{ type }} Task {{ task.id && `#${task.id}` }}</h5>
                </DialogTitle>
            </DialogHeader>

            <DialogDescription> Fill in the details below to {{ type }} a new task. </DialogDescription>
            <form
                @submit.prevent="trySave"
                id="form"
            >
                <div class="mb-4">
                    <label
                        for="title"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Title
                    </label>
                    <Input
                        v-model="form.title"
                        type="text"
                        id="title"
                    />
                    <InputError :message="form.errors.title" />
                </div>
                <div class="mb-4">
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                        >Description</label
                    >
                    <textarea
                        id="description"
                        v-model="form.description"
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 px-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    ></textarea>
                    <InputError :message="form.errors.description" />
                </div>
                <div class="mb-4">
                    <label
                        for="due_date"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Due Date
                    </label>
                    <Input
                        id="due_date"
                        v-model="due_date"
                        type="date"
                        class="w-fit"
                    />
                    <InputError :message="form.errors.due_date" />
                </div>
                <div class="flex flex-col gap-2">
                    Signed By:
                    <AppSignees
                        :signees="form.signees ?? []"
                        class="grid-cols-none rounded-2xl border border-neutral-300 px-4 py-2"
                    />
                    <InputError :message="form.errors.signees" />
                </div>
            </form>
            <DialogFooter>
                <button
                    form="form"
                    type="submit"
                    class="rounded-lg bg-green-700 px-4 py-2 font-bold text-white"
                >
                    Save
                </button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>
