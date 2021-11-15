<template>
    <app-layout>
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Calendar
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto xm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl xm:rounded-lg">
                    <Calendar />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import Calendar from "../../components/Calendar.vue";

export default {
    name: "Books",
    components: {
        Calendar,
        AppLayout,
    },
};
</script>

<style></style>
