<template>
    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fiexed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all" role="dialog" aria-modal="true" aria-Labelledby="modal-headline">
                <form>
                    <div class="flex justify-between border-b border-gray-100 px-5 py-4">
                        <div>
                            <i class="fas fa-exclamation-circle text-blue-500"></i>
                            <span class="font-bold text-gray-700 text-lg">Reservas</span>
                        </div>
                        <div>
                            <button>
                                <i class="fa fa-times-circle text-red-500 hover:text-red-600 transition duration-150"></i>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div>
                            <div class="mb-4">
                                <label for="" class="block text-gray-700 text-sm font-bold mb-2">Buscar Usuario</label>

                                <div class="flex flex-col relative">
                                    <div class="w-full">
                                        <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                                            <div class="flex flex-auto flex-wrap"></div>
                                            <input type="text" placeholder="Buscar Usuario" class="p-1 px-2 appearance-none w-full text-gray-800">

                                            <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-1 flex items-center border-gray-200">
                                                <button type="button" class="cursor-pointer w-6 h-6 text-red-600 outline-none focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4">
                                                        <polyline points="18 15 12 9 6 15" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Options select -->
                                    <div class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto">

                                    </div>
                                    <!-- End Options -->
                                </div>
                            </div>
                            <!-- end Buscador -->

                            <!-- form inputs -->
                            <div class="mb-4">
                                <label for="motivo" class="block text-gray-700 text-sm font-bold mb-2">Motivo: </label>
                                <input v-model="form.title" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="motivo" placeholder="Ingresa el motivo de la consulta" autocomplete="off">

                                <div v-if="$page.errors.title" class="text-red-500">{{ $page.errors.title[0] }}</div>
                            </div>

                            <div class="mb-4">
                                <label for="fecha" class="block text-gray-700 text-sm font-bold mb-2">Fecha</label>
                                <input v-model="form.date_at" type="text" disabled="true" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="fecha">
                            </div>

                            <div class="mb-4">
                                <label for="hora" class="block text-gray-700 text-sm font-bold mb-2">Hora</label>
                                <input v-model="form.hour" type="time" disabled="true" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none" id="hora">
                            </div>
                            <!-- end form inputs -->

                            <!-- select -->
                            <div class="col-span-6 sm:col-span-3">
                                <label for="timeSesion" class="block text-sm font-medium leading-5 text-gray-700">Duracion</label>
                                <select v-model="form.session" name="timeSesion" id="timeSesion" class="mt-1 block form-select w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm">
                                    <option value="900">15 minutos</option>
                                    <option value="1800">30 minutos</option>
                                    <option value="3600">1 hora</option>
                                </select>
                            </div>
                            <!-- end select -->
                        </div>
                    </div>

                    <!-- buttons -->
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button @click.prevent="store(form)" type="button" class="inline-flex justify-center w-full border border-green-500 text-white bg-green-500 rounded-md px-4 py-2 m-2">Guardar</button>
                        <button type="button" class="inline-flex justify-center w-full border border-red-500 text-red-500 rounded-md px-4 py-2 m-2">Eliminar</button>
                        <button @click.prevent="closeModal" type="button" class="inline-flex justify-center w-full border border-gray-200 bg-gray-200 text-gray-700 rounded-md px-4 py-2 m-2">Atras</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",
    props: {
        form: {
            type: Object,
            default: () => {},
        }
    },
    components: {

    },
    methods: {
        closeModal() {
            this.$emit('closeModal');
        },
        store(form) {
            this.$emit('saveAppt', form);
        }
    }
}
</script>

<style>
.top-100 {
    top: 100%;
}

.bottom-100 {
    bottom: 100%;
}

.max-h-select {
    max-height: 300px;
}
</style>
