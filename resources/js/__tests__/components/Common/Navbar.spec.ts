import { mount } from '@vue/test-utils'
import Navbar from '@/components/Navbar.vue'
import { describe, it, expect, vi } from 'vitest'
import { Link } from '@inertiajs/vue3'

describe('Navbar.vue', () => {
    const authMock = { id: 1, name: 'John Doe', email: 'john@example.com' }

    function createWrapper() {
        return mount(Navbar, {
            global: {
                provide: {
                    auth: authMock, // injeção de auth
                },
                mocks: {
                    route: vi.fn((name: string) => `/${name}`),
                },
            },
        })
    }

    it('renders title, input and button', () => {
        const wrapper = createWrapper()

        expect(wrapper.text()).toContain('To-do')

        const input = wrapper.find('input[type="text"]')
        expect(input.exists()).toBe(true)
        expect(input.attributes('disabled')).toBeDefined()

        const button = wrapper.findComponent(Link)
        expect(button.exists()).toBe(true)
        expect(button.text()).toBe('Logout')
    })

    it('calls route("logout") on button click', async () => {
        const wrapper = createWrapper()

        const routeMock = wrapper.vm.route as unknown as ReturnType<typeof vi.fn>

        const button = wrapper.findComponent(Link)
        await button.trigger('click')

        expect(routeMock).toHaveBeenCalledWith('logout')
    })

    it('injects auth correctly', () => {
        const wrapper = createWrapper()

        // Verifica se auth foi injetado corretamente
        expect(wrapper.vm.$.appContext.provides.auth).toEqual(authMock)
    })
})
