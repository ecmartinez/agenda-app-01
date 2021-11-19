<template>
    <app-layout>
        <template>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Calendar
            </h2>
            <div
                class="
                    bg-green-400
                    border-t-4 border-green-400
                    rounded-b
                    text-black
                    px-4
                    py-3
                    shadow-md
                    my-3
                "
                role="alert"
                v-if="showAlert"
            >
                <div class="flex">
                    <div>
                        <!-- <p class="text-sm">{{ $page.props.flash.message }}</p> -->
                        <p class="text-sm">{{ $page.props.flash.success }}</p>
                    </div>
                </div>
            </div>
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
    computed: {
        showAlert() {
            if (this.$page.props.flash.message !== null) {
                setTimeout(() => {
                    this.$page.props.flash.message = null;
                }, 3000);
                return true;
            }

            return false;
        },
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
        resetModal() {
            this.newEvent = {
                title: "",
                date_at: "",
                hour: "",
                user_id: "",
                session: 1800,
            };
        },
        saveAppt(param) {
            if (param.title == "") {
                alert("No puedes dejar el campo motivo vacio");
            }
            let dataAppt = this.setDurationSession(param);

            this.$inertia.post(route("appointment.store"), dataAppt, {
                onSuccess: (page) => {
                    if (Object.entries(page.props.errors).length === 0) {
                        this.closeModal();
                        emitter.emit("refreshCalendar");
                        this.resetModal();
                    }
                },
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
