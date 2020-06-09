<template>
<a class="d-flex justify-content-between" :href="postulationdUrl" @click="markNotificationAsRead">
    <div class="media d-flex align-items-start">
        <div class="media-left"><i class="feather icon-box font-medium-5 success"></i></div>
        <div class="media-body">
            <h6 class="success media-heading">Nuevo Cantidato Inscrito</h6>
            <small class="notification-text">{{unread.data.oportunityName}}</small>
        </div><small>
        <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">{{unread.data.time}}</time></small>
    </div>
</a>
</template>
<script>
    export default {
        props:['unread'],
        data(){
            return{
                postulationdUrl:""
            }
        },
        mounted(){
            this.postulationdUrl="oportunitys";
        }
    }
</script>
