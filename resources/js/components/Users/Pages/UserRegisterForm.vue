<template>
    <div class="row">
        <div class="col-xl-6">
            <!-- REGISTER USER FORM -->
            <div class="card">
                <div class="card-header">
                    <h3>Registrar Usuario</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group row" v-if="regError">
                            <p class="error">
                                {{regError}}
                            </p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre:</label>
                                    <input type="text" @input="withOutSpecialChart()" required class="form-control" v-model="formRegister.nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellido">Apellido:</label>
                                    <input type="text" @input="withOutSpecialChart()" required class="form-control" v-model="formRegister.apellido" placeholder="Apellido">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_doc">Tipo de Documento:</label>
                                    <select class="form-control" required v-model="formRegister.id_tipodoc">
                                        <option disabled selected value=""> Seleccione el tipo de documento  ----</option>
                                        <option v-for="td in tipodocs" :key="td.id" :value="td.id">{{ td.sigla }}  --  {{ td.descripcion }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documento">Documento:</label>
                                    <input type="text" @input="onlyNumber" required class="form-control" v-model="formRegister.documento" placeholder="Documento">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo_doc">Rol:</label>
                                    <select name="rol" required class="form-control" v-model="formRegister.id_rol">
                                        <option value="" disabled selected> Seleccione el rol del usuario  ----</option>
                                        <option v-for="rol in roles" :key="rol.id" :value="rol.id">{{ rol.descripcion }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" required class="form-control" v-model="formRegister.email" placeholder="Correo Electronico">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Contraseña:</label>
                                    <input type="password"required class="form-control" v-model="formRegister.password" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-right">
                                    <button type="button" @click="clearFields()" class="btn btn-warning ml-auto">
                                        <i class="fa fa-trash"></i> Limpiar
                                    </button>
                                    <button type="button" @click.prevent="register()" class="btn btn-primary ml-auto">
                                        <i class="fa fa-save"></i> Guardar
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- ERRORS DIV -->
            <div class="mt-3" v-show="ErrorsCount">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        <li v-for="error in ErrorsForm" :key="error" v-text="error"></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <UserRegisteredTable :user="this.UserInProps" :stado="false"></UserRegisteredTable>
        </div>
    </div>
</template>

<script>

    import UserRegisteredTable from "./UserRegisteredTable";

    export default {
        name: "UserRegisterForm",
        components: {
            UserRegisteredTable
        },
        data() {
            return {
                formRegister: {
                    nombre: '',
                    apellido: '',
                    id_tipodoc: '',
                    documento: '',
                    id_rol: '',
                    email: '',
                    password: ''
                },
                errors: null,
                tipodocs: [],
                roles: [],
                ErrorsCount: '',
                ErrorsForm: [],
                UserInProps: {},
                regError: ''
            }
        },
        methods: {
            getTipoDocs() {
                let url = "http://190.131.222.108:8085/gettipodocs";

                axios.get(url)
                    .then(res => {
                        this.tipodocs = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            getRoles() {
                let url = "http://190.131.222.108:8085/getroles";

                axios.get(url)
                    .then(res => {
                        this.roles = res.data;
                    })
                    .catch(err => {
                        console.log(err);
                    })
            },
            register() {
                let me = this;
                let url = 'http://190.131.222.108:8085/auth/register';

                if (this.validateForm()) {
                    return;
                }
                axios.post(url, me.formRegister)
                    .then(response => {
                        if (response.data.msj) {
                            this.regError = response.data.msj;
                        } else {
                            me.ErrosCount = 0;
                            me.UserInProps = response.data.user;
                            me.clearFields();
                        }
                    })
                    .catch(err => {
                        console.log('Ha ocurrido un Error, intente mas tarde...');
                    })
            },
            validateForm() {
                let me = this;
                me.ErrorsCount = 0;
                me.ErrorsForm = [];

                if(!me.formRegister.nombre) {
                    me.ErrorsForm.push('Por favor Ingrese el Nombre');
                }
                if(!me.formRegister.apellido) {
                    me.ErrorsForm.push('Por favor Ingrese el Apellido');
                }
                if(!me.formRegister.email) {
                    me.ErrorsForm.push("Por favor Ingrese el Email");
                }else if(!me.validMail(me.formRegister.email)) {
                    me.ErrorsForm.push("El Email Ingresado no es Valido");
                }
                if(!me.formRegister.password) {
                    me.ErrorsForm.push("Por Favor Ingrese la Contraseña");
                }

                if(me.ErrorsForm.length > 0) me.ErrorsCount = me.ErrorsForm.length;

                return me.ErrorsCount;
            },
            onlyNumber() {
                let me = this;
                me.formRegister.documento = me.formRegister.documento.replace(/[^0-9]/g,'');
            },
            withOutSpecialChart() {
                let me = this;
                var patron = /[^A-Za-z]/g;

                me.formRegister.nombre = me.formRegister.nombre.replace(patron,'');
                me.formRegister.apellido = me.formRegister.apellido.replace(patron,'');
            },
            validMail(mail) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(mail);
            },
            clearFields() {
                this.formRegister.nombre = '';
                this.formRegister.apellido = '';
                this.formRegister.id_tipodoc = '';
                this.formRegister.documento = '';
                this.formRegister.id_rol = '';
                this.formRegister.email = '';
                this.formRegister.password = '';
                this.ErrorsCount = '';
            }
        },
        mounted() {
            this.getTipoDocs();
            this.getRoles();
        }
    }
</script>

<style scoped>

</style>
