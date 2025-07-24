<script setup lang="ts">
defineProps<{
    modelValue?: object;
    open: boolean;
    title?: string;
}>();

const emit = defineEmits<{
    (e: 'update:modelValue', value: boolean): void;
    (e: 'close'): void;
}>();
</script>
<template>
    <teleport to="body">
        <div
            v-if="open"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            @keydown.esc="emit('close')"
        >
            <div
                class="absolute inset-0"
                @click="emit('close')"
            ></div>

            <div
                class="relative z-10 w-full max-w-lg rounded-lg bg-white p-6 shadow-lg"
                role="dialog"
                aria-modal="true"
            >
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold">{{ title || 'Modal Title' }}</h2>

                    <!-- Botão fechar -->
                    <button
                        class="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
                        @click="emit('close')"
                        aria-label="Fechar modal"
                    >
                        &times;
                    </button>
                </div>

                <!-- Conteúdo do slot -->
                <slot />
            </div>
        </div>
    </teleport>
</template>
