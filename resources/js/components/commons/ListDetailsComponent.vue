<template>
    <div :id="'accordion'+idComponent" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" :id="'headingAccordion'+idComponent">
                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="panel-title text-left">
                            <a data-toggle="collapse" :data-parent="'#accordion'+idComponent"
                               :href="'#collapseAccordion'+idComponent" aria-expanded="true"
                               :aria-controls="'collapseAccordion'+idComponent">
                                Vista detallada
                            </a>
                        </h6>
                    </div>
                    <!--<div class="col-sm-6">
                        <h6 class="panel-title text-right">
                            <a href="javascript:void(0)">
                                <i class="fa fa-cogs"></i> Más opciones
                            </a>
                        </h6>
                    </div>-->
                </div>
            </div>
            <div :id="'collapseAccordion'+idComponent" role="tabpanel" :aria-labelledby="'headingAccordion'+idComponent"
                 class="panel-collapse collapse in float-none collapse show">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                records: []
            }
        },
        props: {
            /** @type {Object} URL de consulta para obtener el listado de registros */
            listUrl: {
                type: String,
                required: true
            },
            /** @type {Object} Muestra u oculta, por defecto, la lista de detalles */
            showList: {
                type: Boolean,
                required: false,
                default: true
            },
            /** @type {Object} Nombre que identifique el componente como único */
            idComponent: {
                type: String,
                required: false,
                default: 'GenericComponent'
            }
        },
        methods: {
            /**
             * Obtiene los registros a mostrar en la lista de detalles
             *
             * @author     Ing. Roldan Vargas <rolvar@softwareoutsourcing.es> | <roldandvg@gmail.com>
             */
            getRecords() {
                const vm = this;
                axios.get(vm.listUrl).then(response => {
                    if (response.data.result) {
                        vm.records = response.data.records;
                    }
                }).catch(error => {
                    console.error(error);
                });
            }
        }
    };
</script>
