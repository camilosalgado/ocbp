<template>
    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="m-0 font-weight-bold text-primary">Medicamentos</h6>
                            </div>
                            <div class="col-md-4 text-right">
                                <button class="btn btn-sm btn-primary" @click="ChangeStateCreateMed()">
                                    <i class="fa fa-plus-circle"> Crear Medicamento</i>
                                </button>
                                <button class="btn btn-sm btn-primary" :disabled="disabled">
                                    <i class="fa fa-chart-line"> HTX</i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- SELECT MEDICAMENTO CREADO ANTERIORMENTE -->
                            <div class="col-md-12" v-show="!stateCreateMed">
                                <div class="form-group">
                                    <label>
                                        <i class="fa fa-search"></i> Buscar Medicamento:
                                    </label>
                                    <v-select :options="rows" :reduce="nombre_generico => nombre_generico.id" v-model="selectedItem" label="nombre_generico" />
                                </div>
                            </div>

                            <!-- FORM CREAR MEDICAMENTO -->
                            <div class="col-md-12" v-show="stateCreateMed">
                                <form enctype="multipart/form-data" class="user">
                                    <div class="row">
                                        <div class="form-group">
                                            <input type="text" style="display: none" class="form-control form-control-sm" disabled placeholder="Codigo...." v-model="medicamentos.codigo_medicamento = this.lastMedId">
                                        </div>
                                        <div class="form-group col-md">
                                            <label>Nombre Genérico:</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Nombre Genérico" v-model="medicamentos.nombre_generico">
                                        </div>
                                        <div class="form-group col-md">
                                            <label>Nombre Comercial:</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Nombre Comercial" v-model="medicamentos.nombre_comercial">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Forma Farmaceutica:</label>
                                            <v-select :options="formasf" :reduce="descripcion => descripcion.id" v-model="medicamentos.id_formaf" label="descripcion" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Concentración:</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Concentración" v-model="medicamentos.concentracion">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Presentación:</label>
                                            <v-select :options="formasp" :reduce="descripcion => descripcion.id" v-model="medicamentos.id_formap" label="descripcion" />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Cantidad:</label>
                                            <input type="text" @input="validateOnlyNumber()" class="form-control form-control-sm" placeholder="Cantidad" v-model="medicamentos.cantidad">
                                        </div>
                                    </div>

                                    <!-- ALTO COSTO & REGULADO -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for>Alto Costo:</label>

                                                <div class="custom-control custom-radio custom-control-solid">
                                                    <input class="custom-control-input" id="customRadioAltoCosto1" value="1" type="radio" v-model="medicamentos.alto_costo"/>
                                                    <label class="custom-control-label" for="customRadioAltoCosto1">Si</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-solid">
                                                    <input class="custom-control-input" id="customRadioAltoCosto2" value="0" type="radio" v-model="medicamentos.alto_costo"/>
                                                    <label class="custom-control-label" for="customRadioAltoCosto2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for>Regulado:</label>

                                                <div class="custom-control custom-radio custom-control-solid">
                                                    <input class="custom-control-input" id="customRadioRegulado1" value="1" type="radio" v-model="medicamentos.regulado"/>
                                                    <label class="custom-control-label" for="customRadioRegulado1">Si</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-solid">
                                                    <input class="custom-control-input" id="customRadioRegulado2" value="0" type="radio" v-model="medicamentos.regulado"/>
                                                    <label class="custom-control-label" for="customRadioRegulado2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr v-if="errorsCount">
                                    <!-- ERRORES -->
                                    <div class="row" v-if="errorsCount">
                                        <div class="col-md-12">
                                            <div class="form-group" >
                                                <ul>
                                                    <li v-for="error in errorsForm">{{ error }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" v-show="stateCreateMed">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button @click.prevent.self="clearFieldCreateMed()" class="btn btn-warning btn-sm">
                                    <i class="fa fa-brush"></i> Limpiar
                                </button>
                                <button class="btn btn-primary btn-sm" @click="createMedicamento()">
                                    <i class="fa fa-save"></i> Guardar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12">

                <div class="card shadow mb-4" v-show="selectedItem">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-9">
                                <h6 class="m-0 font-weight-bold text-primary">Negociaciones</h6>
                            </div>
                            <div class="col-md-3 text-right">
                                <button type="button" class="btn btn-primary btn-sm" @click="openModalNegotiations(selectedItem)">
                                    <i class="fa fa-dollar-sign"></i> Crear negociación
                                </button>

                                <!-- Modal CREAR NEGOCIACION -->
                                <div class="modal fade" id="showModalNegotiations" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">NEGOCIANDO CON {{ negotiationsData.nombre_generico }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form enctype="multipart/form-data" class="user text-left">
                                                    <!--DATOS BASICOS DEL MEDICAMENTO -->
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="codigomedicamento">Codigo Medicamento:</label>
                                                                <input class="form-control form-control-sm" type="text" placeholder="Codigo Medicamento" readonly id="codigomedicamento" v-model="negotiationsDataToSave.cod_med = negotiationsData.codigo_medicamento" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label for="nombregenerico">Nombre Genérico:</label>
                                                            <input class="form-control form-control-sm" type="text" readonly id="nombregenerico" placeholder="Nombre Genérico" v-model="negotiationsData.nombre_generico" />
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label for="nombrecomercial">Nombre Comercial:</label>
                                                            <input class="form-control form-control-sm" type="text" readonly id="nombrecomercial" placeholder="Nombre Comercial" v-model="negotiationsData.nombre_comercial" />
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md">
                                                            <label for="embalaje">Forma Farmaceutica:</label>
                                                            <input class="form-control form-control-sm" type="text" readonly v-model="negotiationsData.embalaje" id="embalaje" placeholder="Forma Farmaceutica" />
                                                        </div>
                                                        <div class="col-md">
                                                            <label for="">Concentración:</label>
                                                            <input class="form-control form-control-sm" type="text" v-model="negotiationsData.concentracion" readonly placeholder="Nombre Comercial" />
                                                        </div>
                                                        <div class="col-md">
                                                            <label for="">Presentacion Comercial:</label>
                                                            <input class="form-control form-control-sm" type="text" v-model="negotiationsData.presentacion_comercial" readonly placeholder="Nombre Comercial" />
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Seleccione el laboratorio de la Negociación:</label>
                                                                <v-select :options="laboratorios" :reduce="razon_social => razon_social.id" v-model="negotiationsDataToSave.lab_id" label="razon_social" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Valor Propuesto:</label>
                                                                <input type="text" class="form-control form-control-sm" v-model="negotiationsDataToSave.valor_propuesta" placeholder="Ingrese el valor de la propuesta">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>Observación de descuento:</label>
                                                                <input type="text" class="form-control form-control-sm" v-model="negotiationsDataToSave.obs_descuento" placeholder="Ingrese la Observación de descuento">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Precio regulado:</label>
                                                                <input type="text" class="form-control form-control-sm" v-model="negotiationsDataToSave.precio_regulado" placeholder="Valor precio regulado">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Valor negociación:</label>
                                                                <input type="text" class="form-control form-control-sm" v-model="negotiationsDataToSave.valor_negociacion" placeholder="Ingrese el valor de la negociación">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Utilidad:</label>
                                                                <input type="text" class="form-control form-control-sm" readonly v-model="negotiationsDataToSave.utilidad = utilidad" placeholder="Valor Utilidad">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                    <i class="fa fa-times"></i> Cerrar</button>
                                                <button type="button" class="btn btn-warning btn-sm" @click="clearFieldSaveNegotiations()">
                                                    <i class="fa fa-brush"></i> Limpiar</button>
                                                <button type="button" class="btn btn-success btn-sm" @click="saveNegotiations()">
                                                    <i class="fa fa-save"></i> Guardar Negociación</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row" v-animate-css="'fadeIn'">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre comercial</th>
                                    <th scope="col">Nombre genérico</th>
                                    <th scope="col">Laboratorio</th>
                                    <th scope="col">$ Propuesta</th>
                                    <th scope="col">$ Negociación</th>
                                    <th scope="col">$ Utilidad</th>
                                    <th scope="col">Fecha Negociación</th>
                                    <th scope="col">Aprobado a Farmacia</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="n in negotiationsArray" :key="n.created_at">
                                    <td v-text="n.nombre_comercial"></td>
                                    <td v-text="n.nombre_generico"></td>
                                    <td v-text="n.razon_social"></td>
                                    <td v-text="n.valor_propuesta"></td>
                                    <td v-text="n.valor_negociacion"></td>
                                    <td v-text="n.utilidad"></td>
                                    <td>{{ n.fec_nego | moment }}</td>
                                    <td>
                                        <i v-if="n.aprobacion_farmacia == 1" class="fa fa-circle" style="color: green !important;"></i>
                                        <i  v-else-if="n.aprobacion_farmacia == 0" class="fa fa-circle" style="color: red !important;"></i>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{ getNegByMed }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Business",
        data() {
            return{
                disabled: true,
                rows: [],
                formasf: [],
                formasp: [],
                laboratorios: [],
                selectedItem: 0,
                stateCreateMed: false,
                lastMedId: 0,
                medicamentos: {},
                errorsCount: 0,
                errorsForm: [],
                showModal: false,
                negotiationsData: {},
                negotiationsDataToSave: {
                    valor_propuesta: 0,
                    precio_regulado: 0,
                    valor_negociacion: 0,
                    utilidad: 0
                },
                negotiationsArray: []
            }
        },
        computed: {
            getNegByMed: function() {
                if(this.selectedItem) {
                    this.getNegotiantiosByMed(this.selectedItem);
                }
            },
            utilidad: function() {
                return this.negotiationsDataToSave.precio_regulado - this.negotiationsDataToSave.valor_negociacion;
            }
        },
        filters: {
            moment: function(date) {
                return moment(date).format("LLL");
            }
        },
        methods: {
            ChangeStateCreateMed() {
                this.selectedItem = '';
                this.stateCreateMed = !this.stateCreateMed;
            },
            getAllMedicamento() {
                let me = this;
                let url = "http://laravel.local/getmedicamentotoneg";
                axios
                    .get(url)
                    .then(res => {
                        me.rows = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            getFormaFarmaceutica() {
                let me = this;
                let url = "http://laravel.local/getformafarmaceutica";
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
                let url = "http://laravel.local/getformapresentacion";
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
                let url = "http://laravel.local/getlastmedid";

                axios
                    .get(url)
                    .then(res => {
                        me.lastMedId = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getLabs() {
                let me = this;
                let url = "http://laravel.local/getlaboratorios";
                axios
                    .get(url)
                    .then(res => {
                        me.laboratorios = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },
            createMedicamento() {
                let me = this;
                let url = "http://laravel.local/savemedicamento";

                if (this.validateForm()) {
                    return;
                }

                axios
                    .post(url, me.medicamentos)
                    .then(res => {
                        me.clearFieldCreateMed();
                        me.getAllMedicamento();
                        me.stateCreateMed = false;
                    })
                    .catch(err => {
                        console.log(err);
                    })

            },
            validateForm() {
                let me = this;
                let errorsCount = 0;
                let errorsForm =[];

                if(!me.medicamentos.nombre_generico) {
                    me.errorsForm.push('Ingrese el nombre Genérico');
                }
                if(!me.medicamentos.nombre_comercial) {
                    me.errorsForm.push('Ingrese el nombre Comercial');
                }
                if(!me.medicamentos.concentracion) {
                    me.errorsForm.push('Ingrese la Concentración del Insumo');
                }

                if(me.errorsForm.length > 0) me.errorsCount = me.errorsForm.length;

                return me.errorsCount;
            },
            validateOnlyNumber() {
                let me = this;
                me.medicamentos.cantidad = me.medicamentos.cantidad.replace(/[^0-9]/g,'');
            },
            openModalNegotiations(item) {
                let me = this;
                let url = "http://laravel.local/getdatamedtonegotiations/" + item;

                $("#showModalNegotiations").modal("show");

                if(item) {
                    axios.
                    get(url)
                        .then(res => {
                            me.negotiationsData = res.data[0];
                        })
                        .catch(err => {
                            console.log(err);
                        })
                }
            },
            getNegotiantiosByMed(item) {
                let me = this;
                let url = "http://laravel.local/getnegotiations/"+ item;

                axios
                    .get(url)
                    .then(res => {
                        me.negotiationsArray = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            saveNegotiations() {
                let me = this;
                let url = "http://laravel.local/savenegotiations";

                axios
                    .post(url, me.negotiationsDataToSave)
                    .then(res => {
                        me.negotiationsArray.push(res.data.negociacion[0]);
                        me.clearFieldSaveNegotiations();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            clearFieldSaveNegotiations() {
                this.negotiationsDataToSave.lab_id = '';
                this.negotiationsDataToSave.valor_propuesta = 0;
                this.negotiationsDataToSave.obs_descuento = '';
                this.negotiationsDataToSave.precio_regulado = 0;
                this.negotiationsDataToSave.valor_negociacion = 0;
            },
            clearFieldCreateMed() {
                this.medicamentos.nombre_generico = '';
                this.medicamentos.nombre_comercial = '';
                this.medicamentos.id_formaf = '';
                this.medicamentos.id_formap = '';
                this.medicamentos.cantidad = '';
                this.medicamentos.alto_costo = '';
                this.medicamentos.regulado = '';
                this.medicamentos.concentracion ='';
                this.errorsForm = [];
                this.getLastMedId();
            }
        },
        mounted() {
            this.getAllMedicamento();
            this.getFormaFarmaceutica();
            this.getFormaPresentacion();
            this.getLastMedId();
            this.getLabs();
        }
    }
</script>

<style scoped>

</style>
