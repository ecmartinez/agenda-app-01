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
                initialView: "timeGridWeek",
                headerToolbar: {
                    left: "prev,next,today",
                    center: "title",
                    right: "dayGridMonth, timeGridWeek, timeGridDay",
                },
                height: "auto",
                allDaySlot: false,
                slotMinTime: "12:00:00",
                slotMaxTime: "20:00:00",
                dateClick: this.handleDateClick,
            },
        };
    },
    beforeMount() {
        this.$data.calendarOptions.events = {
            url: route('appointment.index'),
            method: 'GET',
            failure: error => {
                console.log('tenemos este error: ', error.message);
            }
        }
    },
    mounted() {
        emitter.on("refreshCalendar", function () {
            this.refreshCalendar();
        });
    },
    methods: {
        handleDateClick(clickInfo) {
            // console.warn(clickInfo);
            this.$emit("dateClick", clickInfo);
        },
        refreshCalendar() {
            
        },
    },
};
</script>

<style></style>
