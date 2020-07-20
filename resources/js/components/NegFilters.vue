<template>
    <div>
        <!-- Big screens -->
        <div id="lgFiltersBar" class="col-lg-auto d-none d-lg-block">

            <!-- Title & clear button -->
            <div class="row my-1">
                <div class="col-12 d-flex justify-content-between">
                    <div class="search-results text-white">
                        Filtros
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div id="filtersCard" class="card mb-0">
                <perfect-scrollbar>
                    <div class="card-body">

                        <!-- Show -->
                        <div>
                            <div class="multi-range-title pb-75">
                                <h6 class="filter-title mb-0">Ver</h6>
                            </div>
                            <ul class="list-unstyled">
                                <li>
                                    <span class="vs-radio-con vs-radio-success py-25">
                                        <input type="radio" name="seeNegs" v-model="see" :value="true" checked>
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Activas</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-warning py-25">
                                        <input type="radio" name="seeNegs" v-model="see" :value="false">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Archivadas</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="seeNegs" v-model="see" :value="null">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Todas</span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <hr>

                        <!-- Origin -->
                        <div>
                            <div class="multi-range-title pb-75">
                                <h6 class="filter-title mb-0">Origen</h6>
                            </div>
                            <ul class="list-unstyled">
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="originNegs" v-model="owner" :value="null" checked>
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Todas</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="originNegs" v-model="owner" :value="getUserId">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Propias</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="originNegs" v-model="selectOwner" :value="true">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Compartidas</span>
                                    </span>
                                </li>
                                <li v-if="selectOwner">
                                    <select name="cboOwners" @change="chooseOwner($event)" class="form-control col-10">
                                        <option value="null" selected>- Ecoger un propietario -</option>
                                        <option v-for="(o, index) in owners" :key="index" :value="o.id">{{ o.name }}</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <hr>

                        <!-- Contact -->
                        <div id="contacts">
                            <div class="product-category-title">
                                <h6 class="filter-title mb-1">Contactos</h6>
                            </div>
                            <ul class="list-unstyled categories-list">
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="category-filter" @click="resetContactFilter" v-model="selectContact" :value="false" checked>
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Todos</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="category-filter" v-model="selectContact" :value="true">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Escoger</span>
                                    </span>
                                </li>
                                <li v-if="selectContact">
                                    <select name="cboContacts" class="form-control col-10" v-model="contact">
                                        <option :value="null" selected>- Ecoger un contacto -</option>
                                        <option v-for="(c, index) in contacts" :key="index" :value="c.id">{{ c.name }}</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <hr>

                        <!-- Dates -->
                        <div id="dates">
                            <div class="product-category-title">
                                <h6 class="filter-title mb-1">Fecha</h6>
                            </div>
                            <ul class="list-unstyled categories-list">
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoDates" @click="setDateFilter(1)" checked>
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Todas</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoDates" @click="setDateFilter(2)">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Creación</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoDates" @click="setDateFilter(3)">
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Cierre</span>
                                    </span>
                                </li>
                                <li>
                                    <datepicker class="py-25" :bootstrap-styling="true" :language="es" :highlighted="highlighted" placeholder="Escoger una fecha" :format="format" v-model.trim="from" :disabled="disableDatePickers"></datepicker>
                                </li>
                                <li>
                                    <datepicker class="py-25" :bootstrap-styling="true" :language="es" :highlighted="highlighted" placeholder="Escoger una fecha" :format="format" v-model.trim="to" :disabled="disableDatePickers"></datepicker>
                                </li>
                            </ul>
                        </div>
                        <hr>

                        <!-- Status -->
                        <div class="brands">
                            <div class="brand-title mt-1 pb-1">
                                <h6 class="filter-title mb-0">Estado</h6>
                            </div>
                            <div class="brand-list" id="brands">
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between align-items-center py-25" v-for="(status, index) in getStatuses" :key="index">
                                        <span class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox" @click="toggleStatus(status.status)" checked>
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span>
                                                {{status.status}}<i :title="'Negociaciones en ' + status.status" class="ml-1" v-bind:class="classes[status.id]"></i>
                                            </span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>

                        <!-- Import -->
                        <div class="multi-range-price">
                            <div class="multi-range-title pb-75">
                                <h6 class="filter-title mb-0">Importe</h6>
                            </div>
                            <ul class="list-unstyled price-range" id="price-range">
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoAmount" @click="setImportFilter(1)" checked>
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Todos</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoAmount" @click="setImportFilter(2)" >
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Igual a</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoAmount" @click="setImportFilter(3)" >
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Mayor a</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoAmount" @click="setImportFilter(4)" >
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Menor a</span>
                                    </span>
                                </li>
                                <li>
                                    <span class="vs-radio-con vs-radio-primary py-25">
                                        <input type="radio" name="rdoAmount" @click="setImportFilter(5)" >
                                        <span class="vs-radio">
                                            <span class="vs-radio--border"></span>
                                            <span class="vs-radio--circle"></span>
                                        </span>
                                        <span class="ml-50">Rango</span>
                                    </span>
                                </li>
                                <li class="py-25">
                                    <input name="txtAmountFrom" id="txtAmountFrom" v-model.trim="fromImport" type="text" placeholder="Importe" class="form-control" :disabled="disableImport">
                                </li>
                                <li class="py-25">
                                    <input name="txtAmountTo" id="txtAmountTo" v-model.trim="toImport" type="text" placeholder="Importe" class="form-control" :disabled="disableRange">
                                </li>
                            </ul>
                        </div>
                    </div>
                </perfect-scrollbar>
            </div>
        </div>

        <!-- Small screens -->
    </div>
