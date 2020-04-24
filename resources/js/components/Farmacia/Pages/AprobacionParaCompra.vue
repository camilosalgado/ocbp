<template>
    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div v-animate-css="'fadeIn'">
                    <v-client-table :data="rows" :columns="columns" :options="options">
                        <span slot="aprobacion_farmacia" slot-scope="{row}">
                            <i class="fa fa-circle" :style="row.aprobacion_farmacia == 1 ? 'color: green;' : ''"></i>
                        </span>
                        <span slot="fec_nego" slot-scope="{row}">
                            {{ row.fec_nego | moment }}
                        </span>
                        <span slot="valor_negociacion" slot-scope="{row}">
                        <p>{{ new Intl.NumberFormat("es-CO", {minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.valor_negociacion) }}</p>
                    </span>
                    </v-client-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AprobacionParaCompra",
        data() {
            return {
                rows: [],
                columns: [
                    'negoid',
                    'nombre_comercial',
                    'nombre_generico',
                    'razon_social',
                    'aprobacion_farmacia',
                    'valor_negociacion',
                    'fec_nego'
                ],
                options: {
                    headings: {
                        negoid: '# Nego.',
                        nombre_comercial: 'Nombre Comercial',
                        nombre_generico: 'Nombre Genérico',
                        razon_social: 'Laboratorio',
                        aprobacion_farmacia: 'Aprobado por orden de compra',
                        valor_negociacion: 'Valor Negociación',
                        fec_nego: 'Fecha de Negociación'
                    },
                    sortable: ["nombre_comercial", "nombre_generico", "razon_social", "fec_nego"],
                    filterable: ["nombre_comercial", "nombre_generico", "razon_social", "fec_nego"],
                    perPage: 10
                },
            }
        },
        filters: {
            moment: function(date) {
                return moment(date).format("LLLL");
            }
        },
        created() {
            let me = this;
            let url = "http://laravel.local/getapprovednegotiations";

            axios.get(url)
                .then(res => {
                    me.rows = res.data;
                })
                .catch(err => {
                    console.log(err);
                })
        }
    }
</script>

<style scoped>

</style>
