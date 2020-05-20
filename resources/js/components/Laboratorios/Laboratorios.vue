<template>
    <div class="col-xl-12 col-md-12" v-animate-css="'fadeIn'">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h6>Laboratorios</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Razón Social:</label>
                                                <input type="text" class="form-control form-control-sm" v-model="laboratorio.razon_social" placeholder="Razón social del Laboratorio">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nit:</label>
                                                <input type="text" class="form-control form-control-sm" v-model="laboratorio.nit" placeholder="Nit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Dirección:</label>
                                                <input type="text" class="form-control form-control-sm" v-model="laboratorio.direccion" placeholder="Dirección del Laboratorio">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Teléfono:</label>
                                                <input type="text" class="form-control form-control-sm" v-model="laboratorio.telefono" placeholder="Teléfono del Laboratorio">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button type="reset" class="btn btn-warning btn-sm">
                                                <i class="fas fa-brush"></i> Limpiar
                                            </button>
                                            <button class="btn btn-success btn-sm" @click.prevent="createLabs()">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <v-client-table :data="rows" :columns="columns" :options="options" >
                            <span slot="estado" slot-scope="{row}">
                                <p v-if="row.estado == 1">
                                    <i class="fa fa-circle" style="color: green !important;"></i>
                                </p>
                                <p v-if="row.estado == 0">
                                    <i class="fa fa-circle" style="color: red !important;"></i>
                                </p>
                            </span>
                        </v-client-table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from "sweetalert2";
    export default {
        name: "Laboratorios",
        data() {
            return {
                laboratorio: {},
                rows: [],
                columns: [
                    'razon_social',
                    'nit',
                    'telefono',
                    'direccion',
                    'estado'
                ],
                options: {
                    headings: {
                        razon_social: 'Razon Social',
                        nit: 'Nit',
                        telefono: 'Telefono',
                        direccion: 'Direccion',
                        estado: 'Estado'
                    },
                    sortable: [
                        'razon_social',
                        'nit',
                    ],
                    filterable: [
                        'razon_social',
                        'nit',
                    ],
                    perPage: 5
                },
            }
        },
        methods: {
            getLabs() {
                let me = this;
                let url = 'http://190.131.222.108:8085/getlaboratorios';

                axios
                    .get(url)
                    .then(res => {
                        me.rows = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            createLabs() {
                let me = this;
                let url = 'http://190.131.222.108:8085/createlaboratorios';

                axios
                    .post(url, me.laboratorio)
                    .then(res => {
                        
                        me.rows.push(res.data);
                        me.clearFields();
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            clearFields() {
                this.laboratorio.razon_social = '';
                this.laboratorio.nit = '';
                this.laboratorio.direccion = '';
                this.laboratorio.telefono = '';
            }
        },
        created() {
            this.getLabs();
        }
    }
</script>

<style scoped>
</style>
