<template>
    <div class="col-xl-12 col-md-12">
        <div v-animate-css="'fadeIn'">
            <v-client-table :data="rows" :columns="columns" :options="options">
                <span slot="fec_nego" slot-scope="{row}">
                    {{ row.fec_nego | moment }}
                </span>
            </v-client-table>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Tab2",
        data() {
            return {
                rows: [],
                columns: [
                    'nombre_comercial',
                    'nombre_generico',
                    'razon_social',
                    'aprobacion_farmacia',
                    'fec_nego'
                ],
                options: {
                    headings: {
                        nombre_comercial: 'Nombre Comercial',
                        nombre_generico: 'Nombre Genérico',
                        razon_social: 'Razón Social',
                        aprobacion_farmacia: 'Aprobado por Subgerencia',
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
            let url = "http://laravel.local/getnegociacionesaprobadas";

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
