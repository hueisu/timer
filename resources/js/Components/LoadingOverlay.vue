<script setup>
const props = defineProps({
    isLoading: Boolean,
});
</script>
<template>
    <Transition name="loading">
        <div v-show="props.isLoading" id="loading">
            <img src="/images/loading-icon.svg" alt="loading icon" />
        </div>
    </Transition>
</template>
