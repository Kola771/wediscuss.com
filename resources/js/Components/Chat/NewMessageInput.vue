<template>
    <div>
        <textarea
        ref="messageInput"
        @keydown="onInputKeyDown"
        @input="onChangeEvent"
        rows="1"
        class="input input-bordered w-full text-gray-800 rounded-md resize-none
        overflow-y-auto max-h-40"
        placeholder="Tapez un message"
        
        v-model="model"
        >

        </textarea>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const model = defineModel<string>();

const messageInput = ref<HTMLTextAreaElement|null>(null);

function onInputKeyDown(ev: KeyboardEvent) {
    if(ev.key === "Enter" && !ev.shiftKey) {
       ev.preventDefault();
       sendMessage();
    }
}

function onChangeEvent() {
    setTimeout(() =>{
        ajustHeight()
    }, 10)
}

function ajustHeight() {
    setTimeout(() => {
    if(messageInput.value) {
        messageInput.value.classList.remove("rounded-full")
        messageInput.value.classList.add("rounded")
        messageInput.value.style.height = "auto";
        messageInput.value.style.height = (messageInput.value.scrollHeight + 1) + "px";
    }
    }, 100)
}

function sendMessage() {

}
</script>

<style scoped></style>