<template>
    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <TopInformationCards></TopInformationCards>
        </div>
        <div class="row">
            <div class="col-xl-10 col-md-12 offset-xl-1">
                <div class="row">
                    <div class="col-md-6">
                        <BarChart></BarChart>
                    </div>
                    <div class="col-md-6">
                        <DonutChart></DonutChart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import TopInformationCards from "./Pages/TopInformationCards";
    import BarChart from "./Pages/BarChart";
    import DonutChart from "./Pages/DonutChart";

    export default {
        name: "DashBoard",
        components: {
            TopInformationCards,
            BarChart,
            DonutChart
        }
    }
</script>

<style scoped>

</style>
