<template>
    <div class="col-xl-10 col-md-12 col-sm-12 offset-xl-1">
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de Medicamentos:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ totalMedicamentos }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-syringe fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de Laboratorios:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ totalLabs }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-flask fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Alto Costo:</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ totalAltoCosto }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Regulados</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ totalRegulado }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-prescription-bottle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="border-bottom-info">

                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="border-bottom-info">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TopInformationCards",
        data() {
            return {
                totalMedicamentos: '',
                totalLabs: '',
                totalAltoCosto: '',
                totalRegulado: ''
            }
        },
        methods: {
            getAllMedicamentos() {
                let me = this;
                let url = 'http://190.131.222.108:8085/countmedicamentos';

                axios.get(url)
                    .then(res => {
                        me.totalMedicamentos = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getAllLabs() {
                let me = this;
                let url = 'http://190.131.222.108:8085/countlaboratorios';

                axios.get(url)
                    .then(res => {
                        me.totalLabs = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getAltoCosto() {
                let me = this;
                let url = 'http://190.131.222.108:8085/countaltocosto';

                axios.get(url)
                    .then(res => {
                        me.totalAltoCosto = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getRegulado() {
                let me = this;
                let url = 'http://190.131.222.108:8085/countregulado';

                axios.get(url)
                    .then(res => {
                        me.totalRegulado = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },
        mounted() {
            this.getAllMedicamentos();
            this.getAllLabs();
            this.getAltoCosto();
            this.getRegulado();
        }
    }
</script>

<style scoped>

</style>
