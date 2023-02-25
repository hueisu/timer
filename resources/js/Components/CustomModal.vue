<script setup>
const props = defineProps({
    showModal: Boolean,
    closable: Boolean,
});
</script>
<template>
    <Transition name="modal">
        <div v-if="showModal" id="modal">
            <div class="modal-wrapper">
                <div class="text-right">
                    <button
                        v-if="closable"
                        class="btn-close rounded px-4"
                        @click="$emit('closeModal')"
                    >
                        X
                    </button>
                </div>
                <div class="modal-content">
                    <slot></slot>
                </div>
            </div>
        </div>
    </Transition>
</template>
