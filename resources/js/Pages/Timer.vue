<script setup>
import { Head } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import moment from "moment-timezone";
import _ from "lodash";
import axios from "axios";
import BaseLayout from "../Layouts/BaseLayout.vue";
import LoadingOverlay from "@/Components/LoadingOverlay.vue";
import MessageBox from "@/Components/MessageBox.vue";

const second = ref(0);
const timerStatus = ref("notStarted");
const timeRecords = ref([]);
const newTimeRecord = ref({});
const isLoading = ref(false);
const message = ref({});
const messageRef = ref(null);

let intervalId;

function startTimer() {
    if (!intervalId) {
        intervalId = setInterval(function () {
            second.value++;
        }, 1000);
        timerStatus.value = "started";

        if (!newTimeRecord.value.startTime) {
            newTimeRecord.value.key = timeRecords.value.length;
            newTimeRecord.value.startTime = moment().tz("Asia/Taipei").format();
        }
    }
}

function stopTimer() {
    clearInterval(intervalId);
    intervalId = undefined;
    timerStatus.value = "stopped";
}

function convertDuration(duration) {
    const momentDuration = moment.duration(duration, "second");
    const days = momentDuration.days();
    const hours = formatTimeNumber(momentDuration.hours()) || "00";
    const minutes = formatTimeNumber(momentDuration.minutes()) || "00";
    const seconds = formatTimeNumber(momentDuration.seconds()) || "00";
    const time = `${hours}:${minutes}:${seconds}`;
    return days
        ? `${days} days ${hours}:${minutes}:${seconds}`
        : `${hours}:${minutes}:${seconds}`;
}

function convertToDate(time) {
    return moment(time).format("YYYY-MM-DD");
}

function convertToTime(time) {
    return moment(time).format("HH:mm");
}

function formatTimeNumber(number) {
    let n = String(number);
    if (n.length == 1) {
        n = "0" + n;
    }
    return n;
}

onMounted(() => {
    getRecords();
});

function getRecords() {
    isLoading.value = true;
    axios.get("/get_records").then(function (res) {
        if (res.status == 200) {
            timeRecords.value = res.data;
            isLoading.value = false;
        }
    });
}

function saveRecord() {
    if (timerStatus.value !== "notStarted") {
        isLoading.value = true;
        const recordData = {
            tag_name: "Timer Project",
            duration: second.value,
            description: "Timer Testing",
            start_time: newTimeRecord.value.startTime,
        };
        axios
            .post("/save_record", recordData)
            .then(function (res) {
                if (res.status == 200) {
                    getRecords();
                    message.value.status = "success";
                    message.value.message = res.data.message;
                    messageRef.value.show();

                    // Reset to initial state
                    second.value = 0;
                    newTimeRecord.value = {
                        key: timeRecords.value.length,
                        startTime: null,
                    };
                    timerStatus.value = "notStarted";
                } else {
                    message.value.status = "error";
                    message.value.message = res.data.message;
                    messageRef.value.show();
                    isLoading.value = false;
                }
            })
            .catch(function (error) {
                message.value.status = "error";
                message.value.message = error.response.data;
                messageRef.value.show();
                isLoading.value = false;
            });
    }
}
</script>

<template>
    <Head>
        <title>{{ second ? convertDuration(second) + " - " : "" }}Timer</title>
    </Head>
    <BaseLayout>
        <LoadingOverlay :is-loading="isLoading"></LoadingOverlay>
        <MessageBox v-bind="message" ref="messageRef"></MessageBox>
        <div class="relative top-1/4">
            <div class="text-center">
                <div class="text-lg">Tag: Timer project</div>
                <div class="text-3xl my-4">
                    <span>{{ convertDuration(second) }}</span>
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
                    <button
                        v-if="timerStatus === 'stopped'"
                        class="btn btn-yellow"
                        @click="saveRecord"
                    >
                        Save
                    </button>
                </section>
            </div>
            <table
                class="text-left mt-6 mx-auto text-xs sm:text-base timer-table"
                v-if="timeRecords.length || timerStatus !== 'notStarted'"
            >
                <thead class="border-b">
                    <tr>
                        <th>Key</th>
                        <th>Date</th>
                        <th>Start time</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(record, recordId) in timeRecords"
                        class="even:bg-slate-100"
                        :key="recordId"
                    >
                        <td>{{ recordId }}</td>
                        <td>{{ convertToDate(record.start_time) }}</td>
                        <td>{{ convertToTime(record.start_time) }}</td>
                        <td>{{ convertDuration(record.duration) }}</td>
                    </tr>
                    <tr
                        v-if="timerStatus !== 'notStarted'"
                        class="even:bg-slate-100"
                    >
                        <td>{{ newTimeRecord.key }}</td>
                        <td>{{ convertToDate(newTimeRecord.startTime) }}</td>
                        <td>{{ convertToTime(newTimeRecord.startTime) }}</td>
                        <td>{{ convertDuration(second) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<style scoped></style>
