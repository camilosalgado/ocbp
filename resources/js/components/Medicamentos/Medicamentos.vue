<template>
    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <v-client-table :data="rows" :columns="columns" :options="options">
                    <span slot="operaciones" slot-scope="{row}" class="edit-delete-one-line">

                        <button type="button" class="btn btn-square btn-success btn-sm" title="Negociar" @click="showBusinessModal(row)" style="padding: 0.25rem 0.7rem 0.25rem 0.7rem;">
                            <i class="fa fa-dollar-sign" aria-hidden="true"></i>
                        </button>

                        <button type="button" :disabled="row.APFARMACIA == 1" :class="row.APFARMACIA == 1 ? 'btn btn-square btn-primary btn-sm btnaprobar' : 'btn btn-square btn-warning btn-sm btnaprobar'" :title="row.APFARMACIA == 1 ? 'Aprobado' : 'Aprobar'" @click="approveNegotiations(row.IDNEG)">
                            <i class="fa fa-check-double" aria-hidden="true"></i>
                        </button>

                        <!-- Modal CREAR NEGOCIACION -->
                        <div class="modal fade" id="showModalNegotiations" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">NEGOCIANDO CON {{ negotiationsData.NGENERICO }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form enctype="multipart/form-data" class="user text-left">
                                        <!--DATOS BASICOS DEL MEDICAMENTO -->
                                        <div class="row">
                                            <input class="form-control form-control-sm" style="display: none" type="text"v-model="negotiationsDataToSave.cod_med = negotiationsData.IDMED" />
                                            <div class="col-md-6">
                                                <label>Nombre Genérico:</label>
                                                <input class="form-control form-control-sm" type="text" readonly placeholder="Nombre Genérico" v-model="negotiationsData.NGENERICO" />
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nombre Comercial:</label>
                                                <input class="form-control form-control-sm" type="text" readonly placeholder="Nombre Comercial" v-model="negotiationsData.NCOMERCIAL" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md">
                                                <label>Forma Farmaceutica:</label>
                                                <input class="form-control form-control-sm" type="text" readonly v-model="negotiationsData.FFARMACEUTICA" placeholder="Forma Farmaceutica" />
                                            </div>
                                            <div class="col-md">
                                                <label>Concentración:</label>
                                                <input class="form-control form-control-sm" type="text" v-model="negotiationsData.CONCENTRACION" readonly placeholder="Nombre Comercial" />
                                            </div>
                                            <div class="col-md">
                                                <label>Presentacion Comercial:</label>
                                                <input class="form-control form-control-sm" type="text" v-model="negotiationsData.PCOMERCIAL" readonly placeholder="Nombre Comercial" />
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Seleccione el laboratorio de la Negociación:</label>
                                                    <v-select :options="laboratorios" :reduce="razon_social => razon_social.id" v-model="negotiationsDataToSave.lab_id" :value="negotiationsData.IDLAB" label="razon_social" />
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

    <!--                    <button type="button" @click="showDetail(row)" class="btn btn-square btn-primary btn-sm" title="Ver Detalle">-->
    <!--                        <i class="fa fa-eye" aria-hidden="true"></i>-->
    <!--                    </button>-->

    <!--                    <button type="button" @click="deleteMedicamento(row)" class="btn btn-square btn-danger btn-sm" title="Desactivar">-->
    <!--                        <i class="fa fa-trash" aria-hidden="true"></i>-->
    <!--                    </button>-->
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

                    <span slot="REGULADO" slot-scope="{row}">
                        <p v-if="row.REGULADO == 1">Si</p>
                        <p v-if="row.REGULADO == 0">No</p>
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
        data() {
            return {
                columns: [
                    "NGENERICO",
                    "NCOMERCIAL",
                    "RSOCIAL",
                    "PCOMERCIAL",
                    "FFARMACEUTICA",
                    "CONCENTRACION",
                    "REGULADO",
                    "VPROPUESTA",
                    "OBSERVACION",
                    "VNEGOCIACION",
                    "UTILIDAD",
                    "operaciones"
                ],
                rows: [],
                options: {
                    headings: {
                        NGENERICO: "Nombre Generico",
                        NCOMERCIAL: "Nombre Comercial",
                        RSOCIAL: "Laboratorio",
                        PCOMERCIAL: "Presentación Comercial",
                        FFARMACEUTICA: "Forma Farmaceutica",
                        CONCENTRACION: "Concentración",
                        REGULADO: "Regulado",
                        VPROPUESTA: "Valor Propuesta",
                        OBSERVACION: "Observación",
                        VNEGOCIACION: "Valor Negociación " + (new Date().getFullYear()),
                        UTILIDAD: "Utilidad"
                    },
                    sortable: ["NGENERICO", "NCOMERCIAL", "RSOCIAL", "FFARMACEUTICA"],
                    filterable: [
                        "NGENERICO",
                        "NCOMERCIAL",
                        "RSOCIAL",
                        "FFARMACEUTICA"
                    ],
                    perPage: 10
                },
                laboratorios: [],
                negotiationsData: {},
                negotiationsDataToSave: {
                    valor_propuesta: 0,
                    precio_regulado: 0,
                    valor_negociacion: 0,
                    utilidad: 0
                }
            };
        },
        computed: {
            utilidad: function() {
                return this.negotiationsDataToSave.precio_regulado - this.negotiationsDataToSave.valor_negociacion;
            },
            selectedValueInLabs() {
                return this.negotiationsDataToSave.lab_id = this.negotiationsData.IDLAB;
            }
        },
        filters: {
            moment: function(date) {
                return moment(date).format("LLLL");
            }
        },
        methods: {
            getAllMedicamento() {
                let me = this;
                let url = "http://laravel.local/getmedicamentos";
                axios
                    .get(url)
                    .then(res => {
                        me.rows = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    });
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
            changeStateObs() {
                this.obsState = !this.obsState;
            },
            showDetail(detail) {
                $("#groupModal").modal("show");
                this.detailData = detail;
            },
            showBusinessModal(item) {
                $("#showModalNegotiations").modal("show");
                this.negotiationsData = item;
                this.selectedValueInLabs;
            },
            saveNegotiations() {
                let me = this;
                let url = "http://laravel.local/savenegotiations";

                axios
                    .post(url, me.negotiationsDataToSave)
                    .then(res => {
                        me.getAllMedicamento();
                        me.clearFieldSaveNegotiations();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            approveNegotiations(item) {
                let me = this;
                let url = "http://laravel.local/approvenegotiations";

                axios.post(url, {
                    id: item
                })
                .then(res => {
                    //console.log(res.data);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Negociación Aprobada Correctamente Para Compra',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.getAllMedicamento();
                })
                .catch(err =>{
                    console.log(err);
                })
            },
            clearFieldSaveNegotiations() {
                this.negotiationsDataToSave.lab_id = '';
                this.negotiationsDataToSave.valor_propuesta = 0;
                this.negotiationsDataToSave.obs_descuento = '';
                this.negotiationsDataToSave.precio_regulado = 0;
                this.negotiationsDataToSave.valor_negociacion = 0;
            }
        },
        created() {
            this.getAllMedicamento();
            this.getLabs();
        }
    }
</script>

<style scoped>
    .btnaprobar {
        padding: 0.25rem 0.7rem 0.25rem 0.7rem;
    }
</style>
