<template>
  <div>
    <Menu as="div" class="relative inline-block text-left">
      <MenuButton class="inline-flex w-full justify-center rounded-md">
        <span class="sr-only">Ouvrir le menu contextuel</span>
        <Icon icon="heroicons:ellipsis-vertical-solid" class="w-6 h-6" />
      </MenuButton>

      <Transition
        enter="transition ease-out duration-100 transform"
        enter-from="opacity-0 scale-95"
        enter-to="opacity-100 scale-100"
        leave="transition ease-in duration-75 transform"
        leave-from="opacity-100 scale-100"
        leave-to="opacity-0 scale-95"
      >
        <MenuItems
          class="absolute right-0 w-56 mt-2 origin-top-right bg-surface text-on-surface rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
        >
          <div class="py-1">
            <MenuItem as="li" v-slot="{ active }" class="p-1">
              <button>
                <span
                  @click="blockUser"
                  v-if="!conversation.blocked_at"
                  class="flex p-2 text-sm items-center gap-2"
                >
                  <Icon icon="heroicons:lock-closed" />
                  Bloquer l'utilisateur
                </span>
                <span v-else @click="unblockUser" class="flex p-2 text-sm items-center gap-2">
                  <Icon icon="heroicons:lock-open" />
                  Débloquer l'utilisateur
                </span>
              </button>
            </MenuItem>

            <MenuItem v-if="currentUser.is_admin" as="li" v-slot="{ active }" class="p-1">
              <button>
                <span class="flex p-2 text-sm items-center gap-2" v-if="conversation.is_admin">
                  <Icon icon="heroicons:user" />
                  Retrograder en utilisateur
                </span>
                <span class="flex p-2 text-sm items-center gap-2" v-else>
                  <Icon icon="heroicons:shield-check" />
                  Promouvoir en admin
                </span>
              </button>
            </MenuItem>
          </div>
        </MenuItems>
      </Transition>
    </Menu>
  </div>
</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue';
import { usePage } from '@inertiajs/vue3';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue';
import { Conversation } from '@/types';
const page = usePage();

const currentUser = page.props.auth.user;

const props = defineProps<{
  conversation: Conversation;
}>();

async function blockUser() {
  // Si c'est un groupe, on ne fait rien
  if (props.conversation.is_group) return;

  const res = await window.axios.post(route('user.block', props.conversation.id));
  console.log(res);
}

async function unblockUser() {
  const res = await window.axios.post(route('user.unblock', props.conversation.id));
  console.log(res);
}

// const currentUser = page.props.auth.user;
</script>

<style scoped></style>
