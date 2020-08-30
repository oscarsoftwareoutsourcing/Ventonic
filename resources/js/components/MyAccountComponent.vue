<template>
    <div class="card">
        <div class="alert alert-success" v-if="success">
            <button type="button" class="close text-white" id="dismiss" data-dismiss="alert">&times;</button>
            {{ success }}
        </div>
        <div class="card-content">
            <div class="card-header">
                <h5 class="card-title mb-2">Mi Cuenta</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-label-group">
                            <input type="email" id="email-column" class="form-control" v-model="email"
                                   :class="{'is-invalid': emailError}" placeholder="Correo electrónico">
                            <label for="email-column">Correo</label>
                            <article class="help-block" v-if="emailError">
                                <i class="text-danger">{{ emailError }}</i>
                            </article>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-label-group">
                            <input type="password" id="password-column" class="form-control" v-model="password"
                                   :class="{'is-invalid': passwordError}" placeholder="Contraseña">
                            <label for="password-column">Contraseña</label>
                            <article class="help-block" v-if="passwordError">
                                <i class="text-danger">{{ passwordError }}</i>
                            </article>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-label-group">
                            <input type="password" id="confirmPassword-column" class="form-control"
                                   :class="{'is-invalid': confirmPasswordError}" placeholder="Confirmar contraseña"
                                   v-model="confirmPassword">
                            <label for="confirmPassword-column">Confirmar Contraseña</label>
                            <article class="help-block" v-if="confirmPasswordError">
                                <i class="text-danger">{{ confirmPasswordError }}</i>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" @click="updateAccount">Guardar</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                success: '',
                email: '',
                emailError: '',
                password: '',
                passwordError: '',
                confirmPassword: '',
                confirmPasswordError: ''
            }
        },
        methods: {
            getAccountData() {
                const vm = this;
                axios.get('/get-account-data').then(response => {
                    if (response.data.result) {
                        vm.email = response.data.user.email;
                    }
                }).catch(error => {
                    console.error(error);
                });
            },
            updateAccount() {
                const vm = this;
                vm.emailError = '', vm.passwordError = '', vm.confirmPasswordError = '';

                if (!vm.email) {
                    vm.emailError = 'El campo de correo no debe estar vacio';
                    return false;
                }
                if (vm.password) {
                    if (vm.confirmPassword !== vm.password) {
                        vm.confirmPasswordError = 'Debe confirmar la contraseña';
                    }
                    if (vm.password.length < 8) {
                        vm.passwordError = 'La contraseña debe ser de al menos 8 carácteres';
                    }
                }
                if (!vm.password && vm.confirmPassword) {
                    vm.passwordError = 'Debe indicar la contraseña';
                }

                if (vm.emailError || vm.passwordError || vm.confirmPasswordError) {
                    return false;
                }

                axios.post('/update-account', {
                    email: vm.email,
                    password: vm.password,
                    confirmPassword: vm.confirmPassword
                }).then(response => {
                    if (response.data.result) {
                        vm.success = 'Datos de cuenta actualizados';
                    }
                }).catch(error => {
                    console.error(error);
                });
            }
        },
        mounted() {
            const vm = this;
            vm.getAccountData();
        }
    };
</script>
