<script setup>
import { Head } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import moment from "moment";

const second = ref(0);
const timerStatus = ref("notStarted"); // started, stopped
let intervalId;

function startTimer() {
    if (!intervalId) {
        intervalId = setInterval(function () {
            second.value++;
        }, 1000);
        timerStatus.value = "started";
    }
}

function stopTimer() {
    clearInterval(intervalId);
    intervalId = undefined;
    timerStatus.value = "stopped";
}

const days = computed(() => {
    const momentDuration = moment.duration(second.value, "second");
    return momentDuration.days();
});

const time = computed(() => {
    const momentDuration = moment.duration(second.value, "second");
    const hours = formatTimeNumber(momentDuration.hours()) || "00";
    const minutes = formatTimeNumber(momentDuration.minutes()) || "00";
    const seconds = formatTimeNumber(momentDuration.seconds()) || "00";
    return `${hours}:${minutes}:${seconds}`;
});

function formatTimeNumber(number) {
    let n = String(number);
    if (n.length == 1) {
        n = "0" + n;
    }
    return n;
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
            <span v-if="days">{{ days }} days </span>
            <span>{{ time }}</span>
            <section class="timer-btn-container">
                <button
                    v-if="timerStatus === 'notStarted'"
                    class="btn btn-blue"
                    @click="startTimer"
                >
                    Start
                </button>
                <button
                    v-else-if="timerStatus === 'started'"
                    class="btn btn-red"
                    @click="stopTimer"
                >
                    Stop
                </button>
                <button
                    v-else="timerStatus === 'stopped'"
                    class="btn btn-green"
                    @click="startTimer"
                >
                    Continue
                </button>
            </section>
        </div>
    </div>
</template>

<style scoped></style>
