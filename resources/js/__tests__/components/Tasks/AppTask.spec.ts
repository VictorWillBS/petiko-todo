import { mount } from '@vue/test-utils';
import { beforeEach, describe, expect, it, vi } from 'vitest';

import AppTask from '@/components/Tasks/AppTask.vue';

const mockDestroy = vi.fn();
const mockPatch = vi.fn();

vi.mock('@/composables/useWorkspaceForm', () => ({
    useWorkspaceForm: () => ({
        form: { status: '' },
        patch: mockPatch,
        destroy: mockDestroy,
    }),
}));

vi.mock('@/helpers/formater', () => ({
    formatDate: (date: string) => `formatted-${date}`,
}));

const taskPending = {
    id: 1,
    title: 'Test Task',
    description: 'Task description',
    status: 'pending',
    due_date: '2025-12-31',
    created_at: '2025-01-01',
    updated_at: '2025-01-01',
    signees: [{ id: 1, name: 'User One' }],
};

describe('AppTask.vue', () => {
    beforeEach(() => {
        mockDestroy.mockClear();
        mockPatch.mockClear();
    });

    it('calls destroy on trash button click', async () => {
        const wrapper = mount(AppTask, {
            props: { task: taskPending },
        });

        const trashBtn = wrapper.find('[data-test-id="delete-btn"]');
        expect(trashBtn.exists()).toBe(true);

        await trashBtn.trigger('click');

        expect(mockDestroy).toHaveBeenCalledWith('tasks.destroy', [taskPending.id], { preserveScroll: true });
    });
});
