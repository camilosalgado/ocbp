<template>
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BarChart",
        data() {
            return {
                options: {
                    chart: {
                        height: 350,
                        width: '100%',
                        type: 'bar',
                    },
                    dataLabels: {
                        enabled: false
                    },
                    series: [],
                    title: {
                        text: 'Laboratorios con mas negociaciones',
                    },
                    noData: {
                        text: 'Loading...'
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            startingShape: 'flat',
                            endingShape: 'flat',
                            columnWidth: '25%',
                            barHeight: '70%',
                            distributed: false,
                            rangeBarOverlap: true,
                            colors: {
                                ranges: [{
                                    from: 0,
                                    to: 0,
                                    color: undefined
                                }],
                                backgroundBarColors: [],
                                backgroundBarOpacity: 1,
                                backgroundBarRadius: 0,
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            var chart = new ApexCharts(
                document.querySelector("#chart"),
                this.options
            );
            chart.render();

            let url = "http://laravel.local/databar";
            axios.get(url)
                .then(res => {
                    chart.updateSeries([{
                        name: 'Negociaciones',
                        data: res.data
                    }])
                })
                .catch(err => {
                    console.log(err);
                })
        }
    }
</script>

<style scoped>

</style>
