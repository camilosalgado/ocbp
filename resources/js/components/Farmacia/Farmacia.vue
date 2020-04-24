<template>
    <div class="container-fluid" v-animate-css="'fadeIn'">
        <div class="row">
            <div class="col-xl-2 col-md-12">
                <div class="card border-left-primary shadow h-100 py-2" style="max-height: 135px !important;">
                    <div class="card-body">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Revision Neg. Aprobadas</a>
                            <a class="nav-link" id="v-pills-enlace-tab" data-toggle="pill" href="#v-pills-enlace" role="tab" aria-controls="v-pills-enlace" aria-selected="true">Asociar Med a Hosvital</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-10 col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <Tab2></Tab2>
                    </div>
                    <div class="tab-pane fade" id="v-pills-enlace" role="tabpanel" aria-labelledby="v-pills-enlace-tab">
                        <Tab1></Tab1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import Tab1 from "./Tabs/Tab1";
    import Tab2 from "./Tabs/Tab2";

    export default {
        name: "Farmacia",
        components: {
            Tab1,
            Tab2
        }
    }
</script>

<style scoped>

</style>
