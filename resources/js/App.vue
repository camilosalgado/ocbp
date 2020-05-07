<template>
    <div class="main">
        <!--<div class="header">
            <SubHeader :userrole="userrol"></SubHeader>
        </div>-->
        <div class="content">
            <router-view :userrole="userrol"></router-view>
        </div>
    </div>

</template>

<script>
    import SubHeader from "./components/shared/SubHeader";
    export default {
        components: {
            SubHeader
        },
        props: {
            userrol: Number
        }
    }
</script>

<style scoped>

</style>
