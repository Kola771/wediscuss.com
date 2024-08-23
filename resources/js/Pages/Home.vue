<template>
  <ChatLayout>
    <div v-if="!selectedConversation" class="flex flex-col gap-8 justify-center items-center h-full opacity-35">
      <p class="text-2xl md:text-4xl p-16 text-on-surface">
        Sélectionnez s'il vous plaît une conversation pour afficher les messages
      </p>
      <Icon icon="heroicons:chat-bubble-left-right-solid" class="w-32 h-32" />
    </div>
    <div class="flex flex-col overflow-y-auto scrollbar-thin h-full" v-else>
      <!-- En-tête de conversation -->
      <ConversationHeader v-if="selectedConversation" :selected-conversation="selectedConversation" />

      <div class="flex-1 flex-col p-5">
        <div class="flex justify-center h-full">
          <!-- Au cas où on n'a pas encore de messages -->
          <p class="text-lg" v-if="!messages.length">Pas de messages trouvés !</p>

          <!-- Au cas où on a des messages -->
          <div class="flex-1 flex flex-col" v-else>
            <!-- MessageItem -->
            <MessageItem 
            v-for="message in messages" 
            :key="message.id" 
            :message="message" 
            :selected-conversation="selectedConversation" 
            />
          </div>
        </div>
      </div>
      <!-- Pied de conversation -->
      <MessageInput />
    </div>
  </ChatLayout>
</template>

<script setup lang="ts">
import ConversationHeader from '@/Components/Chat/ConversationHeader.vue';
import MessageInput from '@/Components/Chat/MessageInput.vue';
import MessageItem from '@/Components/Chat/MessageItem.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ChatLayout from '@/Layouts/ChatLayout.vue';
import { Icon } from '@iconify/vue';
import { usePage } from '@inertiajs/vue3';

defineOptions({ layout: AuthenticatedLayout });

const page = usePage();

const selectedConversation = page.props.selectedConversation;
const messagesData = page.props.messages;
const messages = messagesData?.data;
</script>

<style scoped></style>
