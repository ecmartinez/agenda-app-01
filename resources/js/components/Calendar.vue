<template>
    <div>
        <fullcalendar :options="calendarOptions" />
    </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue3";
import daygrid from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGrid from "@fullcalendar/timegrid";

export default {
    components: {
        Fullcalendar,
    },
    data() {
        return {
            calendarOptions: {
                plugins: [daygrid, interactionPlugin, timeGrid],
                initialView: "dayGridMonth",
                headerToolbar: {
                    left: "prev,next,today",
                    center: "title",
                    right: "dayGridMonth, timeGridWeek, timeGridDay",
                },
            },
        };
    },
};
</script>

<style></style>
