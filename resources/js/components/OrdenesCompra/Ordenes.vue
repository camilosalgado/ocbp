<template>
    <div class="col-xl-12 col-md-12" v-animate-css="'fadeIn'">
        <div class="card border-left-primary shadow h-100 py-0">
            <div class="card-body">
                <div v-cloak>

                    <div v-show="loading" class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                    <v-client-table :data="rows" :columns="columns" :options="options">
                        <span slot="FECHA_ORDEN" slot-scope="{row}">
                            {{ row.FECHA_ORDEN | moment }}
                        </span>

                        <span slot="VALOR_UNITARIO" slot-scope="{row}">
                            <p>{{ new Intl.NumberFormat("es-CO", {minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.VALOR_UNITARIO) }}</p>
                        </span>
                        <span slot="VALOR_TOTAL" slot-scope="{row}">
                            <p>{{ new Intl.NumberFormat("es-CO", {minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.VALOR_TOTAL) }}</p>
                        </span>
                        <span slot="VALOR_DESCUENTO" slot-scope="{row}">
                            <p>{{ new Intl.NumberFormat("es-CO", {minimumSignificantDigits: 1, style: "currency", currency:"COP"}).format(row.VALOR_DESCUENTO) }}</p>
                        </span>

                        <span slot="ACCIONES" slot-scope="{row}">
                            <button class="btn btn-success btn-sm" title="Aprobar" @click="approveOrder(row)">
                                <i class="fa fa-check-circle"></i>
                            </button>
                        </span>

                    </v-client-table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Ordenes",
        data() {
            return {
                loading: false,
                rows: [],
                columns: [
                    'NRO_ORDEN',
                    'NIT',
                    'PROVEEDOR',
                    'PLAZO',
                    'DESCRIPCION',
                    'CODIGO',
                    'SUMINISTRO',
                    'CANTIDAD',
                    'VALOR_UNITARIO',
                    'FECHA_ORDEN',
                    'VALOR_TOTAL',
                    'VALOR_DESCUENTO',
                    'OBSERVACION',
                    'TIEMPO_ENTREGA',
                    'ACCIONES'
                ],
                options: {
                    headings: {
                        NRO_ORDEN: '# Orden',
                        NIT: 'Nit',
                        PROVEEDOR: 'Proveedor',
                        PLAZO: 'Plazo',
                        DESCRIPCION: 'Descripción',
                        CODIGO: 'Codigo',
                        SUMINISTRO: 'Suministro',
                        CANTIDAD: 'Cantidad',
                        VALOR_UNITARIO: 'Valor Unitario',
                        FECHA_ORDEN: 'Fecha Orden',
                        VALOR_TOTAL: 'Valor Total',
                        VALOR_DESCUENTO: 'Valor Descuento',
                        OBSERVACION: 'Observación',
                        TIEMPO_ENTREGA: 'Tiempo Entrega',
                        ACCIONES: 'Operaciones'
                    },
                    sortable: ["NRO_ORDEN", "PROVEEDOR", "SUMINISTRO", "CODIGO"],
                    filterable: ["NRO_ORDEN", "PROVEEDOR", "SUMINISTRO", "CODIGO"],
                    perPage: 10
                },
            }
        },
        filters: {
            moment: function(date) {
                return moment(date).format("LLLL");
            }
        },
        methods: {
            fetchOrdeners() {
                let me = this;
                let url = "http://laravel.local/getorderfromhosvital";
                me.loading = true;

                axios.get(url)
                    .then(res => {
                        //console.log(res.data)
                        me.rows = res.data;
                        me.loading = false;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            approveOrder(order) {
                let me = this;
                let url= "http://laravel.local/saveapproveorder";

                axios.post(url, order)
                        .then(res => {
                            console.log(res.data);
                        })
            }
        },
        created() {
            this.fetchOrdeners();
        }
    }
</script>

<style scoped>

</style>
