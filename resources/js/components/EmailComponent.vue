<template>
    <div>
        <div v-if="settingUpdate">
            <email-setting :update="true"></email-setting>
        </div>
        <div v-else>
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content email-app-sidebar d-flex">
                        <span class="sidebar-close-icon" @click="closeContentFolder">
                            <i class="feather icon-x"></i>
                        </span>
                        <div class="email-app-menu">
                            <div class="form-group form-group-compose text-center compose-btn">
                                <button type="button" class="btn btn-primary btn-block my-2" data-toggle="modal"
                                        data-target="#composeForm" id="composeEmail">
                                    <i class="feather icon-edit"></i> Nuevo
                                </button>
                            </div>
                            <div class="sidebar-menu-list" style="overflow:auto">
                                <div class="list-group list-group-messages font-medium-1">
                                    <a href="javascript:void(0)" @click="setFolder('inbox')"
                                       class="list-group-item list-group-item-action border-0 pt-0 active">
                                        <i class="font-medium-5 feather icon-mail mr-50"></i> Entrada
                                        <span class="badge badge-danger badge-pill float-right ml-2"
                                              v-if="countUnread(emails.inbox) > 0">
                                            {{ countUnread(emails.inbox) }}
                                        </span>
                                        <span class="badge badge-default badge-pill float-right">
                                            {{ countMessages(emails.inbox) }}
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action border-0"
                                       @click="setFolder('sent')">
                                        <i class="font-medium-5 feather icon-navigation mr-50"></i> Enviados
                                        <span class="badge badge-default badge-pill float-right">
                                            {{ countMessages(messages_send) }}
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action border-0"
                                       @click="setFolder('draft')">
                                        <i class="font-medium-5 feather icon-edit-2 mr-50"></i> Borradores
                                        <span class="badge badge-default badge-pill float-right">
                                            {{ countMessages(draft) }}
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action border-0"
                                       @click="setFolder('favorites')">
                                        <i class="font-medium-5 feather icon-star mr-50"></i> Favoritos
                                        <span class="badge badge-danger badge-pill float-right ml-2"
                                              v-if="countUnread(favorites) > 0">
                                            {{ countUnread(favorites) }}
                                        </span>
                                        <span class="badge badge-default badge-pill float-right">
                                            {{ countMessages(favorites) }}
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action border-0"
                                       @click="setFolder('spam')">
                                        <i class="font-medium-5 feather icon-info mr-50"></i> Spam
                                        <span class="badge badge-danger badge-pill float-right ml-2"
                                              v-if="countUnread(spam) > 0">
                                            {{ countUnread(spam) }}
                                        </span>
                                        <span class="badge badge-default badge-pill float-right">
                                            {{ (typeof(emails.spam)!=="undefined") ? emails.spam.length : 0 }}
                                        </span>
                                    </a>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action border-0"
                                       @click="setFolder('trash')">
                                        <i class="font-medium-5 feather icon-trash mr-50"></i> Papelera
                                        <span class="badge badge-danger badge-pill float-right ml-2"
                                              v-if="countUnread(trash) > 0">
                                            {{ countUnread(trash) }}
                                        </span>
                                        <span class="badge badge-default badge-pill float-right">
                                            {{ countMessages(trash) }}
                                        </span>
                                    </a>
                                </div>
                                <hr />
                                <h5 class="my-2 pt-25">Etiquetas</h5>
                                <div class="list-group list-group-labels font-medium-1">
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)" @click="setFolder('tag_pe')">
                                        <span class="bullet bullet-success mr-1"></span> Personal
                                    </a>
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)" @click="setFolder('tag_co')">
                                        <span class="bullet bullet-primary mr-1"></span> Compañía
                                    </a>
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)" @click="setFolder('tag_im')">
                                        <span class="bullet bullet-warning mr-1"></span> Importante
                                    </a>
                                    <a class="list-group-item list-group-item-action border-0 d-flex align-items-center"
                                       href="javascript:void(0)" @click="setFolder('tag_pr')">
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
                                    <div class="form-label-group mt-3">
                                        <input type="text" id="emailTo" class="form-control" placeholder="Para"
                                               name="fname-floating" v-model="sent.to" data-toggle="tooltip"
                                               title="dirección de correo electrónico de la persona a la cual enviar"
                                               :class="{'has-error': hasErrors('to')}" />
                                        <label for="emailTo">Para</label>
                                        <span class="invalid-feedback mb-3" role="alert" v-if="hasErrors('to')">
                                            <strong>{{ errors.to }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="emailSubject" class="form-control" placeholder="Asunto"
                                               name="fname-floating" v-model="sent.subject" data-toggle="tooltip"
                                               title="Asunto del correo electrónico"
                                               :class="{'has-error': hasErrors('subject')}" />
                                        <label for="emailSubject">Asunto</label>
                                        <span class="invalid-feedback mb-3" role="alert" v-if="hasErrors('subject')">
                                            <strong>{{ errors.subject }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="emailCC" class="form-control" placeholder="CC"
                                               name="fname-floating" v-model="sent.cc" data-title="tooltip"
                                               title="correo electrónico a quién enviar una copia"
                                               :class="{'has-error': hasErrors('cc')}" />
                                        <label for="emailCC">CC</label>
                                        <span class="invalid-feedback mb-3" role="alert" v-if="hasErrors('cc')">
                                            <strong>{{ errors.cc }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="text" id="emailBCC" class="form-control" placeholder="BCC"
                                               name="fname-floating" v-model="sent.bcc" data-toggle="tooltip"
                                               title="dirección de correo a quién enviar una copia oculta"
                                               :class="{'has-error': hasErrors('bcc')}" />
                                        <label for="emailBCC">BCC</label>
                                        <span class="invalid-feedback mb-3" role="alert" v-if="hasErrors('bcc')">
                                            <strong>{{ errors.bcc }}</strong>
                                        </span>
                                    </div>
                                    <div id="email-container">
                                        <!--<div class="editor" data-placeholder="Message" v-model="sent.message"></div>-->
                                        <textarea class="form-control" cols="30" rows="4" v-model="sent.message"
                                                  placeholder="Mensaje" data-toggle="tooltip"
                                                  title="Mensaje del correo electrónico"
                                                  :class="{'has-error': hasErrors('message')}"></textarea>
                                        <span class="invalid-feedback mb-3" role="alert" v-if="hasErrors('message')">
                                            <strong>{{ errors.message }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group mt-2">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="emailAttach"
                                                   data-toggle="tooltip" title="archivo adjunto"
                                                   @change="uploadAttachment" />
                                            <label class="custom-file-label" for="emailAttach">Archivo adjunto</label>
                                        </div>
                                        <div class="mail-files py-2" v-if="newEmailAttachments.length > 0">
                                            <div class="chip chip-primary mr-2" v-for="attach in newEmailAttachments">
                                                <div class="chip-body py-50">
                                                    <i class="fa fa-paperclip font-medium-2 mr-50"></i>
                                                    <span class="chip-text">
                                                        {{ getAttachName(attach) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" value="Enviar" class="btn btn-primary" data-toggle="tooltip"
                                           title="Enviar correo electrónico" @click="sentMessage" />
                                    <input type="button" value="Guardar" class="btn btn-primary" data-toggle="tooltip"
                                           title="Guardar correo electrónico en borradores" @click="saveDraft" />
                                    <input type="Reset" value="Cancelar" class="btn btn-white" data-dismiss="modal"
                                           data-toggle="tooltip" title="Cancelar envio de correo"
                                           @click="resetMessage" />
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
                        <div class="app-content-overlay" @click="closeContentFolder"></div>
                        <div class="email-app-area">
                            <!-- Email list Area -->
                            <div class="email-app-list-wrapper">
                                <div class="email-app-list">
                                    <div class="app-fixed-search">
                                        <div class="sidebar-toggle d-block d-lg-none" @click="openContentFolder">
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
                                                <input type="checkbox" />
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
                                                    <a href="javascript:void(0)" data-toggle="tooltip"
                                                       title="verificar correos nuevos" @click="getEmails(1)">
                                                        <span class="action-icon">
                                                            <i class="feather icon-refresh-cw"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0)" @click="setting()"
                                                       data-toggle="tooltip" title="reconfigurar correo">
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
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                             aria-labelledby="folder">
                                                            <a class="dropdown-item d-flex font-medium-1"
                                                               href="javascript:void(0)" @click="markAs('draft')">
                                                                <i class="font-medium-3 feather icon-edit-2 mr-50"></i>
                                                                Borrador
                                                            </a>
                                                            <a class="dropdown-item d-flex font-medium-1"
                                                               href="javascript:void(0)" @click="markAs('spam')">
                                                                <i class="font-medium-3 feather icon-info mr-50"></i>
                                                                Spam
                                                            </a>
                                                            <a class="dropdown-item d-flex font-medium-1"
                                                               href="javascript:void(0)" @click="deleteMessage()">
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
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tag">
                                                            <a href="javascript:void(0)" @click="tagMessage('PE')"
                                                               class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-success bullet-sm"></span>
                                                                Personal
                                                            </a>
                                                            <a href="javascript:void(0)" @click="tagMessage('CO')"
                                                               class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-primary bullet-sm"></span>
                                                                Compañía
                                                            </a>
                                                            <a href="javascript:void(0)" @click="tagMessage('IM')"
                                                               class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-warning bullet-sm"></span>
                                                                Importante
                                                            </a>
                                                            <a href="javascript:void(0)" @click="tagMessage('PR')"
                                                               class="dropdown-item font-medium-1">
                                                                <span class="mr-1 bullet bullet-danger bullet-sm"></span>
                                                                Privado
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-inline-item mail-unread">
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" id="envelop" data-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false"
                                                           href="javascript:void(0)">
                                                            <i class="feather icon-mail"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="envelop">
                                                            <a href="javascript:void(0)" @click="markAs('readed')"
                                                               class="dropdown-item font-medium-1">
                                                                <i class="far fa-envelope-open mr-2"></i>
                                                                Marcar como leído
                                                            </a>
                                                            <a href="javascript:void(0)" @click="markAs('unreaded')"
                                                               class="dropdown-item font-medium-1">
                                                                <i class="far fa-envelope mr-2"></i>
                                                                Marcar como no leído
                                                            </a>
                                                        </div>
                                                    </div>
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
                                        <!--<ul class="users-list-wrapper media-list">-->
                                            <paginate name="inbox" :list="emails.inbox" :per="10"
                                                      v-if="typeof(emails.inbox)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('inbox')" :key="email.id" v-if="showFolder==='inbox'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <paginate name="sent" :list="emails.sent" :per="10"
                                                      v-if="typeof(emails.sent)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('sent')" v-if="showFolder==='sent'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <paginate name="draft" :list="emails.draft" :per="10"
                                                      v-if="typeof(emails.draft)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('draft')" v-if="showFolder==='draft'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <paginate name="favorites" :list="favorites" :per="10"
                                                      v-if="typeof(favorites)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('favorites')" v-if="showFolder==='favorites'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <paginate name="spam" :list="emails.spam" :per="10"
                                                      v-if="typeof(emails.spam)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('spam')" v-if="showFolder==='spam'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <paginate name="trash" :list="trash" :per="10"
                                                      v-if="typeof(trash)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('trash')" v-if="showFolder==='trash'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <!-- Tag Personal -->
                                            <paginate name="tag_pe" :list="taggedMessages.pe" :per="10"
                                                      v-if="typeof(taggedMessages.pe)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('tag_pe')"
                                                    v-if="showFolder==='tag_pe'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <!-- Tag Compañía -->
                                            <paginate name="tag_co" :list="taggedMessages.co" :per="10"
                                                      v-if="typeof(taggedMessages.co)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('tag_co')"
                                                    v-if="showFolder==='tag_co'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <!-- Tag Importante -->
                                            <paginate name="tag_im" :list="taggedMessages.im" :per="10"
                                                      v-if="typeof(taggedMessages.im)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('tag_im')"
                                                    v-if="showFolder==='tag_im'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                            <!-- Tag Privado -->
                                            <paginate name="tag_pr" :list="taggedMessages.pr" :per="10"
                                                      v-if="typeof(taggedMessages.pr)!=='undefined'"
                                                      :class="'users-list-wrapper media-list'">
                                                <li class="media" v-for="email in paginated('tag_pr')"
                                                    v-if="showFolder==='tag_pr'"
                                                    :class="{'mail-read':(typeof(email.read)!=='undefined')?email.read:false}">
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
                                            </paginate>
                                        <!--</ul>-->
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='inbox'">
                                            <paginate-links for="inbox" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='sent'">
                                            <paginate-links for="sent" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='draft'">
                                            <paginate-links for="draft" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='favorites'">
                                            <paginate-links for="favorites" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='spam'">
                                            <paginate-links for="spam" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='trash'">
                                            <paginate-links for="trash" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <!-- Tag Personal -->
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='tag_pe'">
                                            <paginate-links for="tag_pe" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <!-- Tag Compañía -->
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='tag_co'">
                                            <paginate-links for="tag_co" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <!-- Tag Importante -->
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='tag_im'">
                                            <paginate-links for="tag_im" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <!-- Tag Privado -->
                                        <nav class="mt-3" style="margin:0 auto;"
                                             v-if="showFolder==='tag_pr'">
                                            <paginate-links for="tag_pr" :show-step-links="true" :async="true"
                                                            :classes="{
                                                                'ul': 'pagination', 'li': 'page-item', 'a': 'page-link'
                                                            }"
                                                            :step-links="{next: '›',prev: '‹'}"></paginate-links>
                                        </nav>
                                        <!--<nav aria-label="Page navigation example">
                                            <ul class="pagination justify-content-center mt-2">
                                                <li class="page-item prev">
                                                    <a class="page-link" @click="page--" href="javascript:void(0)">
                                                        Prev
                                                    </a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" v-for="pageNumber in pages.slice(page-1, page+5)"
                                                       @click="page = pageNumber" href="javascript:void(0)">
                                                        {{ pageNumber }}
                                                    </a>
                                                </li>
                                                <li class="page-item next">
                                                    <a class="page-link" @click="page++" href="javascript:void(0)">
                                                        Next
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>-->
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
                                                    <a class="dropdown-toggle" data-toggle="dropdown"
                                                       aria-haspopup="true" aria-expanded="false"
                                                       href="javascript:void(0)">
                                                        <i class="feather icon-folder font-medium-5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="folder">
                                                        <a class="dropdown-item d-flex font-medium-1"
                                                           href="javascript:void(0)" @click="markAs('draft')">
                                                            <i class="font-medium-3 feather icon-edit-2 mr-50"></i>
                                                            Borrador
                                                        </a>
                                                        <a class="dropdown-item d-flex font-medium-1"
                                                           href="javascript:void(0)" @click="markAs('spam')">
                                                            <i class="font-medium-3 feather icon-info mr-50"></i>
                                                            Spam
                                                        </a>
                                                        <a class="dropdown-item d-flex font-medium-1"
                                                           href="javascript:void(0)" @click="deleteMessage()">
                                                            <i class="font-medium-3 feather icon-trash mr-50"></i>
                                                            Papelera
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="dropdown no-arrow">
                                                    <a id="tag" class="dropdown-toggle" data-toggle="dropdown"
                                                       aria-haspopup="true" aria-expanded="false" href="#">
                                                        <i class="feather icon-tag font-medium-5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tag">
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1"
                                                           @click="tagMessage('PE')">
                                                            <span class="mr-1 bullet bullet-success bullet-sm"></span>
                                                            Personal
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1"
                                                           @click="tagMessage('CO')">
                                                            <span class="mr-1 bullet bullet-primary bullet-sm"></span>
                                                            Company
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1"
                                                           @click="tagMessage('IM')">
                                                            <span class="mr-1 bullet bullet-warning bullet-sm"></span>
                                                            Important
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item font-medium-1"
                                                           @click="tagMessage('PR')">
                                                            <span class="mr-1 bullet bullet-danger bullet-sm"></span>
                                                            Private
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" id="envelop" data-toggle="dropdown"
                                                       aria-haspopup="true" aria-expanded="false"
                                                       href="javascript:void(0)">
                                                        <i class="feather icon-mail font-medium-5"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="envelop">
                                                        <a href="javascript:void(0)" @click="markAs('readed')"
                                                           class="dropdown-item font-medium-1">
                                                            <i class="far fa-envelope-open mr-2"></i>
                                                            Marcar como leído
                                                        </a>
                                                        <a href="javascript:void(0)" @click="markAs('unreaded')"
                                                           class="dropdown-item font-medium-1">
                                                            <i class="far fa-envelope mr-2"></i>
                                                            Marcar como no leído
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-inline-item mail-delete">
                                                <a href="javascript:void(0)" @click="deleteMessage()">
                                                    <span class="action-icon">
                                                        <i class="feather icon-trash font-medium-5"></i>
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
                                                            <img src="/images/anonymous-user.png" alt="avtar img holder" width="61" height="61" />
                                                        </div>
                                                        <div class="mail-items">
                                                            <h4 class="list-group-item-heading mb-0">
                                                                {{ selectedEmail.from[0].personal }}
                                                            </h4>
                                                            <div class="email-info-dropup dropdown">
                                                                <span class="dropdown-toggle font-small-3"
                                                                      id="dropdownMenuButton200" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                                                        <strong>{{ datetime_format(selectedEmail.message_at) }}</strong>
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
                                                    <div class="mail-attachements d-flex" v-if="selectedEmail.attachments">
                                                        <i class="feather icon-paperclip font-medium-5 mr-50"></i>
                                                        <span>Archivos adjuntos</span>
                                                    </div>
                                                </div>
                                                <div class="mail-files py-2" v-if="selectedEmail.attachments.length > 0"
                                                     v-for="attach in selectedEmail.attachments">
                                                    <div class="chip chip-primary mr-2">
                                                        <div class="chip-body py-50">
                                                            <a :href="getAttachLink(attach)" target="_blank"
                                                               :download="getAttachName(attach)">
                                                                <i class="fa fa-paperclip font-medium-2 mr-50"></i>
                                                                <span class="chip-text">{{ getAttachName(attach) }}</span>
                                                            </a>
                                                        </div>
                                                    </div>
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
        background: "rgba(16, 22, 58, .5)",
    });
    export default {
        data() {
            return {
                showFolder: "inbox",
                titleSentMessage: "Nuevo Mensaje",
                settingUpdate: false,
                inboxUnread: 0,
                draft: [],
                spam: [],
                emails: {
                    inbox: [],
                    sent: [],
                    draft: [],
                    spam: []
                },
                selectedEmail: {},
                sent: {
                    to: "",
                    cc: "",
                    bcc: "",
                    subject: "",
                    message: "",
                },
                selectedMessages: [],
                trash: [],
                favorites: [],
                messages_send: [],
                newEmailAttachments: [],
                taggedMessages: {
                    pe: [],
                    co: [],
                    im: [],
                    pr: []
                },
                /** @type {Number} Indica el número de página actual en la paginación del correo */
                page: 1,
                /** @type {Number} Indica el número de elementos a mostrar por cada página */
                perPage: 10,
                /** @type {Array} Contiene los elementos a mostrar en cada página */
                pages: [],
                paginate: [
                    'inbox', 'sent', 'draft', 'favorites', 'spam', 'trash', 'tag_pe', 'tag_im', 'tag_co', 'tag_pr'
                ]
            };
        },
        props: {
            download_messages: {
                type: Boolean,
                required: false,
                default: false,
            },
        },
        watch: {
            /**
             * Monitorea cuando se selecciona un correo electrónico para ejecutar las acciones asociadas
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            selectedEmail: function() {
                const vm = this;
                if (vm.selectedEmail) {
                    axios.post('/email/mark-read', {
                        message_id: vm.selectedEmail.message_id
                    }).then(response => {
                        if (response.data.result) {
                            vm.getEmails();
                        }
                    }).catch(error => {
                        console.error(error);
                    });
                }
            },
            /*showFolder: function() {
                this.showPagination(this.showFolder, );
            }*/
        },
        methods: {
            /**
             * Establece la carpeta o bandeja de correo a mostrar
             *
             * @author     Ing. Roldan Vargas <rolvar@sogtwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            setFolder(folder) {
                const vm = this;
                vm.getEmails();
                if (folder === "inbox") {}
                vm.showFolder = folder;
            },
            /**
             * Almacena los archivos a adjuntar para un nuevo correo
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            uploadAttachment: function() {
                if (!$("#emailAttach").val()) {
                    return false;
                }
                const vm = this;
                var formData = new FormData();
                var attachment = document.querySelector(`#emailAttach`);
                formData.append("attachmentEmail", attachment.files[0]);

                axios.post('/email/upload-attachment', formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }).then(response => {
                    if (response.data.result) {
                        vm.newEmailAttachments.push(response.data.attach);
                        $("#emailAttach").val('').change();
                        $('.custom-file-label').text('');
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Muestra el número de mensajes en una carpeta
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             *
             * @param     {array}         folder    Arreglo con el contenido de una carpeta
             *
             * @return    {integer}       Número de mensajes en la carpeta establecida
             */
            countMessages(folder) {
                return (typeof(folder) !== "undefined") ? folder.length : 0;
            },
            /**
             * Muestra el número de mensaje sin leer dentro de una carpeta
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             *
             * @param     {array}       folder    Arreglo con el contenido de la carpeta
             *
             * @return    {integer}     Número de mensajes sin leer dentro de la carpeta
             */
            countUnread(folder) {
                return (typeof(folder) !== "undefined") ? folder.filter(function(msg) {
                    return (typeof(msg.read) !== "undefined" && !msg.read)
                }).length : 0;
            },
            /**
             * Obtiene un listado de mensajes del servidor de correos
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            getEmails(download = 0) {
                const vm = this;
                vm.$loading(true);
                axios.get(`/email/messages${download === 1 ? "/1" : ""}`).then((response) => {
                    if (response.data.result) {
                        vm.emails = response.data.emails_list;
                        vm.trash = response.data.trashed;
                        vm.favorites = response.data.favorites;
                        vm.messages_send = response.data.messages_send;
                        //setPages
                    } else {
                        toastr.warning(response.data.message, "Error!");
                    }
                    vm.$loading(false);
                }).catch((error) => {
                    console.error(error);
                    vm.$loading(false);
                });
            },
            /**
             * Obtiene el enlace de descarga del archivo adjunto
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @param     {string}         attachmentPath    Ruta en donde se ubica el archivo
             *
             * @return    {string}         Url para la descarga del archivo adjunto
             */
            getAttachLink(attachmentPath) {
                const vm = this;

                return (!attachmentPath.startsWith("http"))
                       ? `/attachment/${vm.getAttachName(attachmentPath)}`
                       : attachmentPath;
            },
            /**
             * Obtiene el nombre del archivo adjunto en un correo
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             *
             * @param     {string}         attachmentPath    Ruta del archivo adjunto
             *
             * @return    {string}         Nombre del archivo adjunto
             */
            getAttachName(attachmentPath) {
                var pathSections = attachmentPath.split("/");
                return pathSections[pathSections.length - 1];
            },
            /**
             * Ejecuta la acción para enviar un mensaje de correo electrónico
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            sentMessage() {
                const vm = this;
                vm.$loading(true);

                /*var formData = new FormData();
                var attachment = document.querySelector(`#emailAttach`);

                formData.append("attachmentEmail", attachment.files[0]);
                formData.append("to", vm.sent.to);
                formData.append("cc", vm.sent.cc);
                formData.append("bcc", vm.sent.bcc);
                formData.append("subject", vm.sent.subject);
                formData.append("message", vm.sent.message);*/

                axios.post("/email/sent", {
                    to: vm.sent.to,
                    cc: vm.sent.cc,
                    bcc: vm.sent.bcc,
                    subject: vm.sent.subject,
                    message: vm.sent.message,
                    attachments: vm.newEmailAttachments
                }).then((response) => {
                    if (response.data.result) {
                        vm.$loading(false);
                        $("#composeForm").find(".close").click();
                        toastr.success("Correo enviado", "Éxito!");
                        vm.resetMessage();
                        vm.messages_send = response.data.messages_send;
                        vm.newEmailAttachments = [];
                    }
                }).catch((error) => {
                    vm.errors = {};

                    if (typeof error.response != "undefined") {
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
                    to: "",
                    cc: "",
                    bcc: "",
                    subject: "",
                    message: "",
                };

                /** remueve y oculta cualquier mensaje de error del formulario */
                $("input, select, textarea").removeClass("has-error");
                $(".invalid-feedback").find("strong").text("");
                $(".invalid-feedback").hide();
                $("#attachmentEmail").val("");
                $("#emailAttach").val("");
                $('.custom-file-label').text('');
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
                var message_id = vm.selectedEmail ? vm.selectedEmail.message_id : null;
                if (message_id !== null && vm.selectedMessages.length === 0) {
                    toastr.warning(
                        "Debe seleccionar uno o mas mensajes a borrar",
                        "Error!"
                    );
                    return false;
                }

                axios
                    .post("/email/messages/delete", {
                        messages: vm.selectedMessages.length > 0 ? vm.selectedMessages : [message_id],
                    })
                    .then((response) => {
                        if (response.data.result) {
                            vm.getEmails();
                            toastr.success("Mensaje(s) eliminado(s)", "Éxito!");
                        }
                    })
                    .catch((error) => {
                        toastr.danger(
                            "No ha sido posible eliminar el(los) mensaje(s). Intente de nuevo mas tarde"
                        );
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
            /**
             * Establece un correo como favorito
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @param     {integer}       message_id    Identificador del correo a marcar como favorito
             */
            setFavorite(message_id) {
                const vm = this;
                axios
                    .post("/email/set-favorite", {
                        message_id: message_id,
                    })
                    .then((response) => {
                        if (response.data.result) {
                            vm.favorites.push(message_id);
                        } else {
                            toastr.warning(response.data.message, "Alerta!");
                        }
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            /**
             * Responder mensaje
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            replyMessage() {
                const vm = this;
                vm.sent.to = vm.selectedEmail.from[0].mail;
                vm.sent.subject = `RE: ${vm.selectedEmail.subject}`;
                vm.sent.message = vm.selectedEmail.body_text;
                vm.titleSentMessage = "Responder Mensaje";
            },
            /**
             * Reenviar mensaje
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            forwardMessage() {
                const vm = this;
                vm.sent.message = vm.selectedEmail.body_text;
                vm.titleSentMessage = "Reenviar Mensaje";
            },
            /**
             * Crea el listado de páginas a mostrar en el paginador de correos
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            setPages (mails) {
                const vm = this;
                let numberOfPages = Math.ceil(mails.length / vm.perPage);
                for (let index = 1; index <= numberOfPages; index++) {
                    vm.pages.push(index);
                }
            },
            /**
             * Establecer etiquetas de mensajes
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @param     {string}      tag    Etiqueta a establecer
             */
            tagMessage(tag) {
                const vm = this;
                if (vm.selectedMessages.length === 0 || !vm.selectedEmail) {
                    return false;
                }

                var tagName = '';
                if (tag === 'PE') {
                    tagName = 'personal(es)';
                }
                else if (tag === 'CO'){
                    tagName = 'compañía(s)';
                }
                else if (tag === 'IM') {
                    tagName = 'importante(s)';
                }
                else if (tag === 'PR') {
                    tagName = 'privado(s)';
                }

                axios.post('/email/set-tags', {
                    tag: tag,
                    emails: (vm.selectedEmail) ? [vm.selectedEmail.message_id] : vm.selectedMessages
                }).then(response => {
                    if (response.data.result) {
                        toastr.success(`Se ha etiquetado como ${tagName} el(los) mensaje(s) seleccionado(s)`);
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Obtiene listados de mensajes etiquetados
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             */
            getTaggedMessages() {
                const vm = this;

                axios.get('/email/get-tagged-messages').then(response => {
                    vm.taggedMessages.pe = response.data.tagged.pe;
                    vm.taggedMessages.co = response.data.tagged.co;
                    vm.taggedMessages.im = response.data.tagged.im;
                    vm.taggedMessages.pr = response.data.tagged.pr;
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Marca un mensaje de acuerdo a la opción indicada por el usuario
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @param     {string}    type    Tipo de acción para marcar el mensaje. Las opciones son:
             *                                draft, spam, trash, readed o unreaded
             */
            markAs(type) {
                const vm = this;
                axios.post('/email/mark-as', {
                    emails: vm.selectedMessages.length > 0
                            ? vm.selectedMessages
                            : (typeof(vm.selectedEmail.message_id) !== null ? [vm.selectedEmail.message_id] : []),
                    type: type
                }).then(response => {
                    if (response.data.result) {
                        if (type !== 'unreaded' && type !== 'readed') {
                            var oldFolder = response.data.oldFolder;
                            var newFolder = response.data.newFolder;
                            vm.emails[oldFolder] = JSON.parse(JSON.stringify(vm.emails[oldFolder].filter(function(em) {
                                return !response.data.emails.includes(em.message_id);
                            })));

                            response.data.emailList.forEach(function(em) {
                                vm.emails[newFolder].push(em);
                            });
                        }
                        else {
                            vm.email.inbox.forEach(function(inbox) {
                                if (response.data.emails.includes(inbox.message_id)) {
                                    inbox.read = (type === 'readed') ? 1 : 0;
                                }
                            });
                            vm.emails.sent.forEach(function(sent) {
                                if (response.data.emails.includes(sent.message_id)) {
                                    sent.read = (type === 'readed') ? 1 : 0;
                                }
                            });
                            vm.emails.draft.forEach(function(draft) {
                                if (response.data.emails.includes(draft.message_id)) {
                                    draft.read = (type === 'readed') ? 1 : 0;
                                }
                            });
                            vm.emails.spam.forEach(function(spam) {
                                if (response.data.emails.includes(spam.message_id)) {
                                    spam.read = (type === 'readed') ? 1 : 0;
                                }
                            });
                            vm.favorites.forEach(function(favorite) {
                                if (response.data.emails.includes(favorite.message_id)) {
                                    favorite.read = (type === 'readed') ? 1 : 0;
                                }
                            });
                        }
                        vm.selectedMessages = [];
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Establece el contenido de la página seleccionada en el paginador de correos
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             *
             * @param     {array}    mails    Arreglo con listado de correos
             *
             * @return    {array}    Arreglo con listado de correos de acuerdo a la página seleccionada
             */
            /*paginate (mails) {
                const vm = this;
                let page = vm.page;
                let perPage = vm.perPage;
                let from = (page * perPage) - perPage;
                let to = (page * perPage);
                return  mails.slice(from, to);
            },*/
            showPagination(folder, elements) {
                return this.showFolder === folder && elements.length > 0;
            },
            openContent: function(email = null) {
                const vm = this;
                if (email !== null) {
                    vm.selectedEmail = email;
                    vm.selectedEmail.attachments = (email.attachments !== null && email.attachments.length > 0)
                                                   ? JSON.parse(JSON.stringify(email.attachments)) : [];
                    $(".app-content .email-app-details").toggleClass("show");
                }
            },
            closeContent: function(e) {
                e.stopPropagation();
                $(".app-content .email-app-details").removeClass("show");
                this.resetMessage();
                this.selectedEmail = {};
                this.titleSentMessage = "Nuevo Mensaje";
            },

            openContentFolder: function(e) {
                console.log("inicia conversacion");
                e.stopPropagation();
                $(".app-content .sidebar-left").toggleClass("show");
                $(".app-content .app-content-overlay").addClass("show");
            },

            closeContentFolder: function() {
                $(".sidebar-left").removeClass("show");
                $(".app-content-overlay").removeClass("show");
            },

            openLabels: function() {
                $(".openLabels").toggleClass("show");
            },
        },
        mounted() {
            const vm = this;
            if (vm.download_messages) {
                vm.getEmails();
            }
            vm.getTaggedMessages();

            $(".selectAll")
                .find("input[type=checkbox]")
                .on("click", function() {
                    if (vm.selectedMessages.length > 0) {
                        vm.selectedMessages = [];
                    } else {
                        $(".checkboxEmail").each(function() {
                            vm.selectedMessages.push($(this).val());
                        });
                    }
                });
            $("#composeEmail").on("click", function() {
                vm.titleSentMessage = "Nuevo Mensaje";
            });
        },
    };
</script>
