<script setup lang="ts">
interface Props {
    name: string;
}

withDefaults(defineProps<Props>(), {
    name: () => 'delete_forever',
});
</script>
<template>
    <span class="material-symbols-outlined align-middle">{{ name }}</span>
</template>
