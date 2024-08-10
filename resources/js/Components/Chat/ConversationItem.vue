<template>
  <Link href="#" class="flex items-center gap-2 p-2 hover:bg-black/40 
  transition-all px-3 hover:rounded dark:hover:bg-white/30">
    <!-- Avatar de profil -->
    <UserAvatar 
    v-if="conversation.is_user" 
    :avatar="conversation.avatar" :name="conversation.name"
    :isOnline="isOnline" />

    <!-- Groupe Avatar -->
    <GroupAvatar 
    v-if="conversation.is_group" />
    
    <div class="flex-1 max-w-full overflow-hidden text-xs">
    <div class="flex items-center justify-between gap-1">
      <h3 class="font-semibold text-sm text-nowrap overflow-hidden text-ellipsis">{{ conversation.name }}</h3>
      <span v-if="conversation.last_message_date" class="text-nowrap italic text-[8px]">
        {{ conversation.last_message_date }}
      </span>
    </div>
    <p v-if="conversation.last_message" class="text-xs text-nowrap overflow-hidden text-ellipsis">
      {{ conversation.last_message }}
    </p>
  </div>
  </Link>
</template>

<script setup lang="ts">
import { Conversation } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import UserAvatar from './UserAvatar.vue';
import GroupAvatar from './GroupAvatar.vue';

const page = usePage();

const props = defineProps<{
  conversation: Conversation;
  isOnline: boolean;
}>();

const currentUser = page.props.auth.user;
</script>

<style scoped></style>
