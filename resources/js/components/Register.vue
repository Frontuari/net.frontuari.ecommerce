<template>
    <div class="register-form">
        <form action="" class="">
            <h2 class="form-title">Crear Cuenta</h2>
            <div class="gender">
                <label>Seleccione sexo</label>
                <div class="form-check form-check-radio">
                    <input type="radio" class="form-check-input" id="man" name="gender" value="m" v-model="User.sex">
                    <label for="man" class="custom-check"><span></span>Hombre</label>
                </div>
                <div class="form-check form-check-radio">
                    <input type="radio" class="form-check-input" id="women" name="gender" value="f" v-model="User.sex">
                    <label for="women" class="custom-check"><span></span>Mujer</label>
                </div>
            </div>
            <div class="form-group">
                <label for="rif" style="display: block;">Cédula/RIF:</label>
                <select id="nationality" v-model="User.nationality" class="form-control" style="width: 20%; display: inline-block;">
                    <option value="V-">V</option>
                    <option value="E-">E</option>
                    <option value="J-">J</option>
                    <option value="G-">G</option>
                    <option value="C-">C</option>
                </select>
                <input type="text" class="form-control" style="width: 79%; display: inline-block;" id="rif" name="rif" maxlength="20" v-model="User.rif">
            </div>
            <div class="form-group">
                <label for="username">Nombre y Apellido:</label>
                <input type="text" class="form-control" id="name" name="name" maxlength="100" v-model="User.name">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="text" class="form-control" id="email" name="email" maxlength="100"  v-model="User.email">
            </div>
            <div class="form-group">
                <label for="birthdate">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" v-model="User.birthdate">
            </div>
            <div class="form-group">
                <label for="tlf">Nro de Teléfono:</label>
                <input type="text" class="form-control" id="tlf" name="tlf" maxlength="23" v-model="User.tlf">
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" maxlength="30" v-model="User.password">
            </div>
            <div class="form-group">
                <label for="password2">Repite la contraseña:</label>
                <input type="password" class="form-control" id="password2" name="password2" maxlength="30" v-model="User.c_password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="terms" name="terms">
                <label for="terms" class="custom-check"><span></span>Acepto los términos y condiciones.</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="allow-offers" name="allow-offers">
                <label for="allow-offers" class="custom-check"><span></span>Deseo recibir notificaciones de productos, ofertas y promociones al correo electrónico.</label>
            </div>
            <div class="form-group">
                <button class="btn" type="button" @click="saveData()">CREAR CUENTA</button>
            </div>
        </form>
    </div>
</template>
<script>
    export default{
        data() {
            return {
                User: {
                    rif: '',
                    name: '',
                    password: '',
                    c_password: '',
                    email: '',
                    birthdate:'',
                    tlf:'',
                    sex: '',
                    nationality: 'V-'
                }
            }
        },
        props: {
            userlogged: Object
        },
        methods: {
            saveData() {
                if( this.User.rif.trim() != '' && this.User.name.trim() != '' && this.User.password.trim() != '' && this.User.c_password.trim() != '' && this.User.email.trim() != '' && this.User.sex.trim() != '') {

                    if(this.User.password == this.User.c_password){
                        if(this.User.password.length >= 8){
                            const formData = new FormData();
                            formData.append("rif",this.User.nationality+this.User.rif);
                            formData.append("name",this.User.name);
                            formData.append("password",this.User.password);
                            formData.append("email",this.User.email);
                            formData.append("birthdate",this.User.birthdate);
                            formData.append("tlf",this.User.tlf);
                            formData.append("sex",this.User.sex);
                            formData.append("from","web");

                                axios.post(URLHOME+'api_rapida.php?evento=registrarUsuario', formData).then( (data) => {
                                    Swal.fire("EOS Delivery","Usuario Registrado Exitosamente","success").then( result => {
                                        location.href="/";    
                                    });
                                }).catch(err => {
                                    if(!!err)
                                    {
                                        Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: "El correo ya está en uso, intente con otro correo",
                                        });
                                    }
                                });
                        } else {
                            Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'La clave tiene que tener mínimo 8 caracteres',
                            });
                        }       
                    }else {
                        Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'Las claves no son iguales, por favor intente nuevamente',
                        });
                    }
                }else{
                    Swal.fire({
                          icon: 'error',
                          title: 'Error',
                          text: 'Todos los campos son obligatorios',
                        });
                }
            }
        }
    }
</script>