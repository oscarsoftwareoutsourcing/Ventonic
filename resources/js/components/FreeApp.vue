<template>
    <div>
        <div class="content-area-wrapper">
            <section id="basic-examples">
                <div class="row match-height">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-content">
                                <img class="card-img-top img-fluid" :src="'images/pages/content-img-1.jpg'"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5>Vuexy Admin</h5>
                                    <p class="card-text  mb-0">By Pixinvent Creative Studio</p>
                                    <span class="card-text">Elite Author</span>
                                    <div class="card-btns d-flex justify-content-between mt-2">
                                        <a class="btn gradient-light-primary text-white" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#inlineForm">Entrar</a>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Widget Wizard</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form-wizard @on-complete="onComplete" @on-error="handleErrorMessage" color="#7367F0"  finish-button-text="Generate Widget">
                                    <tab-content title="Step 1" icon="feather icon-home"
                                        >
                                        Get Seller PIN
                                    </tab-content>
                                    <tab-content title="Step 2" icon="feather icon-briefcase" :before-change="beforeTabSwitch">
                                        <input v-model="pin" type="text" class="form-control col-md-4" placeholder="Enter your Seller PIN here">
                                        
                                    </tab-content>
                                    <tab-content title="Step 3" icon="feather icon-image">
                                        Generate Widget
                                    </tab-content>
                                    <div v-if="errorMsg">
                                        <span class="danger">{{errorMsg}}</span>
                                    </div>
                                </form-wizard>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <widget-wizard></widget-wizard>
    </div>
</template>
<script>
    const widgetWizard = () => import( /* webpackChunkName: "widget-wizard" */ './WidgetWizard.vue');
    import VueFormWizard from 'vue-form-wizard'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Axios from 'axios';
    Vue.use(VueFormWizard)

    export default {
        name: 'FreeApp',
        components: {
            'widget-wizard': widgetWizard,

        },
        data() {
            return {
                pin:'',
                errorMsg: null,
            }
        },

        methods: {
            ShowWizard() {
                console.log('Hello World')
            },
            onComplete() {
                alert('Yay. Done!');
            },
            handleErrorMessage: function(errorMsg){
                this.errorMsg = errorMsg
            },
            beforeTabSwitch() {
                 return new Promise((resolve, reject) => {
                   const vm = this;

                    if(vm.pin !=''){
                        axios
                        .get("/validate-pin/"+vm.pin) 
                        .then(response => {
                            console.log(response);
                            if(response.data.found == 1){
                                resolve(true);
                            }else{
                                reject("Pin validation Failed");
                            }
                        });
                    }else{
                        reject("Pin validation Failed");
                    }
                })
                 
                
                
            }



        }
    }

</script>
<style scoped>
    .cardModal {
        background-color: #262C49;
    }

    /* .wizard-icon-container{
        background-color: #7367F0;
    } */

    .wizard-tab-container{
        color: whitesmoke;
    }

</style>
