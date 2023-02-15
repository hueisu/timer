<script setup>
import { Head } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import moment from "moment";
import BaseLayout from "../Layouts/BaseLayout.vue";

const second = ref(0);
const timerStatus = ref("notStarted");
const timeRecords = ref([
    {
        key: 0,
        date: "2022-01-01",
        startTime: "14:50:00",
        cumulatedTime: "00:50:24",
    },
    {
        key: 1,
        date: "2022-01-02",
        startTime: "20:50:00",
        cumulatedTime: "01:50:24",
    },
]);
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
        <title>{{ second ? time + " - " : "" }}Timer</title>
    </Head>
    <BaseLayout>
        <div class="relative top-1/4">
            <div class="text-center">
                <div class="text-lg">Tag: Timer project</div>
                <div class="text-3xl my-4">
                    <span v-if="days">{{ days }} days </span>
                    <span>{{ time }}</span>
                </div>
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
            <table
                class="text-left w-full mt-6 text-xs md:text-base timer-table"
                v-if="timeRecords.length"
            >
                <thead class="border-b">
                    <tr>
                        <th>Key</th>
                        <th>Date</th>
                        <th>Start time</th>
                        <th>Cumulated time</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="even:bg-slate-100"
                        v-for="record in timeRecords"
                        :key="record.key"
                    >
                        <td>{{ record.key }}</td>
                        <td>{{ record.date }}</td>
                        <td>{{ record.startTime }}</td>
                        <td>{{ record.cumulatedTime }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<style scoped></style>
