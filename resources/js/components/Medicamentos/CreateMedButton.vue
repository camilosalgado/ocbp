<template>
    <div class="col-xl-12 col-md-12">
        <button class="btn btn-primary btn-sm float-right" type="button" data-toggle="modal"
                data-target="#modalCreateMedicamento">
            <i class="fa fa-plus-circle"></i> Crear Medicamento
        </button>

        <!-- Modal Crear Medicamento-->
        <div class="modal fade" id="modalCreateMedicamento" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">USTED ESTA CREANDO: {{
                            negotiationsDataToSave.nombre_generico | uppercase }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                                               v-model="negotiationsDataToSave.codigo_medicamento = this.lastMedId">

                                                        <label>Nombre Genérico:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               placeholder="Nombre Genérico"
                                                               v-model="negotiationsDataToSave.nombre_generico">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Nombre Comercial:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               placeholder="Nombre Comercial"
                                                               v-model="negotiationsDataToSave.nombre_comercial">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Forma Farmaceutica:</label>
                                                        <v-select :options="formasf"
                                                                  :reduce="descripcion => descripcion.id"
                                                                  v-model="negotiationsDataToSave.id_formaf"
                                                                  label="descripcion"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Concentración:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                               placeholder="Concentración"
                                                               v-model="negotiationsDataToSave.concentracion">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Presentación:</label>
                                                        <v-select :options="formasp"
                                                                  :reduce="descripcion => descripcion.id"
                                                                  v-model="negotiationsDataToSave.id_formap"
                                                                  label="descripcion"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Cantidad:</label>
                                                        <input type="number"
                                                               class="form-control form-control-sm"
                                                               placeholder="Cantidad"
                                                               v-model="negotiationsDataToSave.cantidadMed">
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
                                                    <div class="form-group" style="margin-bottom: 0 !important;">
                                                        <label>Regulado:</label>
                                                        <br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                   id="customRadioRegulado1" value="S"
                                                                   v-model="negotiationsDataToSave.regulado">
                                                            <label class="form-check-label"
                                                                   for="customRadioRegulado1">Si</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                   id="customRadioRegulado2" value="N"
                                                                   v-model="negotiationsDataToSave.regulado">
                                                            <label class="form-check-label"
                                                                   for="customRadioRegulado2">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <!-- DESEA NEGOCIAR? -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                           @change="deseaNegociar()">
                                    <label class="form-check-label" for="exampleCheck1">Desea Negociar?</label>
                                </div>
                            </div>
                        </div>

                        <hr v-show="negotiationsDataToSave.deseanegociar">

                        <!-- FORM NEOGIACIÓN -->
                        <div class="row" v-show="negotiationsDataToSave.deseanegociar">
                            <div class="col-md-12">
                                <form enctype="multipart/form-data" class="user text-left">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Seleccione el laboratorio de la Negociación:</label>
                                                <v-select :options="laboratorios"
                                                          :reduce="razon_social => razon_social.id"
                                                          v-model="negotiationsDataToSave.lab_id" label="razon_social"/>
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
                                                <input type="text" class="form-control form-control-sm" readonly
                                                       v-model="negotiationsDataToSave.utilidad = utilidad"
                                                       placeholder="Valor Utilidad">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Cantidad:</label>
                                                <input type="number" class="form-control form-control-sm"
                                                       v-model="negotiationsDataToSave.cantidadNeg"
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

                                <button @click.prevent.self="clearFieldCreateMed()" class="btn btn-warning btn-sm">
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
</template>

<script>
    import Swal from "sweetalert2";

    export default {
        name: "CreateMedButton",
        data() {
            return {
                lastMedId: 0,
                formasf: [],
                formasp: [],
                errorsCount: 0,
                errorsForm: [],
                laboratorios: [],
                negotiationsDataToSave: {
                    deseanegociar: false,
                    valor_propuesta: 0,
                    valor_negociacion: 0,
                    utilidad: 0,
                    cantidadMed: 0,
                    cantidadNeg: 0,
                },
            }
        },
        computed: {
            utilidad: function () {
                return this.negotiationsDataToSave.valor_propuesta - this.negotiationsDataToSave.valor_negociacion;
            }
        },
        filters: {
            uppercase: function (value) {
                if (!value) return '';
                value = value.toString();
                return value.toUpperCase();
            }
        },
        methods: {
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
            closeModalCreateMed() {
                $("#modalCreateMedicamento").modal("hide");
                this.clearFieldCreateMed();
                this.getLastMedId();
            },
            deseaNegociar() {
                this.negotiationsDataToSave.deseanegociar = !this.negotiationsDataToSave.deseanegociar;
                if (!this.negotiationsDataToSave.deseanegociar) {
                    this.clearFieldNegotiations();
                }
            },
            onClickButton(event) {
                this.saveNegotiations();
                this.$emit('clicked', 'ok');
            },
            validateForm() {
                let me = this;
                let errorsCount = 0;
                let errorsForm = [];

                if (!me.negotiationsDataToSave.nombre_generico) {
                    me.errorsForm.push('Ingrese el nombre Genérico');
                }
                if (!me.negotiationsDataToSave.nombre_comercial) {
                    me.errorsForm.push('Ingrese el nombre Comercial');
                }
                if (!me.negotiationsDataToSave.concentracion) {
                    me.errorsForm.push('Ingrese la Concentración del Insumo');
                }

                if (me.errorsForm.length > 0) me.errorsCount = me.errorsForm.length;

                return me.errorsCount;
            },
            validateOnlyNumber() {
                let me = this;
                me.negotiationsDataToSave.cantidadMed = me.negotiationsDataToSave.cantidadMed.replace(/[^0-9]/g, '');
                me.negotiationsDataToSave.cantidadNeg = me.negotiationsDataToSave.cantidad.replace(/[^0-9]/g, '');
            },
            saveMedProbablyNegotiations() {
                let me = this;
                let url = "http://laravel.local/savemedicamento";

                if (me.validateForm()) {
                    return;
                }

                axios
                    .post(url, me.negotiationsDataToSave)
                    .then(res => {
                        me.clearFieldCreateMed();
                        me.clearFieldNegotiations();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.data,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        me.getLastMedId();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            clearFieldCreateMed() {
                this.negotiationsDataToSave.nombre_generico = '';
                this.negotiationsDataToSave.nombre_comercial = '';
                this.negotiationsDataToSave.id_formaf = '';
                this.negotiationsDataToSave.id_formap = '';
                this.negotiationsDataToSave.cantidad = '';
                this.negotiationsDataToSave.alto_costo = '';
                this.negotiationsDataToSave.regulado = '';
                this.negotiationsDataToSave.concentracion = '';
                this.errorsForm = [];
                this.getLastMedId();
            },
            clearFieldNegotiations() {
                this.negotiationsDataToSave.lab_id = '';
                this.negotiationsDataToSave.valor_propuesta = 0;
                this.negotiationsDataToSave.obs_descuento = '';
                this.negotiationsDataToSave.precio_regulado = 0;
                this.negotiationsDataToSave.valor_negociacion = 0;
                this.negotiationsDataToSave.utilidad = 0;
                this.negotiationsDataToSave.cantidad = 0;
            },
        },
        created() {
            this.getLastMedId();
            this.getLabs();
            this.getFormaFarmaceutica();
            this.getFormaPresentacion();
        }
    }
</script>

<style scoped>

</style>
