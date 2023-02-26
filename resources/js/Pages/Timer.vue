<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import moment from "moment-timezone";
import _ from "lodash";
import axios from "axios";
import BaseLayout from "../Layouts/BaseLayout.vue";
import LoadingOverlay from "@/Components/LoadingOverlay.vue";
import MessageBox from "@/Components/MessageBox.vue";
import CustomModal from "@/Components/CustomModal.vue";

const second = ref(0);
const timerStatus = ref("notStarted");
const timeRecords = ref([]);
const newTimeRecord = ref({});
const isLoading = ref(false);
const message = ref({});
const messageRef = ref(null);
const tags = ref({});
const selectedTagId = ref(null);

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

function getRecords(tagId = null) {
    isLoading.value = true;
    axios
        .get("/get_records/" + (tagId ?? ""))
        .then(function (res) {
            if (res.status == 200) {
                timeRecords.value = res.data.records;
                tags.value = res.data.tags;

                if (res.data.message) {
                    message.value.status = "error";
                    message.value.message = res.data.message;
                    messageRef.value.show();
                }
                isLoading.value = false;
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

function saveRecord() {
    if (timerStatus.value !== "notStarted") {
        isLoading.value = true;
        const recordData = {
            tag_id: selectedTagId.value,
            duration: second.value,
            description: "Timer Testing",
            start_time: newTimeRecord.value.startTime,
        };
        axios
            .post("/save_record", recordData)
            .then(function (res) {
                if (res.status == 200) {
                    getRecords(selectedTagId.value);
                    message.value.status = "success";
                    message.value.message = res.data.message;
                    messageRef.value.show(5000);

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

function selectTag(event) {
    const index = tags.value.findIndex(
        (tag) => tag.tag_name === event.target.value
    );

    if (index < 0) {
        message.value.status = "error";
        message.value.message = "Tag's name and index are mismatched.";
        messageRef.value.show();
    } else {
        selectedTagId.value = tags.value[index].id;
        getRecords(selectedTagId.value);
    }
}

const showModal = ref(false);
const newTagName = ref(null);

function createNewTag() {
    if (newTagName) {
        isLoading.value = true;
        axios
            .post("/create_new_tag", { newTagName: newTagName.value })
            .then(function (res) {
                isLoading.value = false;
                if (res.status == 200) {
                    getRecords();
                    message.value.status = "success";
                    message.value.message = res.data.message;
                    messageRef.value.show(5000);

                    newTagName.value = null;
                    showModal.value = false;
                } else {
                    message.value.status = "error";
                    message.value.message = res.data.message;
                    messageRef.value.show();
                }
            });
    } else {
        // TODO: show error msg when no input value.
    }
}

const user = computed(() => usePage().props.auth.user);
</script>

<template>
    <Head>
        <title>{{ second ? convertDuration(second) + " - " : "" }}Timer</title>
    </Head>
    <BaseLayout>
        <LoadingOverlay :is-loading="isLoading"></LoadingOverlay>
        <MessageBox v-bind="message" ref="messageRef"></MessageBox>
        <CustomModal
            :show-modal="showModal"
            :closable="true"
            @close-modal="() => (showModal = false)"
        >
            <div
                class="flex flex-wrap items-center justify-center gap-y-4 gap-x-2 my-4"
            >
                <input
                    v-model="newTagName"
                    class="shadow appearance-none border rounded px-3 py-2 text-gray-700 focus:shadow-outline"
                    placeholder="New tag name"
                />
                <button class="btn btn-yellow" @click="createNewTag">
                    Create
                </button>
            </div>
        </CustomModal>
        <div class="relative top-1/4">
            <div class="text-center">
                <div v-if="user">
                    <select class="rounded mb-4" @change="selectTag($event)">
                        <option selected disabled>
                            --Please select a tag--
                        </option>
                        <option v-for="tag in tags" :key="tag.id">
                            {{ tag.tag_name }}
                        </option>
                    </select>
                    <button
                        class="btn btn-yellow ml-2 my-4"
                        @click="() => (showModal = true)"
                    >
                        +
                    </button>
                </div>
                <div class="text-3xl my-4">
                    <span>{{ convertDuration(second) }}</span>
                </div>
                <section class="timer-btn-container">
                    <button
                        v-if="timerStatus === 'notStarted'"
                        class="btn btn-blue mx-2 my-4"
                        @click="startTimer"
                    >
                        Start
                    </button>
                    <button
                        v-else-if="timerStatus === 'started'"
                        class="btn btn-red mx-2 my-4"
                        @click="stopTimer"
                    >
                        Stop
                    </button>
                    <button
                        v-else="timerStatus === 'stopped'"
                        class="btn btn-green mx-2 my-4"
                        @click="startTimer"
                    >
                        Continue
                    </button>
                    <button
                        v-if="timerStatus === 'stopped' && user"
                        class="btn btn-yellow mx-2 my-4"
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
