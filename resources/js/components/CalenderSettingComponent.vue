<template>
    <div class="col-sm-4 offset-sm-8">
        <a href="javascript:void(0)" class="float-right ml-1" data-toggle="modal" data-target="#modalSetting"
           title="Configuración de calendario externo">
            <i class="feather icon-settings"></i>
        </a>
        <a href="/google-calendar/sync" class="float-right ml-1 mr-1" title="Sincronizar calendario externo"
           v-if="hasCalendars">
            <i class="feather icon-refresh-cw"></i>
        </a>
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
                configuredCalendars: {
                    gCalendar: false,
                    iCal: false,
                    outlook: false
                }
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
                axios.post('/calendar/sync-events', {
                    appCalendar: vm.appCalendar
                }).then(response => {
                    if (response.data.result) {
                        location.reload();
                    }
                }).catch(error => {
                    console.error(error);
                });
            }
        },
        mounted() {
            const vm = this;
            axios.get('/has-calendars').then(response => {
                if (response.data.result) {
                    vm.hasCalendars = response.data.hasCalendars;
                    vm.configuredCalendars.gCalendar = response.data.gCalendar;
                }
            }).catch(error => {
                console.error(error);
            });
        }
    };
</script>
