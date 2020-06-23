<template>
    <a class="d-flex justify-content-between" :href="setLink(unread.data)" @click="markNotificationAsRead">
        <div class="media d-flex align-items-start">
            <div class="media-left">
                <i class="feather font-medium-5 success" :class="setIcon(unread.data)"></i>
            </div>
            <div class="media-body">
                <h6 class="success media-heading">{{ setTitle(unread.data) }}</h6>
                <small class="notification-text">{{ setText(unread.data) }}</small>
            </div>
            <small>
                <time class="media-meta" :datetime="unread.data.time">{{ unread.data.time }}</time>
            </small>
        </div>
    </a>
</template>
<script>
    export default {
        props:['unread'],
        data(){
            return {

            }
        },
        methods: {
            markNotificationAsRead(){
                if(this.unread){
                    axios.get('markAsRead')
                }
           },
            /**
             * Establece el enlace al cual redirigir al hacer click en la notificación
             *
             *
             * @param     {string}    data    Ruta del enlace
             */
            setLink(data) {
                if (!data.link) {
                    return 'oportunitys';
                }
                return data.link;
            },
            /**
             * Establece el ícono de la notificación
             *
             *
             * @param     {string}    data    Clase a utilizar para el ícono de la notificación
             */
            setIcon(data) {
                if (!data.icon) {
                    return 'icon-box';
                }
                return data.icon;
            },
            /**
             * Establece el título de la notificación
             *
             *
             * @param     {string}    data    Título a mostrar en la notificación
             */
            setTitle(data) {
                if (!data.title) {
                    return 'Nuevo Cantidato Inscrito';
                }
                return data.title;
            },
            /**
             * Establece el texto o mensaje de la notificación
             *
             *
             * @param     {string}    data    Mensaje a mostrar en la notificación
             */
            setText(data) {
                if (!data.text) {
                    return data.oportunityName;
                }
                return data.text;
            }
        },
        
        mounted(){
            
        }
    };
</script>
