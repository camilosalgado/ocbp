<template>
    <div class="col-md-12" v-animate-css="'fadeIn'">
        <div class="card">
            <div class="card-header">
                <h6>Registro y Vista de Usuarios</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-12">
                        <UserRegisterForm></UserRegisterForm>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //Pages or SubComponents Imports
    import UserRegisterForm from "./Pages/UserRegisterForm";
    import UserRegisteredTable from "./Pages/UserRegisteredTable";

    export default {
        name: "UserRegister",
        components: {
            UserRegisterForm
        }
    }
</script>

<style scoped>

</style>
