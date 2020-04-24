<template>
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <apexchart height="362" type="donut" :options="options" :series="series"></apexchart>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DonutChart",
        data() {
            return {
                series: [],
                options: {
                    plotOptions: {
                        pie: {
                            customScale: 0.8,
                            expandOnClick: true
                        }
                    },
                    labels: ['AltoCosto', 'Regulados', 'Otros'],
                    title: {
                        text: 'Medicamentos',
                    },
                    noData: {
                        text: 'Cargando...'
                    },
                    chart: {
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800,
                            animateGradually: {
                                enabled: true,
                                delay: 150
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        }
                    }
                }
            }
        },
        methods: {
            fillData() {
                let me = this;
                let url = 'http://laravel.local/datapie';
                //let arrayv = [];

                axios.get(url).then(res => {
                    // arrayv = res.data[0].map(function (val, index) {
                    //     return val;
                    // });
                    me.series = res.data[0];
                }).catch(err => {
                    console.log(err);
                })
            }
        },
        created() {
            this.fillData();
        }
    }
</script>

<style scoped>

</style>
