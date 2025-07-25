import ButtonIcon from "@/components/Buttons/ButtonIcon.vue";
import Icon from "@/components/Icon.vue";
import { mount } from "@vue/test-utils";
import { describe, it, expect, vi } from "vitest";

describe('Button.vue', () => {
    vi.mock('@/components/Buttons/index.ts', () => ({
        variant: {
            success: 'bg-blue-500 text-white',
            secondary: 'bg-gray-200 text-black'
        }
    }));

    it('Button basic render successfuly', () => {
        const wrapper = mount(ButtonIcon, {
            props: { variant: 'success', name: 'check' }
        })

        expect(wrapper.findComponent(Icon).exists()).toBe(true);
    })

    it('Disable button successfuly', () => {
        const wrapper = mount(ButtonIcon, {
            props: { name: 'check', variant: 'success', disabled: true },
        });

        const button = wrapper.find('button');

        expect(button.attributes('disabled')).toBeDefined();
        expect(button.classes()).toContain('cursor-not-allowed');
    });

    it('Has variant classes', () => {
        const wrapper = mount(ButtonIcon, {
            props: { name: 'check', variant: 'success', disabled: true },
        });

        expect(wrapper.classes()).toContain('bg-blue-500');
        expect(wrapper.classes()).toContain('text-white');
    })
})
