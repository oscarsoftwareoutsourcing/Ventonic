<template>
    <div>
        <div v-if="settingUpdate">
            <email-setting :update="true"></email-setting>
        </div>
        <div v-else>
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content email-app-sidebar d-flex">
                        <span class="sidebar-close-icon">
                            <i class="feather icon-x"></i>
                        </span>
                        <div class="email-app-menu">
                            <div class="form-group form-group-compose text-center compose-btn">
                                <button type="button" class="btn btn-primary btn-block my-2" data-toggle="modal"
                                        data-target="#composeForm" id="composeEmail">
                                    <i class="feather icon-edit"></i> Componer
                                </button>
                            </div>
                            <div class="sidebar-menu-list" style="overflow:auto">
                                <div class="list-group list-group-messages font-medium-1">
                                    <a href="javascrip:void(0)" @click="getEmails"
                                       class="list-group-item list-group-item-action border-0 pt-0 active">
                                        <i class="font-medium-5 feather icon-mail mr-50"></i> Entrada
                                        <span class="badge badge-primary badge-pill float-right" v-if="inboxUnread > 0">
                                            {{ inboxUnread }}
                                        </span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">
                                        <i class="font-medium-5 feather icon-navigation mr-50"></i> Enviados
                                        <span class="badge badge-danger badge-pill float-right"
                                              v-if="messages_send.length > 0">
                                            {{ messages_send.length }}
                                        </span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">
                                        <i class="font-medium-5 feather icon-edit-2 mr-50"></i> Borradores
                                        <span class="badge badge-warning badge-pill float-right" v-if="draft.length > 0">
                                            {{ draft.length }}
                                        </span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">
                                        <i class="font-medium-5 feather icon-star mr-50"></i> Favoritos
                                        <span class="badge badge-danger badge-pill float-right" v-if="favorites.length > 0">
                                            {{ favorites.length }}
                                        </span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">
                                        <i class="font-medium-5 feather icon-info mr-50"></i> Spam
                                        <span class="badge badge-danger badge-pill float-right" v-if="spam.length > 0">
                                            {{ spam }}
                                        </span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">
                                        <i class="font-medium-5 feather icon-trash mr-50"></i> Papelera
                                        <span class="badge badge-danger badge-pill float-right" v-if="trash.length > 0">
                                            {{ trash.length }}
                                        </span>
                                    </a>
                                </div>
                                <hr />
                                <h5 class="my-2 pt-25">Etiquetas</h5>
                                <div class="list-group list-group-labels font-medium-1">
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)">
                                        <span class="bullet bullet-success mr-1"></span> Personal
                                    </a>
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)">
                                        <span class="bullet bullet-primary mr-1"></span> Compañía
                                    </a>
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)">
                                        <span class="bullet bullet-warning mr-1"></span> Importante
                                    </a>
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)">
                                        <span class="bullet bullet-danger mr-1"></span> Privado
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade text-left" id="composeForm" tabindex="-1" role="dialog"
                         aria-labelledby="emailCompose" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title text-text-bold-600" id="emailCompose">
                                        {{ titleSentMessage }}
                                    </h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pt-1">
                                    <div class="form-label-group mt-1">
                                        <input type="text" id="emailTo" class="form-control" placeholder="Para"
                                               name="fname-floating" v-model="sent.to" data-toggle="tooltip"
                                               title="dirección de correo electrónico de la persona a la cual enviar"
                                               :class="{'has-error': hasErrors('to')}"/>
                                        <label for="emailTo">Para</label>
                                        <span class="invalid-feedback mb-3" role="alert"
                                              v-if="hasErrors('to')">
                                            <strong>{{ errors.to }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="emailSubject" class="form-control" placeholder="Asunto"
                                               name="fname-floating" v-model="sent.subject" data-toggle="tooltip"
                                               title="Asunto del correo electrónico"
                                               :class="{'has-error': hasErrors('subject')}"/>
                                        <label for="emailSubject">Asunto</label>
                                        <span class="invalid-feedback mb-3" role="alert"
                                              v-if="hasErrors('subject')">
                                            <strong>{{ errors.subject }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="emailCC" class="form-control" placeholder="CC"
                                               name="fname-floating" v-model="sent.cc" data-title="tooltip"
                                               title="correo electrónico a quién enviar una copia"
                                               :class="{'has-error': hasErrors('cc')}"/>
                                        <label for="emailCC">CC</label>
                                        <span class="invalid-feedback mb-3" role="alert"
                                              v-if="hasErrors('cc')">
                                            <strong>{{ errors.cc }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="emailBCC" class="form-control" placeholder="BCC"
                                               name="fname-floating" v-model="sent.bcc" data-toggle="tooltip"
                                               title="dirección de correo a quién enviar una copia oculta"
                                               :class="{'has-error': hasErrors('bcc')}"/>
                                        <label for="emailBCC">BCC</label>
                                        <span class="invalid-feedback mb-3" role="alert"
                                              v-if="hasErrors('bcc')">
                                            <strong>{{ errors.bcc }}</strong>
                                        </span>
                                    </div>
                                    <div id="email-container">
                                        <!--<div class="editor" data-placeholder="Message" v-model="sent.message"></div>-->
                                        <textarea class="form-control" cols="30" rows="4" v-model="sent.message"
                                                  placeholder="Mensaje" data-toggle="tooltip"
                                                  title="Mensaje del correo electrónico"
                                                  :class="{'has-error': hasErrors('message')}"></textarea>
                                        <span class="invalid-feedback mb-3" role="alert"
                                              v-if="hasErrors('message')">
                                            <strong>{{ errors.message }}</strong>
                                        </span>
                                    </div>
                                    <!--<div class="form-group mt-2">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="emailAttach"
                                                   data-toggle="tooltip" title="archivo adjunto"/>
                                            <label class="custom-file-label" for="emailAttach">Archivo adjunto</label>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="modal-footer">
                                    <input type="button" value="Enviar" class="btn btn-primary" data-toggle="tooltip"
                                           title="Enviar correo electrónico" @click="sentMessage"/>
                                    <input type="button" value="Guardar" class="btn btn-primary" data-toggle="tooltip"
                                           title="Guardar correo electrónico en borradores" @click="saveDraft"/>
                                    <input type="Reset" value="Cancelar" class="btn btn-white" data-dismiss="modal"
                                           data-toggle="tooltip" title="Cancelar envio de correo" @click="resetMessage"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper">
                    <div class="content-header row"></div>
                    <div class="content-body">
                        <div class="app-content-overlay"></div>
                        <div class="email-app-area">
                            <!-- Email list Area -->
                            <div class="email-app-list-wrapper">
                                <div class="email-app-list">
                                    <div class="app-fixed-search">
                                        <div class="sidebar-toggle d-block d-lg-none">
                                            <i class="feather icon-menu"></i>
                                        </div>
                                        <fieldset class="form-group position-relative has-icon-left m-0">
                                            <input type="text" class="form-control" id="email-search"
                                                   placeholder="Buscar email" />
                                            <div class="form-control-position">
                                                <i class="feather icon-search"></i>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="app-action">
                                        <div class="action-left">
                                            <div class="vs-checkbox-con selectAll">
                                                <input type="checkbox"/>
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-minus"></i>
                                                    </span>
                                                </span>
                                                <span>Seleccionar todos</span>
                                            </div>
                                        </div>
                                        <div class="action-right">
                                            <ul class="list-inline m-0">
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0)" @click="setting()" data-toggle="tooltip"
                                                       title="reconfigurar correo">
                                                        <span class="action-icon">
                                                            <i class="feather icon-settings"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" id="folder" data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false"
                                                           href="javascript:void(0)">
                                                            <i class="feather icon-folder"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="folder">
                                                            <a class="dropdown-item d-flex font-medium-1" href="#">
                                                                <i class="font-medium-3 feather icon-edit-2 mr-50"></i>
                                                                Borrador
                                                            </a>
                                                            <a class="dropdown-item d-flex font-medium-1" href="#">
                                                                <i class="font-medium-3 feather icon-info mr-50"></i>
                                                                Spam
                                                            </a>
                                                            <a class="dropdown-item d-flex font-medium-1" href="#">
                                                                <i class="font-medium-3 feather icon-trash mr-50"></i>
                                                                Papelera
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" id="tag" data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false"
                                                           href="javascript:void(0)">
                                                            <i class="feather icon-tag"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                             aria-labelledby="tag">
                                                            <a href="#" class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-success bullet-sm"></span>
                                                                Personal
                                                            </a>
                                                            <a href="#" class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-primary bullet-sm"></span>
                                                                Compañía
                                                            </a>
                                                            <a href="#" class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-warning bullet-sm"></span>
                                                                Importante
                                                            </a>
                                                            <a href="#" class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-danger bullet-sm"></span>
                                                                Privado
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item mail-unread">
                                                    <span class="action-icon">
                                                        <i class="feather icon-mail"></i>
                                                    </span>
                                                </li>
                                                <li class="list-inline-item mail-delete">
                                                    <a href="javascript:void(0)" @click="deleteMessage()">
                                                        <span class="action-icon">
                                                            <i class="feather icon-trash"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="email-user-list list-group" style="overflow:auto">
                                        <ul class="users-list-wrapper media-list">
                                            <li class="media" v-for="email in emails.inbox"
                                                :class="{'mail-read': (typeof(email.read)!=='undefined') ? email.read : false}">
                                                <div class="media-left pr-50">
                                                    <div class="avatar">
                                                        <img src="/images/anonymous-user.png" alt="avatar img holder" />
                                                    </div>
                                                    <div class="user-action">
                                                        <div class="vs-checkbox-con">
                                                            <!-- checkbox para seleccionar mensaje -->
                                                            <input type="checkbox" :value="email.message_id"
                                                                   v-model="selectedMessages" class="checkboxEmail" />
                                                            <span class="vs-checkbox vs-checkbox-sm">
                                                                <span class="vs-checkbox--check">
                                                                    <i class="vs-icon feather icon-check"></i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                        <span class="favorite">
                                                            <i class="feather icon-star" :id="email.message_id"
                                                               @click="setFavorite(email.message_id)"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="media-body" @click="openContent(email)">
                                                    <div class="user-details">
                                                        <div class="mail-items">
                                                            <h5 class="list-group-item-heading text-bold-600 mb-25">
                                                                {{ email.from[0].personal }}
                                                            </h5>
                                                            <span class="list-group-item-text text-truncate">
                                                                {{ email.subject }}
                                                            </span>
                                                        </div>
                                                        <div class="mail-meta-item">
                                                            <span class="float-right">
                                                                <span class="mr-1 bullet bullet-success bullet-sm"></span>
                                                                <span class="mail-date">
                                                                    {{ datetime_format(email.message_at) }}
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="mail-message">
                                                        <p class="list-group-item-text truncate mb-0">
                                                            <!--<div v-html="email.body"></div>-->
                                                            {{ email.body_text }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="no-results">
                                            <h5>No Items Found</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Email list Area -->
                            <!-- Detailed Email View -->
                            <div class="email-app-details">
                                <div class="email-detail-header">
                                    <div class="email-header-left d-flex align-items-center mb-1">
                                        <span class="go-back mr-1" @click="closeContent">
                                            <i class="feather icon-arrow-left font-medium-4"></i>
                                        </span>
                                        <h3>{{ selectedEmail.subject }}</h3>
                                    </div>
                                    <div class="email-header-right mb-1 ml-2 pl-1">
                                        <ul class="list-inline m-0">
                                            <li class="list-inline-item">
                                                <span class="action-icon favorite">
                                                    <i class="feather icon-star font-medium-5"></i>
                                                </span>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false" href="javascript:void(0)">
                                                        <i class="feather icon-folder font-medium-5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="folder">
                                                        <a class="dropdown-item d-flex font-medium-1" href="#">
                                                            <i class="font-medium-3 feather icon-edit-2 mr-50"></i> Draft
                                                        </a>
                                                        <a class="dropdown-item d-flex font-medium-1" href="#">
                                                            <i class="font-medium-3 feather icon-info mr-50"></i> Spam
                                                        </a>
                                                        <a class="dropdown-item d-flex font-medium-1" href="#">
                                                            <i class="font-medium-3 feather icon-trash mr-50"></i> Trash
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false" href="javascript:void(0)">
                                                        <i class="feather icon-tag font-medium-5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tag">
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1">
                                                            <span class="mr-1 bullet bullet-success bullet-sm"></span>
                                                            Personal
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1">
                                                            <span class="mr-1 bullet bullet-primary bullet-sm"></span>
                                                            Company
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1">
                                                            <span class="mr-1 bullet bullet-warning bullet-sm"></span>
                                                            Important
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1">
                                                            <span class="mr-1 bullet bullet-danger bullet-sm"></span>
                                                            Private
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <span class="action-icon">
                                                    <i class="feather icon-mail font-medium-5"></i>
                                                </span>
                                            </li>
                                            <li class="list-inline-item mail-delete">
                                                <a href="javascript:void(0)" @click="deleteMessage()">
                                                    <span class="action-icon">
                                                        <i class="feather icon-trash"></i>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="list-inline-item email-prev">
                                                <span class="action-icon">
                                                    <i class="feather icon-chevrons-left font-medium-5"></i>
                                                </span>
                                            </li>
                                            <li class="list-inline-item email-next">
                                                <span class="action-icon">
                                                    <i class="feather icon-chevrons-right font-medium-5"></i>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="email-scroll-area" style="overflow:auto">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="email-label ml-2 my-2 pl-1">
                                                <span class="mr-1 bullet bullet-primary bullet-sm"></span>
                                                <small class="mail-label">Company</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card px-1">
                                                <div class="card-header email-detail-head ml-75"
                                                     v-if="Object.keys(selectedEmail).length > 0 && selectedEmail.constructor === Object">
                                                    <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
                                                        <div class="avatar mr-75">
                                                            <img src="/images/anonymous-user.png" alt="avtar img holder"
                                                                 width="61" height="61" />
                                                        </div>
                                                        <div class="mail-items">
                                                            <h4 class="list-group-item-heading mb-0">
                                                                {{ selectedEmail.from[0].personal }}
                                                            </h4>
                                                            <div class="email-info-dropup dropdown">
                                                                <span class="dropdown-toggle font-small-3"
                                                                      id="dropdownMenuButton200" data-toggle="dropdown"
                                                                      aria-haspopup="true" aria-expanded="false">
                                                                    {{ selectedEmail.from[0].mail }}
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right p-50"
                                                                     aria-labelledby="dropdownMenuButton200">
                                                                    <div class="px-25 dropdown-item">
                                                                        From:
                                                                        <strong>{{ selectedEmail.from[0].mail }}</strong>
                                                                    </div>
                                                                    <div class="px-25 dropdown-item">
                                                                        To:
                                                                        <strong>{{ selectedEmail.to[0].mail }}</strong>
                                                                    </div>
                                                                    <div class="px-25 dropdown-item">
                                                                        Date:
                                                                        <strong>
                                                                            {{ datetime_format(selectedEmail.message_at) }}
                                                                        </strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mail-meta-item">
                                                        <div class="mail-time mb-1">
                                                            {{ time_format(selectedEmail.message_at) }}
                                                        </div>
                                                        <div class="mail-date">
                                                            {{ date_format(selectedEmail.message_at) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body mail-message-wrapper pt-2 mb-0">
                                                    <div class="mail-message">
                                                        <div v-html="selectedEmail.body"></div>
                                                    </div>
                                                    <div class="mail-attachements d-flex">
                                                        <i class="feather icon-paperclip font-medium-5 mr-50"></i>
                                                        <span>Archivos adjuntos</span>
                                                    </div>
                                                </div>
                                                <div class="mail-files py-2">
                                                    <!--<div class="chip chip-primary">
                                                        <div class="chip-body py-50">
                                                            <span class="chip-text">interdum.docx</span>
                                                        </div>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="font-medium-1">
                                                            Haga clic para
                                                            <span class="primary cursor-pointer">
                                                                <a href="javascript:void(0)" @click="replyMessage()"
                                                                   data-toggle="modal" data-target="#composeForm">
                                                                    <strong>Responser</strong>
                                                                </a>
                                                            </span> o
                                                            <span class="primary cursor-pointer">
                                                                <a href="javascript:void(0)" @click="forwardMessage()"
                                                                   data-toggle="modal" data-target="#composeForm">
                                                                    <strong>Reenviar</strong>
                                                                </a>
                                                            </span>
                                                        </span>
                                                        <i class="feather icon-paperclip font-medium-5 mr-50"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Detailed Email View -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueLoading from "vuejs-loading-plugin";
Vue.use(VueLoading, {
    dark: true,
    text: "Procesando, por favor espere",
    loading: false,
    background: "rgba(16, 22, 58, .5)"
});
export default {
    data() {
        return {
            titleSentMessage: 'Nuevo Mensaje',
            settingUpdate: false,
            inboxUnread: 0,
            draft: 0,
            spam: 0,
            emails: [],
            selectedEmail: {},
            sent: {
                to: '',
                cc: '',
                bcc: '',
                subject: '',
                message: ''
            },
            selectedMessages: [],
            trash: [],
            favorites: [],
            messages_send: []
        };
    },
    props: {
        download_messages: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    methods: {
        /**
         * Obtiene un listado de mensajes del servidor de correos
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         */
        getEmails(download = 0) {
            const vm = this;
            vm.$loading(true);
            axios
                .get(`/email/messages${(download === 1) ? '/1' : ''}`)
                .then(response => {
                    if (response.data.result) {
                        vm.emails = response.data.emails_list;
                        vm.trash = response.data.trashed;
                        vm.favorites = response.data.favorites;
                        vm.messages_send = response.data.messages_send;
                    } else {
                        toastr.warning(response.data.message, 'Error!');
                    }
                    vm.$loading(false);
                })
                .catch(error => {
                    console.error(error);
                    vm.$loading(false);
                });
        },
        /**
         * Ejecuta la acción para enviar un mensaje de correo electrónico
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         */
        sentMessage() {
            const vm = this;
            vm.$loading(true);
            axios.post('/email/sent', {
                to: vm.sent.to,
                cc: vm.sent.cc,
                bcc: vm.sent.bcc,
                subject: vm.sent.subject,
                message: vm.sent.message
            }).then(response => {
                if (response.data.result) {
                    vm.$loading(false);
                    $('#composeForm').find('.close').click();
                    toastr.success('Correo enviado', 'Éxito!');
                    vm.resetMessage();
                    vm.messages_send = response.data.messages_send;
                }
            }).catch(error => {
                vm.errors = {};

                if (typeof(error.response) !="undefined") {
                    for (var index in error.response.data.errors) {
                        if (error.response.data.errors[index]) {
                            vm.errors[index] = error.response.data.errors[index][0];
                        }
                    }
                }
                vm.$loading(false);
            });
        },
        /**
         * Guardar mensaje en borradores
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         */
        saveDraft() {
            const vm = this;

        },
        /**
         * Ejecuta la acción para reiniciar los campos para el envio de correo electrónico
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         */
        resetMessage() {
            this.sent = {
                to: '',
                cc: '',
                bcc: '',
                subject: '',
                message: ''
            };

            /** remueve y oculta cualquier mensaje de error del formulario */
            $('input, select, textarea').removeClass('has-error');
            $(".invalid-feedback").find('strong').text('');
            $(".invalid-feedback").hide();
        },
        /**
         * Marca el o los mensajes como leídos
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         *
         * @param     {string|array}      message_id    identificador del(los) mensaje(s)
         */
        markAsRead(message_id) {},
        /**
         * Elimina uno o mas mensajes
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         *
         * @param     {string}    message_id    Identificador del mensaje a eliminar,
         *                                      si no se especifica busca en un listado de mensajes a eliminar,
         *                                      si no existe advierte al usuario
         */
        deleteMessage() {
            const vm = this;
            var message_id = (vm.selectedEmail) ? vm.selectedEmail.message_id : null;
            if (message_id !== null && vm.selectedMessages.length === 0) {
                toastr.warning('Debe seleccionar uno o mas mensajes a borrar', 'Error!');
                return false;
            }

            axios.post('/email/messages/delete', {
                messages: (vm.selectedMessages.length > 0) ? vm.selectedMessages : [message_id]
            }).then(response => {
                if (response.data.result) {
                    vm.getEmails();
                    toastr.success('Mensaje(s) eliminado(s)', 'Éxito!');
                }
            }).catch(error => {
                toastr.danger('No ha sido posible eliminar el(los) mensaje(s). Intente de nuevo mas tarde');
            });
        },
        /**
         * Bandera que permite mostrar nuevamente el formulario de configuración
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         */
        setting() {
            this.settingUpdate = true;
        },
        setFavorite(message_id) {
            const vm = this;
            axios.post('/email/set-favorite', {
                message_id: message_id
            }).then(response => {
                if (response.data.result) {
                    //$(`#${message_id}`).attr('style', 'color:orange');
                    vm.favorites.push(message_id);
                }
                else {
                    toastr.warning(response.data.message, 'Alerta!');
                }
            }).catch(error => {
                console.error(error);
            });
        },
        /**
         * Responder mensaje
         *
         * @method    replyMessage
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         */
        replyMessage() {
            const vm = this;
            vm.sent.to = vm.selectedEmail.from[0].mail;
            vm.sent.subject = `RE: ${vm.selectedEmail.subject}`;
            vm.sent.message = vm.selectedEmail.body_text;
            vm.titleSentMessage = 'Responder Mensaje';
        },
        /**
         * Reenviar mensaje
         *
         * @method    replyMessage
         *
         * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
         */
        forwardMessage() {
            const vm = this;
            vm.sent.message = vm.selectedEmail.body_text;
            vm.titleSentMessage = 'Reenviar Mensaje';
        },
        openContent: function(email = null) {
            const vm = this;
            if (email) {
                vm.selectedEmail = email;
            }
            $(".app-content .email-app-details").toggleClass("show");
        },
        closeContent: function(e) {
            e.stopPropagation();
            $(".app-content .email-app-details").removeClass("show");
            this.resetMessage();
            this.selectedEmail = {};
            this.titleSentMessage = 'Nuevo Mensaje';
        }
    },
    mounted() {
        const vm = this;
        if (vm.download_messages) {
            vm.getEmails();
        }

        $('.selectAll').find('input[type=checkbox]').on('click', function() {
            if (vm.selectedMessages.length > 0) {
                vm.selectedMessages = [];
            }
            else {
                $('.checkboxEmail').each(function() {
                    vm.selectedMessages.push($(this).val());
                });
            }
        });
        $('#composeEmail').on('click', function() {
            vm.titleSentMessage = 'Nuevo Mensaje';
        });
    }
};

</script>
