<template>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4 offset-sm-6" v-if="showCalendars">
                <label for="">Calendarios</label>
                <select id="myCalendars" class="custom-select custom-select-sm" v-model="selectedCalendars" multiple>
                    <option :value="calendar.google_id" v-for="calendar in calendars">
                        <i class="fas fa-square"></i>{{ calendar.name }}
                    </option>
                </select>
            </div>
            <div class="col-sm-1 text-right" v-if="hasCalendars" :class="{'offset-sm-10': !showCalendars}">
                <a href="/google-calendar/sync" title="Sincronizar calendario externo">
                    <i class="feather icon-refresh-cw"></i>
                </a>
            </div>
            <div class="col-sm-1 text-right" :class="{'offset-sm-11': !hasCalendars}">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modalSetting"
                   title="Configuración de calendario externo">
                    <i class="feather icon-settings"></i>
                </a>
            </div>
        </div>
        <div class="modal fade" id="modalSetting">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Configuración</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <!-- Opción para seleccionar google calendar -->
                                <div class="custom-control custom-radio custom-control-inline" data-toggle="tooltip"
                                     title="Google Calendar">
                                    <input type="radio" id="googleCalendar" name="externalCalendar"
                                           class="custom-control-input" v-model="appCalendar" value="gCalendar">
                                    <label class="custom-control-label" for="googleCalendar">
                                        <img src="/images/calendar/google-calendar.png" alt="Google Calendar"
                                             class="img-sel img-fluid">
                                        <div class="row" v-if="configuredCalendars.gCalendar">
                                            <div class="col-12">
                                                <div class="alert alert-success" role="alert">
                                                    Configurado
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" data-toggle="tooltip"
                                     title="iCal (próximamente)">
                                    <input type="radio" name="externalCalendar" id="iCal" class="custom-control-input"
                                           v-model="appCalendar" value="iCal" disabled>
                                    <label class="custom-control-label" for="iCal">
                                        <img src="/images/calendar/ical.png" alt="iCal Calendar"
                                             class="img-sel img-fluid">
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline" data-toggle="tooltip"
                                     title="Outloock Calendar (próximamente)">
                                    <input type="radio" name="externalCalendar" id="outlookCalendar"
                                           class="custom-control-input" v-model="appCalendar" value="outlook" disabled>
                                    <label class="custom-control-label" for="outlookCalendar">
                                        <img src="/images/calendar/outlook-calendar.png" alt="Outlook Calendar"
                                             class="img-sel img-fluid">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-warning" @click="disconnectSetting"
                                v-if="hasCalendars">Eliminar</button>
                        <button type="button" class="btn btn-primary" @click="setSetting">Guardar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>

<script>
    export default {
        data() {
            return {
                appCalendar: 'gCalendar',
                calendarId: '',
                apiKey: '',
                secretKey: '',
                token: '',
                hasCalendars: false,
                calendars: [],
                selectedCalendars: [],
                configuredCalendars: {
                    gCalendar: false,
                    iCal: false,
                    outlook: false
                }
            }
        },
        watch: {
            selectedCalendars: function() {
                this.filterEvents();
            }
        },
        methods: {
            setSetting() {
                const vm = this;
                if (vm.appCalendar === 'gCalendar') {
                    axios.get('/google-calendar').then(response => {
                        if (response.data.result) {
                            location.reload();
                        }
                        else {
                            location.href = response.data.redirect;
                        }
                    });
                }
            },
            syncEvents() {
                const vm = this;
                if (vm.appCalendar === 'gCalendar') {
                    axios.get('/google-calendar/sync').then(response => {
                        if (response.data.result) {
                            //location.reload();
                        }
                    }).catch(error => {
                        console.error(error);
                    });
                }
            },
            disconnectSetting() {
                const vm = this;
                bootbox.confirm({
                    title: 'Eliminar calendario',
                    message: '¿Esta seguro de eliminar el calendario configurado?',
                    buttons: {
                        cancel: {
                            label: 'No',
                            className: 'btn-secondary'
                        },
                        confirm: {
                            label: 'Sí',
                            className: 'btn-warning'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            if (vm.appCalendar === 'gCalendar') {
                                axios.post('/google-calendar/disconnect').then(response => {
                                    if (response.data.result) {
                                        location.reload();
                                    }
                                }).catch(error => {
                                    console.error(error);
                                });
                            }
                        }
                    }
                });
            },
            getCalendars() {
                const vm = this;
                if (vm.appCalendar === 'gCalendar') {
                    axios.get('/google-calendar/get-calendars').then(response => {
                        if (response.data.result) {
                            vm.calendars = response.data.calendars;
                        }
                        else {
                            location.href = response.data.redirect;
                        }
                    }).catch(error => {
                        console.error(error);
                    });
                }
            },
            showCalendars() {
                return (this.configuredCalendars.gCalendar && this.calendars.length > 0);
            },
            filterEvents() {
                const vm = this;
                if (vm.appCalendar === 'gCalendar') {
                    axios.post('/google-calendar/filter-events', {
                        selectedCalendars: vm.selectedCalendars
                    }).then(response => {
                        if (response.data.result) {
                            //actualizar eventos del calendario
                            window.calendar.removeAllEvents();
                            window.calendar.addEventSource(response.data.events);
                        }
                    }).catch(error => {
                        console.error(error);
                    });
                }
            }
        },
        mounted() {
            const vm = this;
            axios.get('/has-calendars').then(response => {
                if (response.data.result) {
                    vm.hasCalendars = response.data.hasCalendars;
                    vm.configuredCalendars.gCalendar = response.data.gCalendar;
                    vm.appCalendar = 'gCalendar';
                    //vm.syncEvents();
                    vm.getCalendars();
                }
            }).catch(error => {
                console.error(error);
            });
        }
    };
</script>
