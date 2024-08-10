<template>
    <div v-if="avatar">
        <div class="avatar w-10 h-10">
            <img :src="avatar" 
            class="rounded-full w-3 h-3" 
            :alt="`Photo de profil de ${name}`" />
        </div>
    </div>
    <div class="avatar placeholder" v-else>
        <div class="bg-neutral content w-10 text-white rounded-full">
            <span class="text-[10px]">
                {{ formatUserName(name) }}
            </span>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps<{
    avatar?: string
    name: string
}>();

function formatUserName(name: string): string {
    // utiliser une expression régulière pour trouver les premières lettres
    const initials = name.match(/\b\w/g) || [];
    return initials.join("").toUpperCase();
}
</script>

<style scoped></style>