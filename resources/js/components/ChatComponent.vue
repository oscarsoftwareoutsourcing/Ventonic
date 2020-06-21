<template>
    <!--<div class="content-area-wrapper">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content card">
                    <div class="chat-fixed-search">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-profile-toggle position-relative d-inline-flex">
                                <h3 class="primary p-1 mb-0">Chats</h3>
                                <div class="bullet-success bullet-sm position-absolute"></div>
                            </div>
                        </div>
                    </div>
                    <div id="users-list" class="chat-user-list list-group position-relative">
                        <ul class="chat-users-list-wrapper media-list">
                            <li class="py-2" v-for="(user, index) in users" :key="index">
                                <div class="pr-1">
                                    <span class="avatar m-0 avatar-md">
                                        <img class="media-object rounded-circle" :src="user.photo" height="42"
                                             width="42" v-if="user.photo">
                                        <img src="/images/anonymous-user.png" class="media-object rounded-circle"
                                             alt="photo" height="42" width="42" v-else>
                                        <i></i>
                                    </span>
                                </div>
                                <div class="user-chat-info">
                                    <div class="contact-info">
                                        <h5 class="font-weight-bold mb-0">{{ user.name }}</h5>
                                    </div>
                                    <div class="contact-meta">
                                        <span class="float-right mb-25"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <div class="chat-overlay"></div>
                    <section class="chat-app-window">
                        <div class="active-chat">
                            <div class="chat_navbar">
                                <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                    <div class="vs-con-items d-flex align-items-center">
                                        <div class="sidebar-toggle d-block d-lg-none mr-1">
                                            <i class="feather icon-menu font-large-1"></i>
                                        </div>
                                        <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                            <span class="avatar-status-busy"></span>
                                        </div>
                                        <h6 class="mb-0"></h6>
                                        <span class="text-muted" v-if="activeUser">
                                            {{ activeUser.name }} esta escribiendo...
                                        </span>
                                    </div>
                                </header>
                            </div>
                            <div class="user-chats">
                                <div class="chats">
                                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                                        <li class="p-2" v-for="(message, index) in messages" :key="index">
                                            <div class="chat chat-left">
                                                <div class="chat-avatar">
                                                    <p><strong>{{ message.user.name }}</strong></p>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-content">
                                                        <p>{{ message.message }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-app-form">
                                <div class="chat-app-input d-flex">
                                    <input type="text" name="message" placeholder="Escribe un mensaje..."
                                           class="form-control emoji-picker message mr-1 ml-50" v-model="newMessage"
                                           @keyup.enter="sendMessage" @keydown="sendTypingEvent">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>-->

    <div class="content-area-wrapper">
        <div class="sidebar-left">
            <div class="sidebar">
                <!-- User Chat profile area -->
                <div class="chat-profile-sidebar">
                    <header class="chat-profile-header">
                        <span class="close-icon">
                            <i class="feather icon-x"></i>
                        </span>
                        <div class="header-profile-sidebar">
                            <div class="avatar">
                                <img :src="user.photo" alt="user avatar" height="70" width="70" v-if="user.photo">
                                <img src="/images/anonymous-user.png" alt="user avatar" height="70" width="70" v-else>
                                <span class="avatar-status-online avatar-status-lg"></span>
                            </div>
                            <h4 class="chat-user-name">{{ user.name }}</h4>
                        </div>
                    </header>

                    <div class="profile-sidebar-area">
                        <div class="scroll-area ps ps--active-y">
                            <h6>Perfil</h6>
                            <div class="about-user">
                                <fieldset class="mb-0">
                                    <textarea data-length="120" class="form-control char-textarea" id="textarea-counter"
                                              rows="5" placeholder="Acerca del usuario"></textarea>
                                </fieldset>
                                <small class="counter-value float-right">
                                    <span class="char-count"></span>
                                </small>
                            </div>
                            <h6 class="mt-3">Estatus</h6>
                            <ul class="list-unstyled user-status mb-0">
                                <li class="pb-50">
                                    <fieldset>
                                        <div class="vs-radio-con vs-radio-success">
                                            <input type="radio" name="userStatus" value="online" checked="checked">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Activo</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="pb-50">
                                    <fieldset>
                                        <div class="vs-radio-con vs-radio-danger">
                                            <input type="radio" name="userStatus" value="busy">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">No molestar</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="pb-50">
                                    <fieldset>
                                        <div class="vs-radio-con vs-radio-warning">
                                            <input type="radio" name="userStatus" value="away">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Ocupado</span>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="pb-50">
                                    <fieldset>
                                        <div class="vs-radio-con vs-radio-secondary">
                                            <input type="radio" name="userStatus" value="offline">
                                            <span class="vs-radio">
                                                <span class="vs-radio--border"></span>
                                                <span class="vs-radio--circle"></span>
                                            </span>
                                            <span class="">Offline</span>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 0px; height: 271px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 184px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Sidebar area -->
                <div class="sidebar-content card">
                    <span class="sidebar-close-icon">
                        <i class="feather icon-x"></i>
                    </span>
                    <div class="chat-fixed-search">
                        <div class="d-flex align-items-center">
                            <div class="sidebar-profile-toggle position-relative d-inline-flex">
                                <div class="avatar">
                                    <img :src="user.photo" alt="user avatar" width="40" height="40" v-if="user.photo">
                                    <img src="/images/anonymous-user.png" alt="user avatar" height="40" width="40" v-else>
                                    <span class="avatar-status-online"></span>
                                </div>
                                <div class="bullet-success bullet-sm position-absolute"></div>
                            </div>
                            <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                                <input type="text" class="form-control round" id="chat-search"
                                       placeholder="Buscar o iniciar nuevo chat">
                                <div class="form-control-position">
                                    <i class="feather icon-search"></i>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="chat-user-list list-group position-relative ps ps--active-y"
                         v-for="room in chatOrigins" v-if="room.users.length > 0">
                        <h3 class="primary p-1 mb-0">{{ room.type }}</h3>
                        <ul class="chat-users-list-wrapper media-list">
                            <li v-for="(otherUser, index) in room.users" :key="index"
                                @click="selectUser(otherUser)"
                                :class="{'active': (typeof(selectedUser.user_id) !== 'undefined' && selectedUser.user_id === otherUser.user.id)}">
                                <div class="pr-1">
                                    <span class="avatar m-0 avatar-md">
                                        <img class="media-object rounded-circle" :src="otherUser.user.photo" height="42"
                                             width="42" v-if="otherUser.user.photo">
                                        <img src="/images/anonymous-user.png" class="media-object rounded-circle"
                                             alt="photo" height="42" width="42" v-else>
                                        <i></i>
                                    </span>
                                </div>
                                <div class="user-chat-info">
                                    <div class="contact-info">
                                        <h5 class="font-weight-bold mb-0">{{ otherUser.user.name }}</h5>
                                        <p class="truncate"></p>
                                    </div>
                                    <div class="contact-meta">
                                        <span class="float-right mb-25">
                                            {{ otherUser.user.last_login }}
                                        </span>
                                        <span class="badge badge-primary badge-pill float-right"
                                              v-if="otherUser.user.unreaded_messages > 0"
                                              :id="'unreaded_'+otherUser.user.id">
                                            {{ otherUser.user.unreaded_messages }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 358px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 138px;"></div>
                        </div>
                    </div>
                    <!--<div id="users-list" class="chat-user-list list-group position-relative ps ps--active-y">
                        <h3 class="primary p-1 mb-0">Chats</h3>
                        <ul class="chat-users-list-wrapper media-list">
                            <li v-for="(otherUser, index) in users" :key="index" v-if="user.id!==otherUser.id"
                                @click="selectUser(otherUser)">
                                <div class="pr-1">
                                    {{ selectUser(otherUser) }}
                                    <span class="avatar m-0 avatar-md">
                                        <img class="media-object rounded-circle" :src="otherUser.photo" height="42"
                                             width="42" v-if="otherUser.photo">
                                        <img src="/images/anonymous-user.png" class="media-object rounded-circle"
                                             alt="photo" height="42" width="42" v-else>
                                        <i></i>
                                    </span>
                                </div>
                                <div class="user-chat-info">
                                    <div class="contact-info">
                                        <h5 class="font-weight-bold mb-0">{{ otherUser.name }}</h5>
                                        <p class="truncate"></p>
                                    </div>
                                    <div class="contact-meta">
                                        <span class="float-right mb-25"></span>
                                        <span class="badge badge-primary badge-pill float-right"></span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 358px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 138px;"></div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>

        <!-- Area de mensajes del chat -->
        <div class="content-right">
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <div class="chat-overlay"></div>
                    <section class="chat-app-window">
                        <div class="start-chat-area"
                             v-if="!selectedUser || typeof(selectedUser.user) === 'undefined'">
                            <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                            <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Iniciar conversación</h4>
                        </div>
                        <div class="active-chat" v-else>
                            <div class="chat_navbar">
                                <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                    <div class="vs-con-items d-flex align-items-center">
                                        <div class="sidebar-toggle d-block d-lg-none mr-1">
                                            <i class="feather icon-menu font-large-1"></i>
                                        </div>
                                        <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                            <img :src="selectedUser.user.photo" alt="user avatar" width="40" height="40"
                                                 v-if="selectedUser.user.photo">
                                            <img src="/images/anonymous-user.png" class="media-object rounded-circle"
                                                 alt="photo" height="40" width="40" v-else>
                                            <span class="avatar-status-busy"
                                                  v-if="!selectedUser.user.status"></span>
                                            <span class="avatar-status-online" v-else></span>
                                        </div>
                                        <h6 class="mb-0">{{ selectedUser.user.name || 'anonimo' }}</h6>
                                    </div>
                                    <span class="favorite"><i class="feather icon-star font-medium-5"></i></span>
                                </header>
                            </div>

                            <!-- Sección de mensajes del chat -->
                            <div class="user-chats ps">
                                <div class="chats chat-scroll"  style="" v-chat-scroll>
                                    <div class="chat" v-for="(message, index) in messages" :key="index"
                                         :class="{'chat-left': message.user.id !== user.id }">
                                        <div class="chat-avatar">
                                            <a class="avatar m-0" data-toggle="tooltip" href="#"
                                               :data-placement="(message.user.id !== user.id)?'left':'right'"
                                               title="" data-original-title="">
                                                <img :src="message.user.photo" alt="avatar" width="40" height="40"
                                                     v-if="message.user.photo">
                                                <img src="/images/anonymous-user.png" alt="avatar" width="40" height="40"
                                                     v-else>
                                            </a>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-content">
                                                <p>{{ message.message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="divider">
                                        <div class="divider-text">Yesterday</div>
                                    </div>-->
                                </div>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                </div>
                            </div>

                            <div class="chat-app-form">
                                <form class="chat-app-input d-flex" action="javascript:void(0);">
                                    <input type="text" class="form-control message mr-1 ml-50" id="iconLeft4-1"
                                           placeholder="Escribe tu mensaje..." v-model="newMessage"
                                           @keyup.enter="sendMessage" @keydown="sendTypingEvent">
                                    <button type="button" class="btn btn-primary send waves-effect waves-light"
                                            @click="sendMessage">
                                        <i class="fa fa-paper-plane-o d-lg-none"></i>
                                        <span class="d-none d-lg-block">Enviar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                newMessage: '',
                messages: [],
                users: [],
                activeUser: false,
                typingTimer: false,
                selectedUser: {},
                chatOrigins: []
            }
        },
        created() {
            const vm = this;
            vm.fetchMessages();
            vm.getChatUsers();

            /*Echo.join('chat').here(user => {
                vm.users = user;
            }).joining(user => {
                vm.users.push(user);
            }).leaving(user => {
                vm.users = vm.users.filter(u => u.id != user.id);
            }).listen('MessageSent', (event) => {
                vm.messages.push(event.message);
            }).listenForWhisper('typing', user => {
                vm.activeUser = user;

                if (vm.typingTimer) {
                    clearTimeout(vm.typingTimer);
                }

                vm.typingTimer = setTimeout(() => {
                    vm.activeUser = false;
                }, 2000);
            });*/
        },
        mounted() {

        },
        props: ['user'],
        methods: {
            getChatUsers() {
                const vm = this;
                axios.get('/get-chat-users').then(response => {
                    vm.chatOrigins = response.data.chatOrigins;
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Obtiene los mensajes del chat
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @return     {[type]}         [description]
             */
            fetchMessages() {
                const vm = this;
                axios.get('/messages').then(response => {
                    vm.messages = response.data;
                }).catch(error => {
                    console.error(error);
                });
            },
            /**
             * Envía el mensaje al usuario
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @return     {[type]}         [description]
             */
            sendMessage() {
                const vm = this;

                if (!vm.newMessage) {
                    /** Si no hay ningún mensaje que enviar no permite agregar texto al chat */
                    return false;
                }

                vm.messages.push({
                    user: vm.user,
                    message: vm.newMessage
                });

                axios.post('/messages', {
                    message: vm.newMessage
                }).then(response => {

                }).catch(error => {
                    console.error(error);
                });

                vm.newMessage = '';
            },
            /**
             * Envía el evento cuando el usuario esta escribiendo
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @return     {[type]}           [description]
             */
            sendTypingEvent() {
                const vm = this;
                Echo.join('chat').whisper('typing', vm.user);
            },
            selectUser(user) {
                this.selectedUser = user;
            }
        },
        watch: {
            /**
             * Modifica los datos globales de acuerdo al usuario seleccionado
             *
             * @author     Ing. Roldan Vargas <roldandvg@gmail.com>
             *
             * @return    {object}        Objeto con datos del usuario seleccionado
             */
            selectedUser: function() {
                const vm = this;
                window.currentUserChat = vm.selectedUser;

                if (vm.selectedUser) {
                    var chat_room_id = vm.selectedUser.chat_room_id || vm.selectedUser.user.chat_room_id;
                    axios.get(`/set-chat-room/${chat_room_id}/${vm.selectedUser.user_id}`).then(response => {
                        if (response.data.result) {
                            $(`#unreaded_${vm.selectedUser.user_id}`).html('');
                        }
                    }).catch(error => {
                        console.log(error);
                    })

                    Echo.join('chat').here(user => {
                        vm.users = user;
                    }).joining(user => {
                        vm.users.push(user);
                    }).leaving(user => {
                        vm.users = vm.users.filter(u => u.id != user.id);
                    }).listen('MessageSent', (event) => {
                        vm.messages.push(event.message);
                    }).listenForWhisper('typing', user => {
                        vm.activeUser = user;

                        if (vm.typingTimer) {
                            clearTimeout(vm.typingTimer);
                        }

                        vm.typingTimer = setTimeout(() => {
                            vm.activeUser = false;
                        }, 2000);
                    });
                    /*Echo.private(`chatroom.${chat_room_id}`).listen('MessageSent', (event) => {
                        vm.messages.push(event.message);
                    });*/
                }
            }
        }
    };
</script>
