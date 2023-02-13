<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const time = ref(0);
let intervalId;

function startTimer() {
    intervalId = setInterval(function () {
        time.value++;
    }, 1000);
}

function stopTimer() {
    clearInterval(intervalId);
}
</script>

<template>
    <Head>
        <title>Timer</title>
    </Head>
    <div class="font-mono container">
        <h1>Timer</h1>
        <div class="content">
            <div>Tag: Timer project</div>
            <div id="time">{{ time }}</div>
            <section class="timer-btn-container">
                <button class="btn btn-blue" @click="startTimer">Start</button>
                <button class="btn btn-red" @click="stopTimer">Stop</button>
            </section>
        </div>
    </div>
</template>

<style scoped></style>
