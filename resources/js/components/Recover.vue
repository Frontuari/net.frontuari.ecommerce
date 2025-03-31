<template>
    <div class="register-form">
        <form action="" class="">
            <h2 class="form-title">Recuperar Cuenta</h2>
            <div v-if="!!first">
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="text" class="form-control" id="email" name="email" v-model="email">
                </div>
                
                <div class="form-group">
                    <button class="btn" type="button" @click="sendEmail()">Recuperar Cuenta</button>
                </div>
            </div>
            <div v-if="!!second">
                <div class="form-group">
                    <label for="email">Código de recuperación:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" v-model="codigo">
                </div>
                
                <div class="form-group">
                    <button class="btn" :disabled="sending" type="button" @click="CheckCode()">Validar código</button>
                </div>
            </div>
            <div v-if="!!third">
                <div class="form-group">
                    <label for="email">Nueva clave:</label>
                    <input type="password" class="form-control" id="password" name="password" maxlength="30" v-model="password">
                </div>

                <div class="form-group">
                    <label for="email">Repita su clave:</label>
                    <input type="password" class="form-control" id="samepassword" name="samepassword" maxlength="30" v-model="samepassword">
                </div>
                
                <div class="form-group">
                    <button class="btn" :disabled="sending" type="button" @click="changePassword()">Cambiar clave</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default{
        data() {
            return {
                email: '',
                codigo: '',
                password: '',
                samepassword: '',
                sending: false,
                first: true,
                second: false,
                third: false
            }
        },
        props: {
            userlogged: Object
        },
        methods: {
            CheckCode() {
                const formData = new FormData();
                formData.append("email",this.email);
                formData.append("codigoCorreo",this.codigo);
                this.sending = true;
                axios.post(URLHOME+'api_rapida.php?evento=confirmarCodRecuperacion',formData).then( (data) => {
                    console.log(data);
                    this.sending = false;
                    Swal.fire("Bio en línea","Código correcto, puede cambiar su clave","success").then( result => {
                        this.first = false;
                        this.second = false;
                        this.third = true;
                        this.sending = false;
                    });
                }).catch(err => {
                    if(!!err) {
                        this.sending = false;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Código invalido, intente nuevamente",
                        });
                    }
                });
            },
            changePassword() {
                const formData = new FormData();
                formData.append("email",this.email);
                formData.append("codigoCorreo",this.codigo);
                formData.append("password",this.password);
                if(this.password === this.samepassword){
                    axios.post(URLHOME+'api_rapida.php?evento=cambiarClavePublico',formData).then( (data) => {
                        Swal.fire("Bio en línea","Clave Cambiada con Exito, Ya puedes Iniciar Sesion!!","success").then( result => {
                            /*this.first = false;
                            this.second = false;
                            this.second = true;
                            this.sending = false;*/
                            document.location.href = '/';
                        });
                    }).catch(err => {
                        if(!!err) {
                            this.sending = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Código invalido, intente nuevamente",
                            });
                        }
                    });
                }else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Sus claves no concuerdan, intente nuevamente',
                    });
                }
            },
            sendEmail() {
                if(this.email.trim() != '') {
                    this.sending = true;
                    axios.post(URLHOME+'api_rapida.php?evento=enviarCodRecuperacion&email='+this.email).then( (data) => {
                        Swal.fire("Bio en línea","Por favor revise su correo en bandeja de entrada o spam","success").then( result => {
                            console.log(this.first);
                            console.log(this.second);
                            console.log(this.sending);

                            this.first = false;
                            this.second = true;
                            this.sending = false;
                        });
                    }).catch(err => {
                        if(!!err) {
                            this.sending = false;
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Intente nuevamente",
                            });
                        }
                    });
                }else{
                    this.sending = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe escribir el email',
                    });
                }
            }
        }
    }
</script>