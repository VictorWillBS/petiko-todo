import { describe, it, expect, vi } from 'vitest'
import { mount } from '@vue/test-utils'
import Button from '@/components/Buttons/Button.vue'
import Paginator from '@/components/Paginator/Paginator.vue'

const mockVisit = vi.fn()

describe('Paginator.vue', () => {
  it('renders all links as buttons', () => {
    const links = [
      { url: '/home', label: 'Home', active: true },
      { url: '/about', label: 'About', active: false },
    ]

    const wrapper = mount(Paginator, {
      props: { links },
      global: {
        mocks: {
          $inertia: { visit: mockVisit },
        },
      },
    })

    const buttons = wrapper.findAllComponents(Button)
    expect(buttons.length).toBe(2)
    expect(buttons[0].html()).toContain('Home')
    expect(buttons[1].html()).toContain('About')
  })

  it('applies the "violet" variant only to active links', () => {
    const links = [
      { url: '/home', label: 'Home', active: true },
      { url: '/about', label: 'About', active: false },
    ]

    const wrapper = mount(Paginator, {
      props: { links },
      global: {
        mocks: {
          $inertia: { visit: mockVisit },
        },
      },
    })

    const buttons = wrapper.findAllComponents({ name: 'Button' })
    expect(buttons[0].props('variant')).toBe('violet')
    expect(buttons[1].props('variant')).toBe('light')
  })

  it('calls $inertia.visit when clicking a button with a URL', async () => {
    const links = [{ url: '/home', label: 'Home', active: true }]

    const wrapper = mount(Paginator, {
      props: { links },
      global: {
        mocks: {
          $inertia: { visit: mockVisit },
        },
      },
    })

    await wrapper.findComponent({ name: 'Button' }).trigger('click')
    expect(mockVisit).toHaveBeenCalledWith('/home')
  })
})
