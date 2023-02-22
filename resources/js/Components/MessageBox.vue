<script setup>
import { computed, ref } from "vue";

const showMessage = ref(false);

const props = defineProps({
    status: String,
    message: String,
    time: {
        type: Number,
        default: 5000,
    },
});

const classArray = computed(() => {
    switch (props.status) {
        case "warning":
            return ["bg-orange-500"];
        case "success":
            return ["bg-green-500"];
        case "error":
            return ["bg-red-500"];

        default:
            return ["bg-blue-500"];
    }
});

function show() {
    showMessage.value = true;
    setTimeout(() => hide(), props.time);
}

function hide() {
    showMessage.value = false;
}

defineExpose({
    show,
});
</script>

<template>
    <Transition name="message">
        <div
            v-show="showMessage"
            class="text-center text-white"
            :class="classArray"
        >
            {{ props.message }}
        </div>
    </Transition>
</template>
