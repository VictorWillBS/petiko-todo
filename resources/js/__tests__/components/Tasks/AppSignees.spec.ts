import AppSignees from '@/components/Tasks/AppSignees.vue';
import UserShort from '@/components/User/UserShort.vue';
import { User } from '@/types';
import { mount } from '@vue/test-utils';
import { describe, expect, it } from 'vitest';

describe('AppSignees.vue', () => {
    it('renders empty state when no signees are provided', () => {
        const wrapper = mount(AppSignees, {
            props: { signees: [] },
        });

        expect(wrapper.findAllComponents(UserShort)).toHaveLength(0);
    });

    it('renders a list of signees', () => {
        const signees: User[] = [
            { id: 1, name: 'John Doe', email: 'john@example.com' },
            { id: 2, name: 'Jane Doe', email: 'jane@example.com' },
        ];

        const wrapper = mount(AppSignees, {
            props: { signees },
        });

        const userShorts = wrapper.findAllComponents(UserShort);
        expect(userShorts).toHaveLength(2);
        expect(userShorts[0].props()).toMatchObject({ name: signees[0].name, email: signees[0].email });
        expect(userShorts[1].props()).toMatchObject({ name: signees[1].name, email: signees[1].email });
    });

    it('passes the dark prop to UserShort', () => {
        const signees: Partial<User>[] = [{ id: 1, name: 'John Doe', email: 'john@example.com' }];

        const wrapper = mount(AppSignees, {
            props: { signees },
        });

        const userShort = wrapper.findComponent(UserShort);
        expect(userShort.exists()).toBe(true);
        expect(userShort.props('dark')).toBe(true);
    });
});
