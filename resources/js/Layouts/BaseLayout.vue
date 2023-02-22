<template>
    <div class="h-screen font-mono">
        <header>
            <nav class="bg-teal-600 text-white">
                <div class="text-center text-4xl py-4 font-black">Timer</div>
            </nav>
        </header>
        <main class="h-full">
            <slot></slot>
        </main>
        <footer>
            <slot name="footer"></slot>
        </footer>
    </div>
</template>
