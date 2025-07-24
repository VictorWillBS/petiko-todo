<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <svg
        width="100"
        height="100"
        viewBox="0 0 100 100"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
    >
        <!-- Fundo do ícone com cantos arredondados, estilo Apple -->
        <rect
            x="5"
            y="5"
            width="90"
            height="90"
            rx="20"
            fill="#1A1A1A"
        />
        <!-- Cor de fundo mais escura para um toque tecnológico -->

        <!-- Elemento principal: um checkmark para a lista de tarefas -->
        <path
            d="M30 50 L45 65 L70 40"
            stroke="white"
            stroke-width="7"
            stroke-linecap="round"
            stroke-linejoin="round"
        />

        <!-- Elementos para multitarefas: checkmarks menores e sobrepostos ou linhas -->
        <!-- Checkmark secundário, ligeiramente deslocado e mais claro -->
        <path
            d="M25 40 L40 55 L65 30"
            stroke="#CCCCCC"
            stroke-width="4"
            stroke-linecap="round"
            stroke-linejoin="round"
            opacity="0.6"
        />

        <!-- Elementos de tecnologia: linhas abstratas ou grade sutil no fundo -->
        <line
            x1="15"
            y1="25"
            x2="85"
            y2="25"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="15"
            y1="35"
            x2="85"
            y2="35"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="15"
            y1="45"
            x2="85"
            y2="45"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="15"
            y1="55"
            x2="85"
            y2="55"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="15"
            y1="65"
            x2="85"
            y2="65"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="15"
            y1="75"
            x2="85"
            y2="75"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />

        <!-- Linhas verticais para criar uma grade mais sutil -->
        <line
            x1="25"
            y1="15"
            x2="25"
            y2="85"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="35"
            y1="15"
            x2="35"
            y2="85"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="45"
            y1="15"
            x2="45"
            y2="85"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="55"
            y1="15"
            x2="55"
            y2="85"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="65"
            y1="15"
            x2="65"
            y2="85"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
        <line
            x1="75"
            y1="15"
            x2="75"
            y2="85"
            stroke="#444444"
            stroke-width="1"
            opacity="0.4"
        />
    </svg>
</template>