</template>

<script>
import { mapGetters, mapMutations } from 'vuex';
import Datepicker from 'vuejs-datepicker';
import {es} from 'vuejs-datepicker/dist/locale';
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            classes: {
                '1': 'fa fa-trophy text-success',
                '2': 'fa fa-thumbs-o-down text-danger',
                '3': 'feather icon-loader text-primary',
            },
            es: es,
            format: 'dd-MM-yyyy',
            highlighted: {
                dates: [new Date()]
            },
            selectOwner: false,
            selectContact: false,
            disableDatePickers: true,
            disableImport: true,
            disableRange: true,
        }
    },
    methods: {
        ...mapMutations({
            toggleStatus: 'TOGGLE_FILTER_STATUS',
            setCreatedAtFilter: 'SET_CREATED_AT_FILTER',
            setDeadlineFilter: 'SET_DEADLINE_FILTER',
            toggleFilterImport: 'TOGGLE_FILTER_IMPORT',
            setFromAmount: 'SET_FROM_AMOUNT',
            setToAmount: 'SET_TO_AMOUNT'
        }),
        chooseOwner(event) {
            this.getNegFilters.owner = parseInt(event.target.value);
        },
        resetContactFilter() { this.getNegFilters.contact = null; },
        setDateFilter(option) {
            switch (option) {
                case 1:
                    this.setCreatedAtFilter(null);
                    this.setDeadlineFilter(null);
                    this.disableDatePickers = true;
                break;
                case 2:
                    this.setCreatedAtFilter(true);
                    this.setDeadlineFilter(null);
                    this.disableDatePickers = false;
                break;
                case 3:
                    this.setCreatedAtFilter(null);
                    this.setDeadlineFilter(true);
                    this.disableDatePickers = false;
                break;
            }
        },
        setImportFilter(option) {
            switch (option) {
                case 1:
                    this.disableImport = true;
                    this.disableRange = true;
                    this.toggleFilterImport(null);
                break;
                case 2:
                    this.disableImport = false;
                    this.disableRange = true;
                    this.toggleFilterImport('equals');
                break;
                case 3:
                    this.disableImport = false;
                    this.disableRange = true;
                    this.toggleFilterImport('bigger');
                break;
                case 4:
                    this.disableImport = false;
                    this.disableRange = true;
                    this.toggleFilterImport('lower');
                break;
                case 5:
                    this.disableImport = false;
                    this.disableRange = false;
                    this.toggleFilterImport('range');
                break;
            }
        }
    },
    computed: {
        ...mapGetters(['getStatuses', 'getProcesses', 'getOwners', 'getContacts', 'getNegFilters', 'getUserId']),
        see: {
            get() { return this.getNegFilters.see; },
            set(val) { this.getNegFilters.see = val; }
        },
        owner: {
            get() { return this.getNegFilters.owner; },
            set(val) {
                this.selectOwner = false;
                this.getNegFilters.owner = val;
            }
        },
        contact: {
            get() { return this.getNegFilters.contact; },
            set(val) {
                this.getNegFilters.contact = parseInt(val);
            }
        },
        from: {
            get() { return this.getNegFilters.from },
            set(val) { this.getNegFilters.from = val }
        },
        to: {
            get() { return this.getNegFilters.to },
            set(val) { this.getNegFilters.to = val }
        },
        fromImport: {
            get() { return this.getNegFilters.fromAmount },
            set(val) { this.setFromAmount(val) }
        },
        toImport: {
            get() { return this.getNegFilters.toAmount },
            set(val) { this.setToAmount(val) }
        },
        owners() {
            let arr = [];
            this.getOwners.forEach(element => {
                let el = {
                    id: element.id,
                    name: (element.last_name === null) ? element.name : element.name + ' ' + element.last_name,
                }

                arr.push(el);
            });
            return arr;
        },
        contacts() {
            let arr = [];
            this.getContacts.forEach(element => {
                let el = {
                    id: element.id,
                    name: (element.last_name === null) ? element.name : element.name + ' ' + element.last_name,
                }

                arr.push(el);
            });
            return arr;
        }
    },
}
</script>

<style>

</style>