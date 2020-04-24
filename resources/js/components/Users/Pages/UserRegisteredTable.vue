<template>
    <div>
        <div class="card">
            <div class="card-body">
                <v-client-table :data="rows" :columns="columns" :options="options">
                    <span slot="estado" slot-scope="{row}">
                        <i v-if="row.estado == 0" class="fa fa-circle" style="color: red !important;"></i>
                        <i v-else-if="row.estado == 1" class="fa fa-circle" style="color: green !important;"></i>
                    </span>
                </v-client-table>
                {{ insertInRow }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserRegisteredTable",
        props: {
            user: Object
        },
        data() {
            return {
                columns: [
                    "nombre",
                    "apellido",
                    "usuario",
                    "documento",
                    "ROL",
                    "email",
                    "estado",
                    "Acciones"
                ],
                rows: [],
                options: {
                    sortable: [
                        "nombre",
                        "apellido",
                        "usuario",
                        "documento",
                        "ROL"
                    ],
                    filterable: [
                        "nombre",
                        "apellido",
                        "usuario",
                        "documento",
                        "ROL"
                    ],
                    perPage: 5
                },
            }
        },
        computed: {
            insertInRow: function() {
                if (this.user) {
                    return this.getUsers();
                }
            }
        },
        methods: {
            updateRow() {
                this.rows.push(this.user);
            },
            getUsers() {
                let me = this;
                let url = 'http://laravel.local/getusers';

                axios.get(url)
                    .then(res => {
                        me.rows = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        },
        mounted() {
            this.getUsers();
        }
    }
</script>

<style scoped>

</style>
