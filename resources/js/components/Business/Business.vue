<template>
    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <v-client-table :data="rows" :options="options" :columns="columns">
                           <span slot="created_at" slot-scope="{row}">
                               {{ row.created_at | moment }}
                           </span>

                            <span slot="regulado" slot-scope="{row}">
                               <p v-if="row.regulado == 'S'">Si</p>
                               <p v-if="row.regulado == 'N'">No</p>
                           </span>

                            <span slot="precio_regulado" slot-scope="{row}">
                               <p>{{ new Intl.NumberFormat("es-CO",{minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.precio_regulado) }}</p>
                           </span>

                            <span slot="acciones" slot-scope="{row}">
                               <button type="button" class="btn btn-primary btn-sm" @click="openModalEditeMed(row)"
                                       title="Editar">
                                   <i class="fa fa-pen"></i>
                               </button>

                                <!-- >Modal CREAR SUMINISTRO -->
                                <div class="modal fade" id="showModalCreaMed" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">DESEA EDITAR EL MEDICAMENTO <i
                                                    class="fa fa-arrow-right"></i> {{ medicamentoData.nombre_generico }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <form enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="form-group col-md">
                                                                    <label>Código:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.codigo_medicamento = medicamentoData.codigo_medicamento">
                                                                </div>
                                                                <div class="form-group col-md">
                                                                    <label>Código Suministro:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.cod_insumo = medicamentoData.cod_insumo">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md">
                                                                    <label>Nombre Generico:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.nombre_generico = medicamentoData.nombre_generico">
                                                                </div>
                                                                <div class="form-group col-md">
                                                                    <label>Nombre Comercial:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.nombre_comercial = medicamentoData.nombre_comercial">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                 <div class="form-group col-md">
                                                                     <label>Forma Farmaceutica:</label>
                                                                     <v-select :options="formasf"
                                                                              :reduce="descripcion => descripcion.id"
                                                                              v-model="medicamentoToSave.formaf_id"
                                                                              label="descripcion"/>
                                                                </div>
                                                                <!-- <div class="form-group col-md">
                                                                    <label>Presentación:</label>
                                                                    <v-select :options="formasp"
                                                                          :reduce="descripcion => descripcion.id"
                                                                          v-model="medicamentoToSave.formap"
                                                                          label="descripcion"/>
                                                                </div> -->
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md">
                                                                    <label>Presentación Comercial:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.presentacion_comercial = medicamentoData.presentacion_comercial">
                                                                </div>
                                                                <div class="form-group col-md">
                                                                    <label>Pos / NoPos:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.posnopos = medicamentoData.posnopos">
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="form-group col-md">
                                                                    <label>Alto Costo:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.altocosto = medicamentoData.alto_costo">
                                                                </div>
                                                                <div class="form-group col-md">
                                                                    <label>Regulado:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.regulado = medicamentoData.regulado">
                                                                </div>
                                                                <div class="form-group col-md">
                                                                    <label>Precio Regulado:</label>
                                                                    <input class="form-control form-control-sm" type="text"
                                                                           v-model="medicamentoToSave.precio_regulado = moneyFormat">
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cerrar</button>
                                                <button type="button" class="btn btn-warning btn-sm"
                                                        @click="clearFieldSaveNegotiations()">
                                                    <i class="fa fa-brush"></i> Limpiar</button>
                                                <button type="button" class="btn btn-success btn-sm"
                                                        @click="saveNegotiations()">
                                                    <i class="fa fa-save"></i> Guardar Negociación</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
        name: "Business",
        data() {
            return {
                lastMedId: 0,
                formasf: [],
                formasp: [],
                errorsCount: 0,
                errorsForm: [],
                rows: [],
                columns: [
                    'nombre_generico',
                    'nombre_comercial',
                    'cod_insumo',
                    'FFARMACEUTICA',
                    'FPRESENTACION',
                    'presentacion_comercial',
                    'posnopos',
                    'altocosto',
                    'regulado',
                    'precio_regulado',
                    'posnopos',
                    'created_at',
                    'acciones'
                ],
                options: {
                    headings: {
                        nombre_generico: 'Nombre Generico',
                        nombre_comercial: 'Nombre Comercial',
                        cod_insumo: 'Código Hosvital',
                        FFARMACEUTICA: 'Forma Farmacéutica',
                        FPRESENTACION: 'Forma Presentación',
                        presentacion_comercial: 'Presentacion Comercial',
                        posnopos: 'Pos / NoPos',
                        altocosto: 'Alto Costo',
                        regulado: 'Regulado',
                        precio_regulado: 'Precio Regulado',
                        created_at: 'Fecha Creación',
                        acciones: 'Operaciones'
                    }
                },
                medicamentoData: {},
                medicamentoToSave: {}
            }
        },
        computed: {
            moneyFormat: function () {
                return new Intl.NumberFormat("es-CO", {
                    minimumSignificantDigits: 1,
                    style: "currency",
                    currency: "COP"
                }).format(this.medicamentoData.precio_regulado);
            }
        },
        filters: {
            moment: function (date) {
                return moment(date).format("LLLL");
            },
        },
        methods: {
            getAllMedicamento() {
                let me = this;
                let url = 'http://190.131.222.108:8085/getmedicamentodata';

                axios
                    .get(url)
                    .then(res => {
                        me.rows = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getFormaFarmaceutica() {
                let me = this;
                let url = "http://190.131.222.108:8085/getformafarmaceutica";
                axios
                    .get(url)
                    .then(res => {
                        me.formasf = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getFormaPresentacion() {
                let me = this;
                let url = "http://190.131.222.108:8085/getformapresentacion";
                axios
                    .get(url)
                    .then(res => {
                        me.formasp = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getLastMedId() {
                let me = this;
                let url = "http://190.131.222.108:8085/getlastmedid";

                axios
                    .get(url)
                    .then(res => {
                        me.lastMedId = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            openModalEditeMed(item) {
                $('#showModalCreaMed').modal('show');
                this.medicamentoData = item;
                this.medicamentoToSave.formaf_id = item.IDFFARMACEUTICA;
            },
            closemodalEditMed() {
                $('#showModalCreaMed').modal('hide');
            }
        },
        created() {
            this.getLastMedId();
            this.getAllMedicamento();
            this.getFormaFarmaceutica();
            this.getFormaPresentacion();
        }
    }
    
</script>

<style scoped>
</style>
