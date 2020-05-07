<template>

    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div class="card shadow mb-4" v-animate-css="'fadeIn'">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Asociar Medicamento con Hosvital</h6>
                    </div>
                    <div class="card-body">
                        <form enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Medicamento Local:</label>
                                        <v-select :options="rowsm" :reduce="nombre_generico => nombre_generico.id" v-model="enlace.item1" label="nombre_generico" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Medicamento Hosvital:</label>
                                        <v-select :options="rowshosvital" v-model="enlace.item2" label="DESCRIPCION" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-12 text-right">
                            <div class="form-group">
                                <button class="btn btn-sm btn-warning">
                                    <i class="fa fa-brush"></i> Limpiar
                                </button>
                                <button class="btn btn-sm btn-success" @click="saveLinkedMedicamento()">
                                    <i class="fa fa-link"></i> Asociar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-12">
                <div class="card shadow mb-4" v-animate-css="'fadeIn'">
                    <div class="card-body">
                        <v-client-table :options="options" :columns="columns" :data="rows">
                            <span slot="FENLACE" slot-scope="{row}">
                                {{ row.FENLACE | moment }}
                            </span>
                        </v-client-table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "AsociacionHovital",
        data() {
            return  {
                rowsm: [],
                rowshosvital: [],
                rows: [],
                columns: [
                    'CMEDICAMENTO',
                    'NGENERICO',
                    'HCODIGO',
                    'HDESCRIPCION',
                    'HNGENERICO',
                    'FENLACE'
                ],
                options: {
                    headings: {
                        CMEDICAMENTO: 'CodigoLocal',
                        HCODIGO: 'Codigo Hosvital',
                        FENLACE: 'Fecha Enlace'
                    },
                    sortable: ['NGENERICO', 'CMEDICAMENTO', 'HCODIGO', 'HDESCRIPCION', 'HNGENERICO', 'FENLACE'],
                    filterable: ['NGENERICO', 'CMEDICAMENTO', 'HCODIGO', 'HDESCRIPCION', 'HNGENERICO', 'FENLACE'],
                    perPage: 6
                },
                enlace: {}
            }
        },
        filters: {
            moment: function(date) {
                return moment(date).format("LLLL");
            }
        },
        methods: {
            getAllMedicamentoMakquia() {
                let me = this;
                let url = "http://laravel.local/getmedicamentodata";
                axios
                    .get(url)
                    .then(res => {
                        me.rowsm = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getAllMedicamentoHosvital() {
                let me = this;
                let url = "http://ocbp.hosvital.api/api/v1/medicamentosparaenlace";
                axios
                    .get(url)
                    .then(res => {
                        me.rowshosvital = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getLinkedMedicamentos() {
                let me = this;
                let url = "http://laravel.local/getlinkedmedicamentos";

                axios
                    .get(url)
                    .then(res => {
                        me.rows = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            saveLinkedMedicamento() {
                let me = this;
                let url = "http://laravel.local/savelinkedmedicamentos";

                axios
                    .post(url, me.enlace)
                    .then(res => {
                        me.getLinkedMedicamentos();
                        me.enlace.item1 = null;
                        me.enlace.item2 = null;
                    })
                    .catch(err =>{
                        console.log(err);
                    })
            }
        },
        created() {
            this.getAllMedicamentoMakquia();
            this.getAllMedicamentoHosvital();
            this.getLinkedMedicamentos();
        }
    }
</script>

<style scoped>

</style>
