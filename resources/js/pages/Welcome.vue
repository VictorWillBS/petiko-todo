<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome">
        <link
            rel="preconnect"
            href="https://rsms.me/"
        />
        <link
            rel="stylesheet"
            href="https://rsms.me/inter/inter.css"
        />
    </Head>
    <div
        class="flex min-h-screen flex-col items-center  p-6 text-[#1b1b18] lg:justify-center lg:p-8 bg-neutral-800"
    >
        <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('tasks.index', 1)"
                    class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-white hover:border-neutral-100 hover:bg-neutral-700"
                >
                    Tasks
                </Link>
                <template v-else>
                    <Link
                        :href="route('login')"
                        class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm leading-normal text-white hover:border-neutral-100 hover:bg-neutral-700"
                    >
                        Log in
                    </Link>
                    <Link
                        :href="route('register')"
                        class="inline-block rounded-sm border border-neutral-100 px-5 py-1.5 text-sm leading-normal text-white hover:border-neutral-100 hover:bg-neutral-700"
                    >
                        Register
                    </Link>
                </template>
            </nav>
        </header>
        <div
            class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0"
        >
            <main
                class="font-bold flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row"
            >
                <div
                    class="flex-1 flex flex-col justify-between rounded-br-lg rounded-bl-lg p-6 pb-12 text-[13px] leading-[20px] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] lg:rounded-tl-lg lg:rounded-br-none lg:p-20 bg-neutral-900 text-white dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]"
                >
                    <div>
                        <h1 class="mb-1 text-xl">Welcome to To-Do</h1>
                        <p class="mb-2 font-normal">
                            Your personal task manager. Here you can create, manage, and track your
                            tasks. Start by logging in or registering to get started.
                        </p>
                    </div>

                    <ul class="flex gap-3 text-sm leading-normal">
                        <li>
                            <a
                                :href="$page.props.auth.user ? route('tasks.index', 1) : route('login')"
                                class="inline-block rounded-sm border border-black bg-white px-5 py-1.5 text-sm leading-normal hover:border-black hover:bg-neutral-200 text-neutral-900 dark:hover:border-white dark:hover:bg-white"
                            >
                                Enjoy now
                            </a>
                        </li>
                    </ul>
                </div>
                <div
                    class="max-w-sm object-contain"
                >
                    <img src="/home-image.png" alt="" srcset="">
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
