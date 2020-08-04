<template>
    <div>
        <div class="d-flex justify-content-between align-items-center add-category">
            <div id="labelBullet" class="chip-wrapper"></div>
            <div class="label-icon pt-1 pb-2 dropdown calendar-dropdown">
                <i class="feather icon-tag dropdown-toggle" id="labelsBtn" data-toggle="dropdown"></i>
                <div id="categoriesContainer" class="dropdown-menu dropdown-menu-right pt-3"
                     aria-labelledby="cal-event-category">
                    <span class="dropdown-item bulletOpt" data-key="B" @click="event.category='B'">
                        <span class="bullet bullet-success bullet-sm mr-25"></span>
                        Eventos
                    </span>
                    <span class="dropdown-item bulletOpt" data-key="W" @click="event.category='W'">
                        <span class="bullet bullet-warning bullet-sm mr-25"></span>
                        Recordatorios
                    </span>
                    <span class="dropdown-item bulletOpt" data-key="P" @click="event.category='P'">
                        <span class="bullet bullet-danger bullet-sm mr-25"></span>
                        Tareas
                    </span>
                    <!--<span class="dropdown-item bulletOpt" data-key="L" @click="event.category='L'">
                        <span class="bullet bullet-info bullet-sm mr-25"></span>
                        Llamadas
                    </span>-->
                    <span class="dropdown-item bulletOpt" data-key="O" @click="event.category='O'">
                        <span class="bullet bullet-primary bullet-sm mr-25"></span>
                        Otros
                    </span>
                </div>
            </div>
        </div>
        <form id="calendarForm">
            <div class="chip-wrapper" v-if="event.category=='B'">
                <div class="chip chip-success">
                    <div class="chip-body">
                        <span class="chip-text">Eventos</span>
                    </div>
                </div>
            </div>
            <div class="chip-wrapper" v-if="event.category=='W'">
                <div class="chip chip-warning">
                    <div class="chip-body">
                        <span class="chip-text">Recordatorios</span>
                    </div>
                </div>
            </div>
            <div class="chip-wrapper" v-if="event.category=='P'">
                <div class="chip chip-danger">
                    <div class="chip-body">
                        <span class="chip-text">Tareas</span>
                    </div>
                </div>
            </div>
            <div class="chip-wrapper" v-if="event.category=='O'">
                <div class="chip chip-primary">
                    <div class="chip-body">
                        <span class="chip-text">Otros</span>
                    </div>
                </div>
            </div>
            <article class="help-block" v-if="eventCategoryError">
                <i class="text-danger">{{ eventCategoryError }}</i>
            </article>
            <!-- Title event -->
            <div class="form-group">
                <label for="">Evento</label>
                <input type="text" class="form-control" id="cal-event-title"
                       placeholder="Título del evento" v-model="event.title">
                <input type="hidden" v-model="event.category" readonly>
                <!-- Validation messages -->
                <article class="help-block" v-if="eventTitleError">
                    <i class="text-danger">{{ eventTitleError }}</i>
                </article>
            </div>

            <!-- Starts at date -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="">Fecha de Inicio</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="date" class="form-control pickadate"
                               id="cal-start-date" placeholder="dd-mm-yyyy" v-model="event.start_at">
                        <!-- Validation messages -->
                        <article class="help-block" v-if="eventStartAtError">
                            <i class="text-danger">{{ eventStartAtError }}</i>
                        </article>
                    </div>
                </div>
            </div>

            <!-- Starts at time -->
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="">Hora de Inicio</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control pickatime" id="cal-start-time"
                               placeholder="00:00" v-model="event.start_time">
                        <!-- Validation messages -->
                        <article class="help-block" v-if="eventStartTimeError">
                            <i class="text-danger">{{ eventStartTimeError }}</i>
                        </article>
                    </div>
                </div>
            </div>

            <!-- Ends at date -->
            <div class="form-group">
                <div class="row mt-1">
                    <div class="col-sm-4">
                        <label for="">Fecha Final</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="date" class="form-control pickadate" id="cal-end-date"
                               placeholder="dd-mm-yyyyy" v-model="event.end_at">
                        <!-- Validation messages -->
                        <article class="help-block" v-if="eventEndAtError">
                            <i class="text-danger">{{ eventEndAtError }}</i>
                        </article>
                    </div>
                </div>
            </div>

            <!-- Ends at time -->
            <div class="form-group">
                <div class="row mt-1">
                    <div class="col-sm-4">
                        <label for="">Hora Final</label>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control pickatime" id="cal-end-time"
                               placeholder="00:00" v-model="event.end_time">
                        <!-- Validation messages -->
                        <article class="help-block" v-if="eventEndTimeError">
                            <i class="text-danger">{{ eventEndTimeError }}</i>
                        </article>
                    </div>
                </div>
            </div>

            <!-- Note/Description -->
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea class="form-control" id="cal-description" rows="3"
                          placeholder="Descripción del evento" v-model="event.description"></textarea>
                <!-- Validation messages -->
                <article class="help-block" v-if="eventDescriptionError">
                    <i class="text-danger">{{ eventDescriptionError }}</i>
                </article>
            </div>

            <!-- Place -->
            <div class="form-group">
                <label for="">Lugar</label>
                <input type="text" class="form-control" id="cal-event-place"
                       placeholder="Lugar del evento" v-model="event.place">
                <!-- Validation messages -->
                <article class="help-block" v-if="eventPlaceError">
                    <i class="text-danger">{{ eventPlaceError }}</i>
                </article>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary" @click="setEvent">
                    Agregar evento
                </button>
            </div>
        </form>
        <div class="form-group">
            <hr>
            <div id="accordionEvent" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingAccordionEvent">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="panel-title text-left">
                                    <a data-toggle="collapse" data-parent="#accordionEvent" href="#collapseAccordionEvent" aria-expanded="true" aria-controls="collapseAccordionEvent">
                                        Vista detallada
                                    </a>
                                </h6>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="panel-title text-right">
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-cogs"></i> Más opciones
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div id="collapseAccordionEvent" role="tabpanel"
                         aria-labelledby="headingAccordionEmail"
                         class="panel-collapse collapse in float-none collapse show timeline-panel">
                        <!-- Event timeline -->
                        <ul class="activity-timeline timeline-left list-unstyled">
                            <li v-for="ev in events">
                                <div class="timeline-icon" :class="{'bg-success': (ev.category=='B'), 'bg-warning': (ev.category=='W'), 'bg-danger': (ev.category=='P'), 'bg-primary': (ev.category=='O')}">
                                    <i class="feather icon-check font-medium-2 align-middle"></i>
                                </div>
                                <div class="timeline-info">
                                    <p class="font-weight-bold mb-0">
                                        {{ ev.user.name }} {{ ev.user.last_name }} -
                                        {{ ev.title }}
                                    </p>
                                    <span class="font-small-3">
                                        {{ ev.notes }}
                                    </span>
                                </div>
                                <small class="text-muted">desde {{ ev.start_at }}</small>
                                <small class="text-muted">hasta {{ ev.end_at }}</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                event: {
                    category: '',
                    title: '',
                    start_at: '',
                    start_time: '',
                    end_at: '',
                    end_time: '',
                    description: '',
                    place: ''
                },
                eventCategoryError: '',
                eventTitleError: '',
                eventStartAtError: '',
                eventStartTimeError: '',
                eventEndAtError: '',
                eventEndTimeError: '',
                eventDescriptionError: '',
                eventPlaceError: '',
                events: [],
            }
        },
        props: {
            modelRelationId: {
                type: Number,
                required: true
            },
            modelRelationClass: {
                type: String,
                required: true
            },
            showButtonSave: {
                type: Boolean,
                required: false,
                default: true
            },
            showList: {
                type: Boolean,
                required: false,
                default: true
            }
        },
        methods: {
            /**
             * Realiza el proceso para registrar un evento
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            setEvent() {
                const vm = this;
                axios.post('/components/set-event', {
                    category: vm.event.category,
                    title: vm.event.title,
                    start_at: vm.event.start_at,
                    start_time: vm.event.start_time,
                    end_at: vm.event.end_at,
                    end_time: vm.event.end_time,
                    description: vm.event.description,
                    place: vm.event.place,
                    modelRelationId: vm.modelRelationId,
                    modelRelationClass: vm.modelRelationClass
                }).then(response => {
                    if (response.data.result) {
                        vm.event = {
                            category: '',
                            title: '',
                            start_at: '',
                            start_time: '',
                            end_at: '',
                            end_time: '',
                            description: '',
                            place: ''
                        };
                        vm.eventCategoryError = '';
                        vm.eventTitleError = '';
                        vm.eventStartAtError = '';
                        vm.eventStartTimeError = '';
                        vm.eventEndAtError = '';
                        vm.eventEndTimeError = '';
                        vm.eventDescriptionError = '';
                        vm.eventPlaceError = '';
                        vm.getEvents();
                    }
                    vm.success = response.data.result;
                }).catch(error => {
                    vm.success = false;
                    if (typeof(error.response) !="undefined") {
                        if (typeof(error.response.data.errors.title) !== "undefined") {
                            vm.eventTitleError = error.response.data.errors.title[0];
                        }
                        if (typeof(error.response.data.errors.start_at) !== "undefined") {
                            vm.eventStartAtError = error.response.data.errors.start_at[0];
                        }
                        if (typeof(error.response.data.errors.end_at) !== "undefined") {
                            vm.eventEndAtError = error.response.data.errors.end_at[0];
                        }
                        if (typeof(error.response.data.errors.start_time) !== "undefined") {
                            vm.eventStartTimeError = error.response.data.errors.start_time[0];
                        }
                        if (typeof(error.response.data.errors.end_time) !== "undefined") {
                            vm.eventEndTimeError = error.response.data.errors.end_time[0];
                        }
                        if (typeof(error.response.data.errors.description) !== "undefined") {
                            vm.eventDescriptionError = error.response.data.errors.description[0];
                        }
                        if (typeof(error.response.data.errors.place) !== "undefined") {
                            vm.eventPlaceError = error.response.data.errors.place[0];
                        }
                    }
                });
            },
            /**
             * Obtiene un listado de eventos
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getEvents() {
                const vm = this;
                axios.get(`/components/get-events/${vm.modelRelationClass}/${vm.modelRelationId}`).then(response => {
                    if (response.data.result) {
                        vm.events = response.data.events;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
        },
        mounted() {
            this.getEvents();
        }
    };
</script>

