<template>
    <div>
        <form enctype="multipart/form-data" class="user text-left">
            <!-- DATOS BASICOS DEL MEDICAMENTO -->
            <div class="row">
                <div class="col-md-6">
                    <label>Nombre Genérico:</label>
                    <input style="display: none;" class="form-control form-control-sm" type="text" v-model="negotiationsDataToSave.cod_med = negotiationsData.codigo_medicamento" />
                    <input class="form-control form-control-sm" type="text" readonly placeholder="Nombre Genérico" v-model="negotiationsData.nombre_generico" />
                </div>
                <div class="col-md-6">
                    <label>Nombre Comercial:</label>
                    <input class="form-control form-control-sm" type="text" readonly placeholder="Nombre Comercial" v-model="negotiationsData.nombre_comercial" />
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <label>Forma Farmaceutica:</label>
                    <input class="form-control form-control-sm" type="text" readonly v-model="negotiationsData.forma_farmaceutica" placeholder="Forma Farmaceutica" />
                </div>
                <div class="col-md">
                    <label>Presentacion Comercial:</label>
                    <input class="form-control form-control-sm" type="text" v-model="negotiationsData.presentacion_comercial" readonly placeholder="Nombre Comercial" />
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Precio regulado:</label>
                        <input type="text" class="form-control form-control-sm" readonly v-model="moneyFormat" placeholder="Valor precio regulado">
                    </div>
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Cantidad:</label>
                        <input type="text" class="form-control form-control-sm" v-model="negotiationsDataToSave.cantidad" placeholder="Cantidad">
                    </div>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
    export default {
        name: "NegotiationsModalForms"
    }
</script>

<style scoped>

</style>
