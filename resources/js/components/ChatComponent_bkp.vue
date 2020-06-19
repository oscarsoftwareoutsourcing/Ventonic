<template>
 <div class="content-area-wrapper">
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
                                <img class="media-object rounded-circle" :src="user.photo" height="42" width="42" v-if="user.photo">
                                <img src="/images/anonymous-user.png" class="media-object rounded-circle" alt="photo" height="42" width="42" v-else>
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
                    <div class="content-header row">
                    </div>
                    
                    <div class="content-body">
                        <div class="chat-overlay"></div>

                        <section class="chat-app-window">
                            
                            <div class="active-chat">
                                <div class="chat_navbar">
                                    <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                        <div class="vs-con-items d-flex align-items-center">
                                            <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                            <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                
                                                <span class="avatar-status-busy"></span>
                                            </div>
                                            <h6 class="mb-0"></h6>
                                            <span class="text-muted" v-if="activeUser">{{ activeUser.name }} esta escribiendo...</span>
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
                                    class="form-control emoji-picker message mr-1 ml-50" v-model="newMessage" @keyup.enter="sendMessage"
                                    @keydown="sendTypingEvent">
                                        
                                    </div>
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
                typingTimer: false
            }
        },
        created() {
            const vm = this;
            vm.fetchMessages();

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
        },
        props: ['user'],
        methods: {
            /**
             * Obtiene los mensajes del chat
             *
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
             *
             * @return     {[type]}         [description]
             */
            sendMessage() {
                const vm = this;

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
             *
             * @return     {[type]}           [description]
             */
            sendTypingEvent() {
                const vm = this;
                Echo.join('chat').whisper('typing', vm.user);
            }
        }
    };
</script>
