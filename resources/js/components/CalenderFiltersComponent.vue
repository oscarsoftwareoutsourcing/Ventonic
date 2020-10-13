<template>
    <div class="col-3" v-if="showListFilters">
        <div class="card">
            <div class="card-header">
                <h6>Mis Calendarios</h6>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group"><!--  list-group-my-calendars -->
                                <li class="list-group-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input filter-calendar" id="checkVentonic"
                                               @click="checkCalendar" value='0'>
                                        <label class="custom-control-label" for="checkVentonic">Ventonic</label>
                                    </div>
                                </li>
                                <li class="list-group-item" v-for="calendar in calendars">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input filter-calendar" :id="'check'+calendar.id"
                                               @click="checkCalendar" :value='calendar.google_id'>
                                        <label class="custom-control-label" :for="'check'+calendar.id">
                                            {{ calendar.name }}
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
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
                showListFilters: false,
                calendars: []
            }
        },
        methods: {
            checkCalendar() {
                const vm = this;
                vm.$root.$refs.calendarSetting.checkCalendar();
            }
        },
        created() {
            const vm = this;
            axios.get("/has-calendars").then((response) => {
                if (response.data.result && response.data.gCalendar) {
                    vm.$root.$refs.calendarSetting.hasCalendars = response.data.hasCalendars;
                    vm.$root.$refs.calendarSetting.configuredCalendars.gCalendar = response.data.gCalendar;
                    vm.$root.$refs.calendarSetting.appCalendar = "gCalendar";
                    //vm.syncEvents();
                    vm.showListFilters = response.data.hasCalendars;
                    vm.$root.$refs.calendarSetting.getCalendars();

                    if (vm.showListFilters) {
                        $('.col-calendar').removeClass('col-12').addClass('col-9');
                    } else {
                        $('.col-calendar').removeClass('col-9').addClass('col-12');
                    }
                }
                vm.$root.$refs.calendarSetting.showCalendars();
            })
            .catch((error) => {
                console.error(error);
            });
        }
    };
</script>
