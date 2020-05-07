<template>
    <form enctype="multipart/form-data" class="user text-left">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Seleccione el laboratorio de la Negociación:</label>
                    <v-select :options="laboratorios" :reduce="razon_social => razon_social.id"
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
                           v-model="negotiationsDataToSave.utilidad = utilidad" placeholder="Valor Utilidad">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Cantidad:</label>
                    <input type="text" class="form-control form-control-sm" v-model="negotiationsDataToSave.cantidad"
                           placeholder="Cantidad">
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        name: "NegotiationsInitialForms",
        data() {
            return {
                laboratorios: [],
                negotiationsDataToSave: {
                    valor_propuesta: 0,
                    valor_negociacion: 0,
                    utilidad: 0,
                    cantidad: 0
                },
            }
        },
        computed: {
            utilidad: function () {
                return this.negotiationsDataToSave.valor_propuesta - this.negotiationsDataToSave.valor_negociacion;
            }
        },
        filters: {
            moment: function (date) {
                return moment(date).format("LLLL");
            }
        },
        methods: {
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
        },
        created() {
            this.getLabs();
        }
    }
</script>

<style scoped>

</style>
