<template>
  <li class="dropdown dropdown-notification nav-item" id="navNotification">
    <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
      <i class="ficon feather icon-bell"></i>
      <span class="badge badge-pill badge-primary badge-up">{{unreadNotifications.length}}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
      <li class="dropdown-menu-header">
        <div class="dropdown-header m-0 p-2">
          <h3 class="white">{{unreadNotifications.length}}</h3>
          <span class="notification-title">Nuevas notificationes</span>
        </div>
      </li>
      <li class="scrollable-container media-list">
        <notification-item
          v-for="(unread, index) in unreadNotifications"
          :unread="unread"
          :key="index"
        ></notification-item>
      </li>
      <li class="dropdown-menu-footer">
        <a
          class="dropdown-item p-1 text-center"
          href="javascript:void(0)"
        >Ver todas las notificaciones</a>
      </li>
    </ul>
  </li>
</template>

<script>
import NotificationItem from "./NotificationItemComponent.vue";
export default {
  props: ["unreads", "userid"],
  // components:{NotificationItem},
  data() {
    return {
      unreadNotifications: this.unreads
    };
  },
  watch: {
    unreadNotifications: function() {
      const vm = this;
      vm.chatMenuNotifications();
    }
  },
  methods: {
    markNotificationAsRead() {
      if (this.unreadNotifications.length) {
        axios.get("markAsRead");
      }
    },
    /**
     * Filtra las notificaciones provenientes del chat para mostrarlas en la opción del menú lateral
     */
    chatMenuNotifications() {
      const vm = this;
      //condición para mostrar notificaciones sin leer en el menú de la izquierda
      var chatCount = vm.unreadNotifications.filter(notification => {
        return notification.data.icon === "icon-message-square";
      }).length;

      if (chatCount > 0) {
        $(".chat-menu-notifications").text(chatCount);
        $(".chat-menu-notifications").removeClass("d-none");
      } else {
        $(".chat-menu-notifications").text("");
        $(".chat-menu-notifications").addClass("d-none");
      }
    }
  },
  mounted() {
    const vm = this;

    Echo.private("App.User." + vm.userid).notification(notification => {
      let newUnreadNotifications = { data: notification };
      vm.unreadNotifications.push(newUnreadNotifications);
    });

    vm.chatMenuNotifications();

    /** Evento que actualiza el tiempo de las notificaciones */
    $("#navNotification").on("mouseenter", function(e) {
      vm.unreadNotifications.forEach(unread => {
        axios
          .post("/notification-time/update", {
            id: unread.id
          })
          .then(response => {
            /** @type {string} Actualiza el tiempo a mostrar desde que se generó la notificación */
            unread.data.time = response.data.time;
          })
          .catch(error => {
            console.error(error);
          });
      });
    });
  }
};
</script>
