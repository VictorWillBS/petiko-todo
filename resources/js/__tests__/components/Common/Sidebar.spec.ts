import Sidebar from '@/components/Sidebar.vue';
import { Link } from '@inertiajs/vue3';
import { mount } from '@vue/test-utils';
import { beforeEach, describe, expect, it, vi } from 'vitest';
import { defineComponent, reactive } from 'vue';

const mockRoute = vi.fn().mockReturnValue('/logout');
const mockPage = reactive({
    props: {
        collaborators: [
            { id: 1, name: 'Alice', email: 'alice@test.dev' },
            { id: 2, name: 'Bob', email: 'bob@test.dev' },
        ],
        auth: {
            user: { id: 1, name: 'John Doe', email: 'john@example.com' },
        },
    },
});
vi.mock('@inertiajs/vue3', () => {
    const useForm = (data: any = {}) => ({
        ...data,
        data: () => data,
        post: vi.fn(),
        get: vi.fn(),
        patch: vi.fn(),
        delete: vi.fn(),
        reset: vi.fn(),
        clearErrors: vi.fn(),
        setError: vi.fn(),
        errors: {},
    });

    return {
        usePage: () => mockPage,
        useForm,
        Link: defineComponent({
            name: 'Link',
            props: { href: String, method: String, as: String },
            template: `<button data-test-id="link" :data-href="href" :data-method="method" :data-as="as"><slot/></button>`,
        }),
        router: { get: vi.fn(), post: vi.fn(), patch: vi.fn(), delete: vi.fn() },
    };
});

const UserShortStub = defineComponent({
    name: 'UserShort',
    props: ['id', 'name', 'email'],
    template: `<div data-test-id="user-short">{{ name }}</div>`,
});

describe('Sidebar.vue', () => {
    beforeEach(() => {
        mockRoute.mockClear();
    });

    it('renders project title and collaborators', () => {
        const wrapper = mount(Sidebar, {
            global: {
                stubs: {
                    UserShort: UserShortStub,
                },
                mocks: {
                    route: mockRoute,
                },
            },
        });

        expect(wrapper.text()).toContain('My Account');
        expect(wrapper.text()).toContain('Colaborators');

        const users = wrapper.findAll('[data-test-id="user-short"]');
        expect(users).toHaveLength(2);
        expect(users[0].text()).toBe('Alice');
        expect(users[1].text()).toBe('Bob');
    });

    it('renders logout link with correct props', () => {
        const wrapper = mount(Sidebar, {
            global: {
                stubs: {
                    UserShort: UserShortStub,
                },
                mocks: {
                    route: mockRoute,
                },
            },
        });

        expect(mockRoute).toHaveBeenCalledWith('logout');

        const link = wrapper.findComponent(Link);

        expect(link.exists()).toBe(true);
        expect(link.attributes('data-method')).toBe('post');
        expect(link.attributes('data-href')).toBe('/logout');
        expect(link.text()).toBe('Logout');
    });
});
