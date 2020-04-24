<template>
    <div class="card shadow mb-4" v-animate-css="'fadeIn'">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Asociar Medicamento con Codigo Hosvital</h6>
        </div>
        <div class="card-body">
            <form enctype="" class="user">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Medicamento:</label>
                            <v-select :options="rows" :reduce="nombre_generico => nombre_generico.id" v-model="enlace.item1" label="nombre_generico" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Medicamento Hosvital:</label>
                            <v-select :options="rows" :reduce="nombre_generico => nombre_generico.id" v-model="enlace.item2" label="nombre_generico" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="col-md-12 text-right">
                <div class="form-group">
                    <button class="btn btn-sm btn-warning">
                        <i class="fa fa-brush"></i> Limpiar
                    </button>
                    <button class="btn btn-sm btn-success">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Tab1",
        data() {
            return  {
                rows: [],
                enlace: {}
            }
        },
        methods: {
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

        },
        created() {
            this.getAllMedicamento();
        }
    }
</script>

<style scoped>

</style>
