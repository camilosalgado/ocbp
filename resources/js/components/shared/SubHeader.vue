<template>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link" v-if="userrol == 1">
                <i class="fa fa-home"></i> Dashboard
                <span class="sr-only">(current)</span>
            </router-link>
        </li>

        <li class="nav-item" v-if="userrol == 1 || userrol == 2">
            <router-link to="/business" class="nav-link">
                <i class="fa fa-dollar-sign"></i> Negociaciones</router-link>
        </li>

        <li class="nav-item" v-if="userrol == 6">
            <router-link to="/ordenescompra" class="nav-link">
                <i class="fa fa-clipboard-check"></i> Ordenes de Compra</router-link>
        </li>

        <!-- DROPDOWN FARMACIA-->
        <li class="nav-item dropdown" v-if="userrol == 1 || userrol == 3">
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
        <li class="nav-item dropdown" v-if="userrol == 1 || userrol == 4">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLinkMaestros" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cogs"></i> Maestros
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLinkMaestros">
                <router-link to="/medicamentos" class="dropdown-item" v-if="userrol == 1">
                    <i class="fa fa-pills" aria-hidden="true"></i> Medicamentos</router-link>
                <router-link to="/register" class="dropdown-item" v-if="userrol == 1">
                    <i class="fa fa-users"></i> Usuarios</router-link>
                <router-link to="/laboratorios" class="dropdown-item" v-if="userrol == 1 || userrol == 4">
                    <i class="fas fa-microscope"></i> Laboratorios</router-link>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "SubHeader",
        props: {
            userrole: Number,
            userrol: Number
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
