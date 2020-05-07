<template>
    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <!-- Crear Medicamento -->
            <div class="col-xl-12 col-md-12">
                <button class="btn btn-primary btn-sm float-right" type="button" @click="showCreateMedModal()">
                    <i class="fa fa-plus-circle"></i> Crear Suministro
                </button>

                <!-- Modal Crear Medicamento-->
                <div class="modal fade" id="modalCreateMedicamento" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">USTED ESTA CREANDO: {{
                                    medicamentoNego.nombre_generico | uppercase }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                        @click="closeModalCreateMed()">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- FORM CREAR MEDICAMENTO -->
                                        <form enctype="multipart/form-data" class="user">
                                            <div class="row">
                                                <div class="col-md-10" style="border-right: 1px solid #dee2e6;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" style="display: none"
                                                                       class="form-control form-control-sm" disabled
                                                                       v-model="medicamentoNego.codigo_medicamento = this.lastMedId">

                                                                <label>Nombre Genérico:</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       placeholder="Nombre Genérico"
                                                                       v-model="medicamentoNego.nombre_generico">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Nombre Comercial:</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       placeholder="Nombre Comercial"
                                                                       v-model="medicamentoNego.nombre_comercial">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>Forma Farmaceutica:</label>
                                                                <v-select :options="formasf"
                                                                          :reduce="descripcion => descripcion.id"
                                                                          v-model="medicamentoNego.id_formaf"
                                                                          label="descripcion"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Concentración:</label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                       placeholder="Concentración"
                                                                       v-model="medicamentoNego.concentracion">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label>Presentación:</label>
                                                                <v-select :options="formasp"
                                                                          :reduce="descripcion => descripcion.id"
                                                                          v-model="medicamentoNego.id_formap"
                                                                          label="descripcion"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Cantidad:</label>
                                                                <input type="number"
                                                                       class="form-control form-control-sm"
                                                                       placeholder="Cantidad"
                                                                       v-model="medicamentoNego.cantidadMed">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr v-if="errorsCount">
                                                    <!-- ERRORES -->
                                                    <div class="row" v-if="errorsCount">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <ul>
                                                                    <li v-for="error in errorsForm">{{ error }}</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <!--REGULADO -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group"
                                                                 style="margin-bottom: 0 !important;">
                                                                <label for>Regulado:</label>
                                                                <br>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="inlineRadioOptions"
                                                                           id="customRadioRegulado1" value="S"
                                                                           v-model="medicamentoNego.regulado">
                                                                    <label class="form-check-label"
                                                                           for="customRadioRegulado1">Si</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                           name="inlineRadioOptions"
                                                                           id="customRadioRegulado2" value="N"
                                                                           v-model="medicamentoNego.regulado">
                                                                    <label class="form-check-label"
                                                                           for="customRadioRegulado2">No</label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                                <!-- DESEA NEGOCIAR? -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success btn-sm" @click="deseaNegociar">
                                            <i class="fa fa-briefcase-medical"></i> Desea Negociar ?
                                        </button>
                                    </div>
                                </div>

                                <hr v-show="medicamentoNego.deseanegociar">

                                <!-- FORM NEOGIACIÓN -->
                                <div class="row" v-show="medicamentoNego.deseanegociar">
                                    <div class="col-md-12">
                                        <form enctype="multipart/form-data" class="user text-left">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Seleccione el laboratorio de la Negociación:</label>
                                                        <v-select :options="laboratorios"
                                                                  :reduce="razon_social => razon_social.id"
                                                                  v-model="medicamentoNego.lab_id"
                                                                  label="razon_social"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Valor Propuesto:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               v-model="medicamentoNego.valor_propuesta"
                                                               placeholder="Ingrese el valor de la propuesta">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Observación de descuento:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               v-model="medicamentoNego.obs_descuento"
                                                               placeholder="Ingrese la Observación de descuento">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Valor negociación:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               v-model="medicamentoNego.valor_negociacion"
                                                               placeholder="Ingrese el valor de la negociación">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Utilidad:</label>
                                                        <input type="text" class="form-control form-control-sm" readonly
                                                               v-model="medicamentoNego.utilidad = utilidad"
                                                               placeholder="Valor Utilidad">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cantidad:</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                               v-model="medicamentoNego.cantidadNeg"
                                                               placeholder="Cantidad">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary btn-sm"
                                                @click.prevent="closeModalCreateMed()">
                                            <i class="fa fa-times"></i> Cerrar
                                        </button>

                                        <button @click.prevent.self="clearFieldsMed()" class="btn btn-warning btn-sm">
                                            <i class="fa fa-brush"></i> Limpiar
                                        </button>

                                        <button class="btn btn-primary btn-sm" @click="saveMedProbablyNegotiations()">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <v-client-table :data="rows" :columns="columns" :options="options">
                    <span slot="operaciones" slot-scope="{row}" class="edit-delete-one-line">

                        <button type="button" class="btn btn-square btn-success btn-sm" title="Negociar"
                                @click="showBusinessModal(row)" style="padding: 0.25rem 0.7rem 0.25rem 0.7rem;">
                            <i class="fa fa-dollar-sign" aria-hidden="true"></i>
                        </button>

                        <button type="button" :disabled="row.APFARMACIA == 1"
                                :class="row.APFARMACIA == 1 ? 'btn btn-square btn-primary btn-sm btnaprobar' : 'btn btn-square btn-danger btn-sm btnaprobar'"
                                :title="row.APFARMACIA == 1 ? 'Aprobado' : 'Aprobar'"
                                @click="approveNegotiations(row.IDNEG)">
                            <i class="fa fa-check-double" aria-hidden="true"></i>
                        </button>

                        <button type="button" class="btn btn-secondary btn-sm" title="Desactivar" v-show="row.IDLAB == 99 && (userrole == 1 || userrole == 2)"
                                style="padding: 0.25rem 0.7rem 0.25rem 0.7rem;" @click="desactivateNegotiations(row)">
                            <i class="fa fa-power-off"></i>
                        </button>

                        <!-- >Modal CREAR NEGOCIACION -->
                        <div class="modal fade" id="showModalNegotiations" tabindex="-1" role="dialog"
                             aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title">USTED ESTA NEGOCIANDO CON {{ negotiationsData.NGENERICO }}</h5>
                                               <button type="button" class="close" @click="closeModalNegotiations()">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <form enctype="multipart/form-data" class="user text-left">
                                                   <!-- DATOS BASICOS DEL MEDICAMENTO -->
                                                   <div class="row">
                                                       <div class="col-md-6">
                                                           <label>Nombre Genérico:</label>
                                                           <input style="display: none;"
                                                                  class="form-control form-control-sm" type="text"
                                                                  v-model="negotiationsDataToSave.cod_med = negotiationsData.IDMED"/>
                                                           <input class="form-control form-control-sm" type="text"
                                                                  readonly placeholder="Nombre Genérico"
                                                                  v-model="negotiationsData.NGENERICO"/>
                                                       </div>
                                                       <div class="col-md-6">
                                                           <label>Nombre Comercial:</label>
                                                           <input class="form-control form-control-sm" type="text"
                                                                  readonly placeholder="Nombre Comercial"
                                                                  v-model="negotiationsData.NCOMERCIAL"/>
                                                       </div>
                                                   </div>

                                                   <div class="row">
                                                       <div class="col-md">
                                                           <label>Forma Farmaceutica:</label>
                                                           <input class="form-control form-control-sm" type="text"
                                                                  readonly v-model="negotiationsData.FFARMACEUTICA"
                                                                  placeholder="Forma Farmaceutica"/>
                                                       </div>
                                                       <div class="col-md">
                                                           <label>Presentacion Comercial:</label>
                                                           <input class="form-control form-control-sm" type="text"
                                                                  v-model="negotiationsData.PCOMERCIAL" readonly
                                                                  placeholder="Nombre Comercial"/>
                                                       </div>

                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Precio regulado:</label>
                                                               <input type="text" class="form-control form-control-sm"
                                                                      readonly v-model="moneyFormat"
                                                                      placeholder="Valor precio regulado">
                                                           </div>
                                                       </div>

                                                   </div>

                                                   <hr>

                                                   <div class="row">
                                                       <div class="col-md-12">
                                                           <div class="form-group">
                                                               <label>Seleccione el laboratorio de la Negociación:</label>
                                                               <v-select :options="laboratorios"
                                                                         :reduce="razon_social => razon_social.id"
                                                                         v-model="negotiationsDataToSave.lab_idNeg"
                                                                         label="razon_social"/>
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <hr>

                                                   <div class="row">
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Valor Propuesto:</label>
                                                               <input type="text" class="form-control form-control-sm"
                                                                      v-model="negotiationsDataToSave.valor_propuesta"
                                                                      placeholder="Ingrese el valor de la propuesta">
                                                           </div>
                                                       </div>
                                                       <div class="col-md-8">
                                                           <div class="form-group">
                                                               <label>Observación de descuento:</label>
                                                               <input type="text" class="form-control form-control-sm"
                                                                      v-model="negotiationsDataToSave.obs_descuento"
                                                                      placeholder="Ingrese la Observación de descuento">
                                                           </div>
                                                       </div>
                                                   </div>

                                                   <div class="row">
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Valor negociación:</label>
                                                               <input type="text" class="form-control form-control-sm"
                                                                      v-model="negotiationsDataToSave.valor_negociacion"
                                                                      placeholder="Ingrese el valor de la negociación">
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Utilidad:</label>
                                                               <input type="text" class="form-control form-control-sm"
                                                                      readonly
                                                                      v-model="negotiationsDataToSave.utilidad = utilidadNego"
                                                                      placeholder="Valor Utilidad">
                                                           </div>
                                                       </div>
                                                       <div class="col-md-4">
                                                           <div class="form-group">
                                                               <label>Cantidad:</label>
                                                               <input type="text" class="form-control form-control-sm"
                                                                      v-model="negotiationsDataToSave.cantidad"
                                                                      placeholder="Cantidad">
                                                           </div>
                                                       </div>
                                                   </div>

                                               </form>
                                           </div>
                                           <div class="modal-footer">
                                               <button type="button" class="btn btn-secondary btn-sm"
                                                       @click.prevent="closeModalNegotiations()">
                                                   <i class="fa fa-times"></i> Cerrar</button>
                                               <button type="button" class="btn btn-warning btn-sm"
                                                       @click="clearFieldsNego()">
                                                   <i class="fa fa-brush"></i> Limpiar</button>
                                               <button type="button" class="btn btn-success btn-sm"
                                                       @click="saveNegotiations()">
                                                   <i class="fa fa-save"></i> Guardar Negociación</button>
                                           </div>
                                       </div>
                                   </div>
                        </div>
                    </span>

                    <span slot="PREGULADO" slot-scope="{row}">
                        <p>{{ new Intl.NumberFormat("es-CO", {minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.PREGULADO) }}</p>
                    </span>

                    <span slot="VPROPUESTA" slot-scope="{row}">
                        <p>{{ new Intl.NumberFormat("es-CO", {minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.VPROPUESTA) }}</p>
                    </span>

                    <span slot="VNEGOCIACION" slot-scope="{row}">
                        <p>{{ new Intl.NumberFormat("es-CO",{minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.VNEGOCIACION) }}</p>
                    </span>

                    <span slot="UTILIDAD" slot-scope="{row}">
                        <p>{{ new Intl.NumberFormat("es-CO",{minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.UTILIDAD) }}</p>
                    </span>

                </v-client-table>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from "sweetalert2";

    export default {
        name: "Medicamentos",
        props: {
            userrole: Number
        },
        data() {
            return {
                lastMedId: 0,
                formasf: [],
                formasp: [],
                errorsCount: 0,
                errorsForm: [],
                columns: [
                    "NGENERICO",
                    "NCOMERCIAL",
                    "RSOCIAL",
                    "PCOMERCIAL",
                    "FFARMACEUTICA",
                    "CPOSNOPOS",
                    "CALTOCOSTO",
                    "CREGULADO",
                    "PREGULADO",
                    "VPROPUESTA",
                    "OBSERVACION",
                    "VNEGOCIACION",
                    "UTILIDAD",
                    "operaciones"
                ],
                rows: [],
                options: {
                    headings: {
                        NGENERICO: "Nombre Génerico",
                        NCOMERCIAL: "Nombre Comercial",
                        RSOCIAL: "Laboratorio",
                        PCOMERCIAL: "Presentación Comercial",
                        FFARMACEUTICA: "Forma Farmacéutica",
                        CPOSNOPOS: "Pos / NoPos",
                        CALTOCOSTO: "AC / SAC",
                        CREGULADO: "REG",
                        PREGULADO: "Precio Regulado",
                        VPROPUESTA: "Valor Propuesta",
                        OBSERVACION: "Observación",
                        VNEGOCIACION: "Valor Nego." + (new Date().getFullYear()),
                        UTILIDAD: "Utilidad"
                    },
                    sortable: ["NGENERICO", "NCOMERCIAL", "RSOCIAL", "FFARMACEUTICA"],
                    filterable: [
                        "NGENERICO",
                        "NCOMERCIAL",
                        "RSOCIAL",
                        "FFARMACEUTICA"
                    ],
                    perPage: 10,
                    cellClasses: {
                        CREGULADO: [
                            {
                                class: 'bg-success',
                                condition: row => row.REGULADO == "S"
                            }
                        ],
                        CALTOCOSTO: [
                            {
                                class: 'bg-warning',
                                condition: row => row.ALTOCOSTO == 'S'
                            }
                        ],
                        CPOSNOPOS: [
                            {
                                class: 'bg-primary',
                                condition: row => row.POSNOPOS == 'POS'
                            }
                        ]
                    }
                },
                laboratorios: [],
                negotiationsData: {},
                negotiationsDataToSave: {
                    deseanegociar: false,
                    valor_propuesta: 0,
                    valor_negociacion: 0,
                    utilidad: 0,
                    cantidadMed: 0,
                    cantidadNeg: 0,
                },
                medicamentoNego: {
                    cantidadMed: 0,
                    cantidadNeg: 0,
                    deseanegociar: false,
                    utilidad: 0,
                    valor_propuesta: 0,
                    valor_negociacion: 0,
                },
                editNegoData: {}
            };
        },
        computed: {
            utilidad: function () {
                return this.medicamentoNego.valor_propuesta - this.medicamentoNego.valor_negociacion;
            },
            utilidadNego: function () {
                if (this.negotiationsDataToSave.PREGULADO == null) {
                    return this.negotiationsDataToSave.valor_propuesta - this.negotiationsDataToSave.valor_negociacion;
                } else {
                    return this.negotiationsDataToSave.PREGULADO - this.negotiationsDataToSave.valor_negociacion;
                }
            },
            moneyFormat: function () {
                return new Intl.NumberFormat("es-CO", {
                    minimumSignificantDigits: 1,
                    style: "currency",
                    currency: "COP"
                }).format(this.negotiationsData.PREGULADO);
            },
        },
        filters: {
            moment: function (date) {
                return moment(date).format("LLLL");
            },
            uppercase: function (value) {
                if (!value) return '';
                value = value.toString();
                return value.toUpperCase();
            }
        },
        methods: {
            getAllMedicamento() {
                let me = this;
                let url = "http://laravel.local/getallnegociaciones";
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
            deseaNegociar() {
                this.medicamentoNego.deseanegociar = !this.medicamentoNego.deseanegociar;
                if (!this.medicamentoNego.deseanegociar) {
                    this.medicamentoNego.lab_id = '';
                    this.clearFieldsMed_Nego();
                }
            },
            showCreateMedModal() {
                $("#modalCreateMedicamento").modal("show");
            },
            showBusinessModal(item) {
                $("#showModalNegotiations").modal("show");
                this.negotiationsData = item;
                this.negotiationsDataToSave.lab_idNeg = item.IDLAB;
            },
            closeModalCreateMed() {
                $("#modalCreateMedicamento").modal("hide");
                this.clearFieldsMed();
                this.getLastMedId();
            },
            closeModalNegotiations() {
                $("#showModalNegotiations").modal("hide");
                this.negotiationsDataToSave.valor_propuesta = 0;
                this.negotiationsDataToSave.valor_negociacion = 0;
                this.negotiationsDataToSave.utilidad = 0;
                this.clearFieldsNego();
            },
            approveNegotiations(item) {
                let me = this;
                let url = "http://laravel.local/approvenegotiations";

                axios.post(url, {
                    id: item
                })
                    .then(res => {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Negociación Aprobada Correctamente Para Compra',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.getAllMedicamento();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            validateForm() {
                let me = this;
                let errorsCount = 0;
                let errorsForm = [];

                if (!me.medicamentoNego.nombre_generico) {
                    me.errorsForm.push('Ingrese el nombre Genérico');
                }
                if (!me.medicamentoNego.nombre_comercial) {
                    me.errorsForm.push('Ingrese el nombre Comercial');
                }
                if (!me.medicamentoNego.concentracion) {
                    me.errorsForm.push('Ingrese la Concentración del Insumo');
                }
                if (!me.medicamentoNego.cantidadMed) {
                    me.errorsForm.push('Ingrese la Cantidad de la presentación');
                }

                if (me.errorsForm.length > 0) me.errorsCount = me.errorsForm.length;

                return me.errorsCount;
            },
            validateOnlyNumber() {
                let me = this;
                me.medicamentoNego.cantidadMed = me.medicamentoNego.cantidadMed.replace(/[^0-9]/g, '');
                me.medicamentoNego.cantidadNeg = me.medicamentoNego.cantidad.replace(/[^0-9]/g, '');
            },
            saveMedProbablyNegotiations() {
                let me = this;
                let url = "http://laravel.local/savemedicamento";

                if (me.validateForm()) {
                    return;
                }

                axios
                    .post(url, me.medicamentoNego)
                    .then(res => {
                        me.clearFieldsMed();
                        me.clearFieldsMed_Nego();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.data,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        me.getLastMedId();
                        me.getAllMedicamento();
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
                        me.clearFieldsNego();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.data,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        me.getAllMedicamento();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            desactivateNegotiations(item){
                let me = this;
                let url = 'http://laravel.local/updatestatus';

                Swal.fire({
                    title: 'Estas Seguro?',
                    text: "No Podras Revertir la Operación",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Anular!'
                }).then((result) => {
                    if (result.value) {
                        axios
                            .post(url, {
                                idneg: item.IDNEG
                            })
                            .then(res => {
                                Swal.fire(
                                    'Anulada!',
                                    'La Negociación Fue Anulada',
                                    'success'
                                )
                                me.getAllMedicamento();
                            })
                            .catch(err => {
                                console.log(err);
                            })
                    }
                })
            },
            clearFieldsMed() {
                this.medicamentoNego.nombre_generico = '';
                this.medicamentoNego.nombre_comercial = '';
                this.medicamentoNego.id_formaf = null;
                this.medicamentoNego.concentracion = '';
                this.medicamentoNego.id_formap = null;
                this.medicamentoNego.cantidadMed = 0;
                this.medicamentoNego.regulado = ''
            },
            clearFieldsMed_Nego() {
                this.medicamentoNego.lab_id = null;
                this.medicamentoNego.valor_propuesta = 0;
                this.medicamentoNego.obs_descuento = '';
                this.medicamentoNego.valor_negociacion = 0;
                this.medicamentoNego.utilidad = 0;
                this.medicamentoNego.cantidadNeg = 0;
            },
            clearFieldsNego() {
                this.negotiationsDataToSave.lab_idNeg = '';
                this.negotiationsDataToSave.valor_propuesta = 0;
                this.negotiationsDataToSave.obs_descuento = '';
                this.negotiationsDataToSave.precio_regulado = 0;
                this.negotiationsDataToSave.valor_negociacion = 0;
                this.negotiationsDataToSave.utilidad = 0;
                this.negotiationsDataToSave.cantidadNeg = 0;
                this.errorsForm = [];
                this.getLastMedId();
            },
        },
        created() {
            this.getAllMedicamento();
            this.getLastMedId();
            this.getLabs();
            this.getFormaFarmaceutica();
            this.getFormaPresentacion();
        }
    }
</script>

<style scoped>
    .btnaprobar {
        padding: 0.25rem 0.7rem 0.25rem 0.7rem;
    }
    .VueTables .table-responsive table thead {
        text-align: center !important;
    }
    .VueTables .table-responsive table thead tr th{
        font-size: .9rem !important;
    }
</style>
