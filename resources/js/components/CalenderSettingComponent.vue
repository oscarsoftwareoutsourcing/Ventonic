<template>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-1 text-right" v-if="hasCalendars" :class="{ 'offset-sm-10': !showCalendars }">
                <a href="/google-calendar/sync" title="Sincronizar calendario externo" style="display: none">
                    <i class="feather icon-refresh-cw"></i>
                </a>
            </div>
            <div class="col-sm-1 offset-sm-11 text-right">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalSetting" title="Configuración de calendario externo">
                    <i class="feather icon-settings"></i>
                </a>
            </div>
        </div>
        <div class="modal fade" id="modalSetting">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Vincular Calendario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <!-- Opción para seleccionar google calendar -->
                                <div class="custom-control custom-radio custom-control-inline" data-toggle="tooltip" title="Google Calendar">
                                    <input type="radio" id="googleCalendar" name="externalCalendar" class="custom-control-input" v-model="appCalendar" value="gCalendar" />
                                    <label class="custom-control-label" for="googleCalendar">
                                        <img src="/images/calendar/google-calendar.png" alt="Google Calendar" class="img-sel img-fluid" />
                                        <div class="row" v-if="configuredCalendars.gCalendar">
                                            <div class="col-12">
                                                <div class="alert alert-success" role="alert">
                                                    Configurado
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" data-toggle="tooltip" title="iCal (próximamente)" style="display: none">
                                    <input type="radio" name="externalCalendar" id="iCal" class="custom-control-input" v-model="appCalendar" value="iCal" disabled style="display: none" />
                                    <label class="custom-control-label" for="iCal" style="display: none">
                                        <img src="/images/calendar/ical.png" alt="iCal Calendar" class="img-sel img-fluid" />
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" data-toggle="tooltip" title="Outloock Calendar (próximamente)" style="display: none">
                                    <input type="radio" name="externalCalendar" id="outlookCalendar" class="custom-control-input" v-model="appCalendar" value="outlook" disabled style="display: none" />
                                    <label class="custom-control-label" for="outlookCalendar" style="display: none">
                                        <img src="/images/calendar/outlook-calendar.png" alt="Outlook Calendar" class="img-sel img-fluid" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-primary waves-effect waves-light text-white" @click="disconnectSetting" v-if="hasCalendars">
                            Desvincular Calendario
                        </button>
                        <button type="button" class="text-white btn bg-gradient-primary waves-effect waves-light" @click="setSetting" v-if="!configuredCalendars.gCalendar">
                            Vincular Calendario
                        </button>
                        <button type="button" class="btn bg-gradient-warning waves-effect waves-light text-white" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            appCalendar: "gCalendar",
            calendarId: "",
            apiKey: "",
            secretKey: "",
            token: "",
            hasCalendars: false,
            calendars: [],
            selectedCalendars: [],
            configuredCalendars: {
                gCalendar: false,
                iCal: false,
                outlook: false,
            },
        };
    },
    watch: {
        selectedCalendars: function() {
            this.filterEvents();
        },
    },
    methods: {
        setSetting() {
            const vm = this;
            if (vm.appCalendar === "gCalendar") {
                axios.get("/google-calendar").then((response) => {
                    if (response.data.result) {
                        location.reload();
                    } else {
                        location.href = response.data.redirect;
                    }
                });
            }
        },
        syncEvents() {
            const vm = this;
            if (vm.appCalendar === "gCalendar") {
                axios
                    .get("/google-calendar/sync")
                    .then((response) => {
                        if (response.data.result) {
                            //location.reload();
                        }
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
        disconnectSetting() {
            const vm = this;
            bootbox.confirm({
                title: "Eliminar calendario",
                message: `<p class='text-justify'>
                              Al desvincular su cuenta de Google se eliminarán de Ventonic todos los eventos
                              pertenecientes a sus calendarios de Google. Podrá seguir consultando esa información
                              desde su cuenta de Google. Si quiere volver a administrar todos sus calendarios desde
                              nuestra plataforma simplemente tendrá que volver a vincular su cuenta.
                          </p>
                          <p class='text-justify'>¿Está seguro que quiere desvincular su cuenta de Google Calendar?<p>`,
                swapButtonOrder: true,
                buttons: {
                    cancel: {
                        label: "Cancelar",
                        className: "btn-secondary",
                    },
                    confirm: {
                        label: "Desvincular",
                        className: "btn-warning",
                    },
                },
                callback: function(result) {
                    if (result) {
                        if (vm.appCalendar === "gCalendar") {
                            axios
                                .post("/google-calendar/disconnect")
                                .then((response) => {
                                    if (response.data.result) {
                                        location.reload();
                                    }
                                })
                                .catch((error) => {
                                    console.error(error);
                                });
                        }
                    }
                },
            });
        },
        getCalendars() {
            const vm = this;
            if (vm.appCalendar === "gCalendar") {
                axios
                    .get("/google-calendar/get-calendars")
                    .then((response) => {
                        if (response.data.result) {
                            vm.calendars = response.data.calendars;
                            vm.$root.$refs.calendarFilters.calendars = response.data.calendars;
                        } else {
                            location.href = response.data.redirect;
                        }
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
        showCalendars() {
            return this.configuredCalendars.gCalendar && this.calendars.length > 0;
        },
        filterEvents() {
            const vm = this;
            if (vm.appCalendar === "gCalendar") {
                axios
                    .post("/google-calendar/filter-events", {
                        selectedCalendars: vm.selectedCalendars,
                    })
                    .then((response) => {
                        if (response.data.result) {
                            //actualizar eventos del calendario
                            window.calendar.removeAllEvents();
                            window.calendar.addEventSource(response.data.events);
                        }
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            }
        },
        checkCalendar() {
            const vm = this;
            let calendars = [];
            $('.filter-calendar').each(function() {
                if ($(this).is(':checked')) {
                    calendars.push($(this).val());
                }
            });
            vm.selectedCalendars = calendars;
        }
    },
    created() {
        /*const vm = this;
        axios
            .get("/has-calendars")
            .then((response) => {
                if (response.data.result && response.data.gCalendar) {
                    vm.hasCalendars = response.data.hasCalendars;
                    vm.configuredCalendars.gCalendar = response.data.gCalendar;
                    vm.appCalendar = "gCalendar";
                    //vm.syncEvents();
                    vm.getCalendars();
                }
                vm.showCalendars();
            })
            .catch((error) => {
                console.error(error);
            });*/
    },
    mounted() {},
};

</script>
