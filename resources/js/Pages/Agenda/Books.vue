<template>
    <app-layout>
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Calendar
            </h2>
            <span>{{ $page.props.user }}</span>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto xm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl xm:rounded-lg">
                    <Calendar @dateClick="dateClick" />
                </div>
            </div>
        </div>

        <modal-calendar
            v-if="showModal"
            :form="newEvent"
            @closeModal="closeModal"
            @saveAppt="saveAppt"
        />
    </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import Calendar from "../../components/Calendar.vue";
import ModalCalendar from "../../components/Modals/CalendarModal.vue";
import formatTime from "../../Mixins/transformTime";
import Inertia from "@inertiajs/inertia-vue3";

export default {
    name: "Books",
    components: {
        Calendar,
        AppLayout,
        ModalCalendar,
    },
    data() {
        return {
            showModal: false,
            newEvent: {
                title: "",
                date_at: "",
                hour: "",
                user_id: "",
                session: 1800,
            },
        };
    },
    methods: {
        dateClick(args) {
            this.$data.showModal = true;
            this.setModalOpen(args);
            // console.log("recibiendo datos: ", args);
        },
        closeModal() {
            this.$data.showModal = false;
        },
        setModalOpen(obj) {
            let dateAndTime = obj.dateStr.split("T");

            this.newEvent.date_at = dateAndTime[0];
            this.newEvent.hour = dateAndTime[1].substr(0, 8);
            this.newEvent.user_id = this.$page.props.user.id;

            return;
        },
        saveAppt(param) {
            if (param.title == "") {
                alert("No puedes dejar el campo motivo vacio");
            }
            let dataAppt = this.setDurationSession(param);

            this.$inertia.post(route("appointment.store"), dataAppt, {
                onSuccess: (page) => {
                    if(Object.entries(page.props.errors).length === 0) {
                        this.closeModal();
                    }
                }
            });

            /*
            // capturar excepcion
            Inertia.on("error", (event) => {
                event.preventDefault();
                console.log("capturamos este error: ", error.message);
            });
            */
        },
        setDurationSession(form) {
            let dateApt = form.date_at + " " + form.hour;
            let initSession = new Date(dateApt);
            const getSecondsSession = initSession.getSeconds() + form.session;
            initSession.setSeconds(getSecondsSession);

            return {
                title: form.title,
                start: dateApt,
                end: formatTime(initSession),
                session: form.session,
                user_id: form.user_id,
            };
        },
    },
};
</script>

<style></style>
