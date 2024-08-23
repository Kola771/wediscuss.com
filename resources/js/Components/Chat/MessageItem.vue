<template>
    <div class="chat" :class="message.sender_id === currentUser.id ? 'chat-end'
    : 'chat-start'">
        <UserAvatar v-if="message.sender_id !== currentUser.id"
        :avatar="selectedConversation?.avatar"
        :name="selectedConversation?.name ?? ''"
        :isOnline="false"
        class="chat-image avatar" />

        <div class="chat-header">
            {{ message.sender_id !== currentUser.id ? message.sender.name : '' }}
            <time :datetime="formatMessageDate(message.created_at)">
                {{formatMessageDate(message.created_at)}}
            </time>
        </div>

        <div class="chat-bubble" 
        :class="{'chat-bubble-info': message.sender_id === currentUser.id}">
            <p>{{message.message}}</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Conversation, MessageData } from '@/types';
import { usePage } from '@inertiajs/vue3';
import UserAvatar from './UserAvatar.vue';
import { formatMessageDate } from '@/utils';

const page = usePage();

const currentUser = page.props.auth.user;
const props = defineProps<{
    message: MessageData;
    selectedConversation: Conversation | undefined
}>();
</script>

<style scoped></style>