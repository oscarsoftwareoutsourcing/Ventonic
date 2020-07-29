<template>
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <div class="card overflow-hidden">
                <!--<div class="header_ventonic-description">
                    <div class="card_vetonic-description">
                        <div class="text_vetonic-description">
                            Gestión de Negociación
                        </div>
                    </div>
                </div>-->
                <!-- Negotiation title with contact -->
                <div class="card-header">
                    <h2 class="card-title">{{ title }} con {{ contact }}</h2>
                </div>
                <div class="card-content">
                    <div class="card-body">

                        <!-- Responsable -->
                        <p><b>Responsable:</b> {{ owner }}</p>

                        <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab-justified" data-toggle="tab"
                                   href="#profile-just" role="tab" aria-controls="profile-just" aria-selected="false">
                                    Notas personales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="messages-tab-justified" data-toggle="tab" href="#messages-just"
                                   role="tab" aria-controls="messages-just" aria-selected="false">
                                    Eventos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="settings-tab-justified" data-toggle="tab" href="#settings-just"
                                   role="tab" aria-controls="settings-just" aria-selected="false">
                                    Documentos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab-justified" data-toggle="tab" href="#home-just"
                                   role="tab" aria-controls="home-just" aria-selected="true">
                                    Correos
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content pt-1">
                            <div class="tab-pane pb-3 active" id="profile-just" role="tabpanel"
                                 aria-labelledby="profile-tab-justified">
                                <div class="form-group">
                                    <label for="note">Nota</label>
                                    <textarea rows="4" class="form-control" id="note"
                                              placeholder="Agregar una nota" v-model="note"></textarea>
                                    <!-- Validation messages -->
                                    <article class="help-block" v-if="noteError">
                                        <i class="text-danger">{{ noteError }}</i>
                                    </article>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" @click="setNote">
                                        Enviar
                                    </button>
                                </div>
                                <div class="form-group">
                                    <hr>
                                    <div id="accordionNote" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingAccordionNote">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h6 class="panel-title text-left">
                                                            <a data-toggle="collapse" data-parent="#accordionNote" href="#collapseAccordionNote" aria-expanded="true" aria-controls="collapseAccordionNote">
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
                                            <div id="collapseAccordionNote" class="panel-collapse collapse in float-none"
                                                 role="tabpanel" aria-labelledby="headingAccordionNote">
                                                <div class="media-list media-bordered">
                                                    <div class="media" v-for="n in notes">
                                                        <a class="align-self-start media-left" href="#">
                                                            <img :src="(n.user.photo)?n.user.photo:'/images/anonymous-user.png'" alt="user avatar" width="64" height="64">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5 class="media-heading">
                                                                {{ n.user.name }} {{ n.user.last_name }} -
                                                                {{ n.created_at }}
                                                            </h5>
                                                            <p class="mb-0">
                                                                {{ n.description }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pb-3" id="messages-just" aria-labelledby="messages-tab-justified"
                                 role="tabpanel">
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
                                    <!--<div class="chip-wrapper" v-if="event.category=='L'">
                                        <div class="chip chip-info">
                                            <div class="chip-body">
                                                <span class="chip-text">Llamadas</span>
                                            </div>
                                        </div>
                                    </div>-->
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
                                                 class="panel-collapse collapse in float-none timeline-panel">
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
                            <div class="tab-pane pb-3" id="settings-just" aria-labelledby="settings-tab-justified"
                                 role="tabpanel">
                                <div class="form-group">
                                    <label for="documentNote">Nota</label>
                                    <textarea rows="4" class="form-control" id="documentNote"
                                              placeholder="Agregar una nota" v-model="documentNote"></textarea>
                                </div>
                                <div class="form-group">
                                    <form action="#" class="dropzone dropzone-area dz-clickable" id="documentsDz">
                                        <div class="dz-message">Drop Files Here To Upload</div>
                                    </form>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary">
                                        Enviar
                                    </button>
                                </div>
                                <div class="form-group">
                                    <hr>
                                    <div id="accordionDocument" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingAccordionDocument">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h6 class="panel-title text-left">
                                                            <a data-toggle="collapse" data-parent="#accordionDocument" href="#collapseAccordionDocument" aria-expanded="true" aria-controls="collapseAccordionDocument">
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
                                            <div id="collapseAccordionDocument" class="panel-collapse collapse in float-none" role="tabpanel" aria-labelledby="headingAccordionDocument">
                                                Listado detallado de documentos
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane pb-3" id="home-just" aria-labelledby="home-tab-justified"
                                 role="tabpanel">
                                <div class="form-group">
                                    <label for="searchEmail">Email contacto</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Correo electrónico"
                                               aria-describedby="searchEmail" v-model="email.email">
                                        <span class="input-group-addon" id="searchEmail">Buscar Email</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Asunto</label>
                                    <input type="text" class="form-control" placeholder="Asunto" v-model="email.subject">
                                </div>
                                <div class="form-group">
                                    <label for="message">Mensaje</label>
                                    <textarea id="message" class="form-control" rows="10" v-model="email.message"
                                              placeholder="Agregar un mensaje"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" @click="setEmail">
                                        Enviar
                                    </button>
                                </div>
                                <div class="form-group">
                                    <hr>
                                    <div id="accordionEmail" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingAccordionEmail">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h6 class="panel-title text-left">
                                                            <a data-toggle="collapse" data-parent="#accordionEmail" href="#collapseAccordionEmail" aria-expanded="true" aria-controls="collapseAccordionEmail">
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
                                            <div id="collapseAccordionEmail" class="panel-collapse collapse in float-none" role="tabpanel" aria-labelledby="headingAccordionEmail">
                                                <div class="media-list media-bordered">
                                                    <div class="media" v-for="e in emails">
                                                        <a class="align-self-start media-left" href="#">
                                                            <img :src="(e.to_user.photo)?e.to_user.photo:'/images/anonymous-user.png'" alt="user avatar" width="64" height="64">
                                                        </a>
                                                        <div class="media-body">
                                                            <h5 class="media-heading">
                                                                {{ e.to_user.name }} {{ e.to_user.last_name }} -
                                                                {{ e.created_at }}
                                                            </h5>
                                                            <h6 class="media-heading">Asunto: {{ e.subject }}</h6>
                                                            <p class="mb-0">Mensaje: {{ e.message }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information -->
        <div class="col-sm-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Acerca de la negociación</h4>
                    <!-- <i class="feather icon-more-horizontal cursor-pointer"></i> -->
                </div>
                <div class="card-body">
                    <!-- Description -->
                    <p>{{ description }}</p>

                    <!-- Status -->
                    <div class="mt-1">
                        <h6 class="mb-0">Estado:</h6>
                        <p v-if="status.id === 3" class="text-primary">
                            En Proceso <i title="En proceso" class="feather icon-loader ml-1"></i>
                        </p>
                        <p v-if="status.id === 1" class="text-success">
                            Ganada <i class="fa fa-trophy ml-1" title="Ganada"></i>
                        </p>
                        <p v-if="status.id === 2" class="text-danger">
                            Perdida <i class="fa fa-thumbs-o-down ml-1" title="Perdida"></i>
                        </p>
                    </div>

                    <!-- Shared with -->
                    <div class="mt-1" v-if="isShared">
                        <h6 class="mb-0">Compartida con:</h6>
                        <ul>
                            <li v-for="(group, index) in negGroups" :key="index">{{ group.name }}</li>
                        </ul>
                    </div>

                    <!-- Amount -->
                    <div class="mt-1">
                        <h6 class="mb-0">Importe:</h6>
                        <p>{{ amount }}</p>
                    </div>

                    <!-- Deadline -->
                    <div class="mt-1">
                        <h6 class="mb-0">Fecha de cierre:</h6>
                        <p>{{ deadline }}</p>
                    </div>

                    <!-- Created at -->
                    <div class="mt-1">
                        <h6 class="mb-0">Creada el:</h6>
                        <p>{{ createdAt }}</p>
                    </div>

                    <!-- Last update -->
                    <div class="mt-1">
                        <h6 class="mb-0">Actualizado el:</h6>
                        <p>{{ updatedAt }}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-primary btn btn-block waves-effect waves-light"
                            @click="returnList">
                        Volver
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapMutations } from 'vuex'
    export default {
        data() {
            return {
                negGroups: [],
                note: '',
                noteError: '',
                notes: [],
                documentNote: '',
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
                email: {
                    email: '',
                    subject: '',
                    message: ''
                },
                emails: []
            }
        },
        mounted() {
            if(this.getDetailedNeg.groups.length > 0) {
                this.getDetailedNeg.groups.forEach(g => {
                    this.getUserGroups.forEach(ug => {
                        if(g === ug.id) {
                            this.negGroups.push(ug);
                        }
                    });
                });
            }

            this.getNotes();
            this.getEvents();
            this.getEmails();
        },
        methods: {
            ...mapMutations({
                setNegotiationGroups: 'SET_NEGOTIATION_GROUPS',
                setDetailedNeg: 'SET_DETAILED_NEG',
                toggleLists: 'TOGGLE_LISTS',
                toggleDetails: 'TOGGLE_DETAILS',
            }),
            formatImp(i) {
                return new Intl.NumberFormat('de-ES', { style: 'currency', currency: 'EUR' }).format(i);
            },
            formatDate(d) {
                return d.getDate() + ' de ' + new Intl.DateTimeFormat('es-ES', { month: 'long'}).format(d) + ' del ' + d.getFullYear();
            },
            returnList() {
                this.setNegotiationGroups(null);
                this.setDetailedNeg(null);
                this.toggleLists();
                this.toggleDetails();
            },
            setNote() {
                const vm = this;
                console.log(vm.getDetailedNeg)
                axios.post('/negociaciones/set-note', {
                    description: vm.note,
                    negotiation_id: vm.getDetailedNeg.id
                }).then(response => {
                    if (response.data.result) {
                        vm.note = '';
                        vm.noteError = '';
                        vm.getNotes();
                    }
                }).catch(error => {
                    if (typeof(error.response) !="undefined") {
                        for (var index in error.response.data.errors) {
                            if (error.response.data.errors[index]) {
                                vm.noteError = error.response.data.errors[index][0];
                            }
                        }
                    }
                });
            },
            getNotes() {
                const vm = this;
                axios.get(`/negociaciones/get-notes/${vm.getDetailedNeg.id}`).then(response => {
                    if (response.data.result) {
                        vm.notes = response.data.notes;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            setEvent() {
                const vm = this;
                axios.post('/negociaciones/set-event', {
                    category: vm.event.category,
                    title: vm.event.title,
                    start_at: vm.event.start_at,
                    start_time: vm.event.start_time,
                    end_at: vm.event.end_at,
                    end_time: vm.event.end_time,
                    description: vm.event.description,
                    place: vm.event.place,
                    negotiation_id: vm.getDetailedNeg.id
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
                }).catch(error => {
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
            getEvents() {
                const vm = this;
                axios.get(`/negociaciones/get-events/${vm.getDetailedNeg.id}`).then(response => {
                    if (response.data.result) {
                        vm.events = response.data.events;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            setEmail() {
                const vm = this;
                console.log(vm.getDetailedNeg)
                axios.post('/negociaciones/set-email', {
                    email: vm.email.email,
                    subject: vm.email.subject,
                    message: vm.email.message,
                    negotiation_id: vm.getDetailedNeg.id
                }).then(response => {
                    if (response.data.result) {
                        vm.email = {
                            email: '',
                            subject: '',
                            message: ''
                        };
                        vm.getEmails();
                    }
                }).catch(error => {

                });
            },
            getEmails() {
                const vm = this;
                axios.get(`/negociaciones/get-emails/${vm.getDetailedNeg.id}`).then(response => {
                    if (response.data.result) {
                        vm.emails = response.data.emails;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
        },
        computed: {
            ...mapGetters(['getNegotiation', 'getNegotiations', 'getDetailedNeg', 'getUserGroups']),
            title() {
                return this.getDetailedNeg.title
            },
            contact() {
                if(this.getDetailedNeg.contact.last_name !== null) {
                    return this.getDetailedNeg.contact.name + ' ' + this.getDetailedNeg.contact.last_name;
                } else {
                    return this.getDetailedNeg.contact.name;
                }
            },
            owner() {
                if(this.getDetailedNeg.owner.last_name !== null) {
                    return this.getDetailedNeg.owner.name + ' ' + this.getDetailedNeg.owner.last_name;
                } else {
                    return this.getDetailedNeg.owner.name;
                }
            },
            status() {
                return this.getDetailedNeg.status;
            },
            description() {
                return this.getDetailedNeg.description;
            },
            isShared() {
                return (this.getDetailedNeg.extras.sharedWith.length > 0) ? true : false;
            },
            amount() {
                return this.formatImp(this.getDetailedNeg.amount);
            },
            deadline() {
                return (this.getDetailedNeg.deadline !== null) ? this.formatDate(this.getDetailedNeg.deadline) : 'N/A';
            },
            createdAt() {
                return this.formatDate(this.getDetailedNeg.created_at);
            },
            updatedAt() {
                return (this.getDetailedNeg.updated_at !== null)
                       ? this.formatDate(this.getDetailedNeg.updated_at)
                       : 'No se ha actualizado';
            },
        }
    };
</script>
