<template>
  <div class="flex justify-center items-center">
    <Link
      :href="
        conversation.is_user
          ? route('chat.user', conversation.id)
          : route('chat.group', conversation.id)
      "
      class="flex items-center w-full gap-2 p-2 hover:bg-slate-400/30 transition-all"
    >
      <!-- Avatar de profil pour les users simples -->
      <UserAvatar
        :avatar="conversation.avatar"
        :name="conversation.name"
        :isOnline="isOnline"
        v-if="conversation.is_user"
      />
      <!-- Avatar de profile pour les groupes -->
      <GroupAvatar v-if="conversation.is_group" />
      <div class="flex-1 max-w-full overflow-hidden text-xs">
        <div class="flex gap-1 justify-between items-center">
          <h3 class="font-semibold text-sm text-nowrap text-ellipsis truncate">
            {{ conversation.name }}
          </h3>
          <span
            v-if="conversation.last_message_date"
            class="text-nowrap italic text-[10px] text-ellipsis truncate"
          >
            {{ formatMessageDate(conversation.last_message_date) }}
          </span>
        </div>
        <p
          v-if="conversation.last_message"
          class="text-xs text-nowrap overflow-hidden text-ellipsis truncate"
        >
          {{ conversation.last_message }}
        </p>
      </div>
    </Link>
    <UserOptionsDropdown
      :conversation="conversation"
      class="inline-block cursor-pointer flex-1 -ml-1"
    />
  </div>
</template>

<script setup lang="ts">
import { Conversation } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import UserAvatar from './UserAvatar.vue';
import GroupAvatar from './GroupAvatar.vue';
import UserOptionsDropdown from './UserOptionsDropdown.vue';
import { formatMessageDate } from '@/utils';

const page = usePage();

const props = defineProps<{
  conversation: Conversation;
  isOnline: boolean;
}>();

const currentUser = page.props.auth.user;
</script>

<style scoped></style>
