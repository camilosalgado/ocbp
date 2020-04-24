<template>
    <div class="container-fluid mt-0 mb-5">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm mb-0"  style="background-color: #5f5f5f; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li>
                                <router-link to="/dashboard" class="nav-link">
                                    <i class="fa fa-home"></i> Dashboard
                                    <span class="sr-only">(current)</span>
                                </router-link>
                            </li>

                            <li v-if="userrole == 1 || userrole == 2">
                                <router-link to="/business" class="nav-link">
                                    <i class="fa fa-dollar-sign"></i> Negociaciones</router-link>
                            </li>

                            <li v-if="userrole == 1">
                                <router-link to="/ordenescompra" class="nav-link">
                                    <i class="fa fa-clipboard-check"></i> Ordenes de Compra</router-link>
                            </li>

                            <!-- DROPDOWN FARMACIA-->
                            <li class="nav-item dropdown" v-if="userrole == 1 || userrole == 3">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkFarmacia" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-hospital"></i> Farmacia
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkFarmacia">
                                    <router-link to="/asociarmedicamento" class="dropdown-item">
                                        <i class="fa fa-hospital"></i> Asociar Medicamentos con Hosvital</router-link>
                                    <router-link to="/aprobaciones" class="dropdown-item">
                                        <i class="fa fa-clipboard-check"></i> Aprobacioness para Compra</router-link>
                                </div>
                            </li>

                            <!-- DROPDOWN MAESTROS-->
                            <li class="nav-item dropdown" v-if="userrole == 1 || userrole == 2">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkMaestros" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cogs"></i> Maestros
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkMaestros">
                                    <router-link to="/medicamentos" class="dropdown-item">
                                        <i class="fa fa-pills" aria-hidden="true"></i> Medicamentos</router-link>
                                    <router-link to="/register" class="dropdown-item" v-if="userrole == 1">
                                        <i class="fa fa-users"></i> Usuarios</router-link>
                                    <router-link to="/laboratorios" class="dropdown-item">
                                        <i class="fas fa-microscope"></i> Laboratorios</router-link>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SubHeader",
        props: {
            userrole: Number
        }
    }
</script>

<style scoped>
    .navbar-nav li a {
        color: #ffffff !important;
    }
    .navbar-nav li a.dropdown-item {
        color: #000000 !important;
    }
</style>
