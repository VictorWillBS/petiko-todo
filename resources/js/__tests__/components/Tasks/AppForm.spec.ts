import { describe, it, expect, vi, beforeEach } from 'vitest';
import { mount, flushPromises } from '@vue/test-utils';
import AppForm from '@/components/Tasks/AppForm.vue';
import { nextTick } from 'process';

const mockPost = vi.fn(() => Promise.resolve());
const mockPatch = vi.fn(() => Promise.resolve());

vi.mock('@/composables/useWorkspaceForm', () => ({
    useWorkspaceForm: (task: any) => ({
        form: {
            ...task,
            title: task.title ?? '',
            description: task.description ?? '',
            due_date: task.due_date ?? '',
            signees: task.signees ?? [],
            errors: {},
            id: task.id,
            clearErrors: vi.fn(),
            setError: vi.fn(),
            reset: vi.fn(),
        },
        post: mockPost,
        patch: mockPatch,
    }),
}));

// Mock do inject para auth.user
vi.mock('vue', async (importOriginal) => {
    const actual = (await importOriginal()) as any;
    return {
        ...actual,
        inject: () => ({ user: { id: 1, name: 'User Test' } }),
    };
});

describe('AppForm.vue', () => {
    beforeEach(() => {
        mockPost.mockClear();
        mockPatch.mockClear();
    });

    it('renders the trigger button for creation', () => {
        const wrapper = mount(AppForm, {
            props: { type: 'create' },
        });
        const btn = wrapper.find('[data-test-id="trigger-button"]');
        expect(btn.exists()).toBe(true);
        expect(btn.text()).toBe('New Task');
    });

    it('calls post on create when saving', async () => {
        const wrapper = mount(AppForm, {
            props: { type: 'create' },
        });

        await wrapper.vm.trySave();

        expect(mockPost).toHaveBeenCalled();
        expect(mockPatch).not.toHaveBeenCalled();
    });

    it('calls patch on edit when saving', async () => {
        const wrapper = mount(AppForm, {
            props: { type: 'edit', task: { id: 123 } },
        });

        await wrapper.vm.trySave();

        expect(mockPatch).toHaveBeenCalled();
        expect(mockPost).not.toHaveBeenCalled();
    });

});
