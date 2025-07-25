import Button from '@/components/Buttons/Button.vue';
import { mount } from '@vue/test-utils';
import { describe, expect, it, vi } from 'vitest';

vi.mock('@/components/Buttons/index.ts', () => ({
    variant: {
        success: 'bg-blue-500 text-white',
        secondary: 'bg-gray-200 text-black',
    },
}));

describe('Button.vue', () => {
    it('Button basic render successfuly ', () => {
        const wrapper = mount(Button, {
            props: { variant: 'success' },
            slots: { default: 'Click me' },
        });

        expect(wrapper.text()).toContain('Click me');
    });

    it('Apply class successfuly', () => {
        const wrapper = mount(Button, {
            props: { variant: 'success', class: 'bg-blue-500' },
        });

        expect(wrapper.classes()).toContain('bg-blue-500');
    });

    it('Disable button successfuly', () => {
        const wrapper = mount(Button, {
            props: { variant: 'success', disabled: true },
        });

        const button = wrapper.find('button');

        expect(button.attributes('disabled')).toBeDefined();
        expect(button.classes()).toContain('cursor-not-allowed');
    });

    it('Has variant classes', () => {
        const wrapper = mount(Button, {
            props: { variant: 'success', disabled: true },
        });

        expect(wrapper.classes()).toContain('bg-blue-500');
        expect(wrapper.classes()).toContain('text-white');
    });
});
