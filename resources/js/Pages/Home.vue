<template>
  <div>
    <chat-layout></chat-layout>
  </div>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ChatLayout from '@/Layouts/ChatLayout.vue';

defineOptions({ layout: AuthenticatedLayout });
</script>

<style scoped></style>
