<template>
    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label for="remember_at">Recordatorio</label>
                <flat-pickr v-model="remember_at" class="form-control" :config="flatPicker.config"
                            placeholder="dd-mm-yyyy"/>
                <!-- Validation messages -->
                <article class="help-block" v-if="rememberAtError">
                    <i class="text-danger">{{ rememberAtError }}</i>
                </article>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="remember_time">Hora</label>
                <flat-pickr :config="flatPicker.configTime" class="form-control" v-model="remember_time"
                            placeholder="hh:mm" />
                <!-- Validation messages -->
                <article class="help-block" v-if="rememberTimeError">
                    <i class="text-danger">{{ rememberTimeError }}</i>
                </article>
            </div>
        </div>
        <div class="col-sm-3 offset-sm-1">
            <div class="form-group">
                <label for="task_queue_id">Enviar por</label>
                <select id="task_queue_id" class="custom-select" v-model="task_queue_id">
                    <option value="">Seleccione...</option>
                    <option :value="taskQueue" v-for="taskQueue in taskQueues">
                        {{ taskQueue.name }}
                    </option>
                </select>
                <!-- Validation messages -->
                <article class="help-block" v-if="taskQueueIdError">
                    <i class="text-danger">{{ taskQueueIdError }}</i>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                remember_at: '',
                remember_time: '',
                task_queue_id: '',
                rememberAtError: '',
                rememberTimeError: '',
                taskQueueIdError: '',
                taskQueues: []
            }
        },
        methods: {
            reset() {
                const vm = this;

                vm.remember_at = '';
                vm.remember_time = '';
                vm.task_queue_id = '';
                vm.rememberAtError = '';
                vm.rememberTimeError = '';
                vm.taskQueueIdError = '';
            },
            /**
             * Obtiene un listado de colas de tareas
             *
             */
            getTaskQueues() {
                const vm = this;

                axios.get('/components/get-task-queues').then(response => {
                    if (response.data.result) {
                        vm.taskQueues = response.data.taskQueues;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
        },
        mounted() {
            this.getTaskQueues();
        }
    };
</script>
