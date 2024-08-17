<template>
  <ChatLayout>

    <div
    v-if="!selectedConversation"
    class="flex flex-col gap-8 justify-center items-center h-full opacity-35">
      <p class="text-2xl md:text-4xl p-16 text-on-surface">
        Sélectionnez s'il vous plaît une conversation pour afficher les messages
      </p>
      <Icon icon="heroicons:chat-bubble-left-right-solid" class="w-32 h-32" />
    </div>

    <div class="" v-else>
      <!-- En-tête de conversation -->
      <ConversationHeader v-if="selectedConversation" 
      :selected-conversation="selectedConversation" />
      
      <div class="">
        <p class="p-3 chat-start max-w-[85%] sm:max-w-[75%] lg:max-w-[60%]" v-for="message in messages.data"
        :key="message.id">

          {{ message.message }}

        </p>
      </div>

      <!-- Pied de conversation -->
      <MessageInput />
    </div>

  </ChatLayout>
</template>

<script setup lang="ts">
import ConversationHeader from '@/Components/Chat/ConversationHeader.vue';
import MessageInput from '@/Components/Chat/MessageInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ChatLayout from '@/Layouts/ChatLayout.vue';
import { Icon } from '@iconify/vue';
import { usePage } from '@inertiajs/vue3';

defineOptions({ layout: AuthenticatedLayout });

const page = usePage();

const selectedConversation = page.props.selectedConversation;
const messages = page.props.messages;
</script>

<style scoped></style>
