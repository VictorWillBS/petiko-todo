import { mount } from '@vue/test-utils';
import { describe, expect, it, vi } from 'vitest';

import ButtonIcon from '@/components/Buttons/ButtonIcon.vue';
import Navbar from '@/components/Navbar.vue';

describe('Navbar.vue', () => {
    const authMock = { id: 1, name: 'John Doe', email: 'john@example.com' };

    function createWrapper() {
        return mount(Navbar, {
            global: {
                provide: {
                    auth: authMock,
                },
                mocks: {
                    route: vi.fn((name: string) => `/${name}`),
                },
            },
        });
    }

    it('renders title, input and button', () => {
        const wrapper = createWrapper();

        expect(wrapper.text()).toContain('To-do');

        const button = wrapper.findComponent(ButtonIcon);
        expect(button.exists()).toBe(true);
    });

    it('injects auth correctly', () => {
        const wrapper = createWrapper();

        expect(wrapper.vm.$.appContext.provides.auth).toEqual(authMock);
    });
});
