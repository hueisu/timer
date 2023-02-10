<script setup>
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head>
        <title>Timer</title>
    </Head>
    <div class="font-mono container">
        <h1>Timer</h1>
        <div class="content">
            <div>Tag: Timer project</div>
            <div id="time">00:00</div>
            <section class="timer-btn-container">
                <button class="btn btn-blue">Start</button>
                <button class="btn btn-red">Stop</button>
            </section>
        </div>
    </div>
</template>

<style scoped></style>
