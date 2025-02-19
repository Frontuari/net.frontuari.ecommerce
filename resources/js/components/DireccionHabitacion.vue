<template>
    <div v-if="propsLoaded">

        <div >
      
      
            <div class="col-lg-12">
                <h3 class="profile-title">Dirección de Habitación</h3>
            </div>
  
      <!-- Organización en columnas -->
      <div class="row">
        <!-- Columna para estado, municipio y parroquia -->
        <div class="col-lg-4">
          <div class="form-group">
            <label for="address-1-state">Estado:</label>
            <select  class="form-control" @change="loadMunicipioHab($event)" v-model="userData.habDirection[0].state_id">
              <option value="">Seleccione</option>
              <option v-for="state in Allstates" :key="state.id" :value="state.id">{{ state.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="address-prov">Municipio:</label>
            <select  class="form-control" @change="loadParroquiaHab($event)" v-model="userData.habDirection[0].region_id">
              <option value="">Seleccione</option>
              <option v-for="region in Allregions" :key="region.id" :value="region.id">{{ region.name }}</option>
            </select>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="address-prov">Parroquia:</label>
            <select  class="form-control" v-model="userData.habDirection[0].city_id">
              <option value="">Seleccione</option>
              <option v-for="city in Allcities" :key="city.id" :value="city.id">{{ city.name }}</option>
            </select>
          </div>
        </div>
      </div>
  
      <!-- Demás campos -->
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label for="address-urb">Urbanización / Empresa:</label>
            <input  type="text" class="form-control" id="address-urb" name="address-urb" v-model="userData.habDirection[0].urb">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="address-av">Sector, Avenida, calles, veredas:</label>
            <input  type="text" class="form-control" id="address-av" name="address-av" v-model="userData.habDirection[0].sector">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="address-num">Número de casa / Local / Apto / Piso:</label>
            <input  type="text" class="form-control" id="address-num" name="address-num" v-model="userData.habDirection[0].nro_home">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="address-post">Código postal:</label>
            <input  type="text" class="form-control" id="address-post" name="address-post" v-model="userData.habDirection[0].zip_code">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label for="address-ref">Punto de Referencia (opcional):</label>
            <input  type="text" class="form-control" id="address-ref" name="address-ref" v-model="userData.habDirection[0].reference_point">
          </div>
        </div>
      </div>
  
      <div class="col-lg-14">
        <div class="form-group">
          <button  class="btn btn-submit" @click="update_profile(userData)" type="button">GUARDAR CAMBIOS</button>
        </div>
      </div>
      
        </div>
      
    </div>
    <div v-else>
    <!-- Indicador de progreso -->
    <div class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </div>
  </template>
  

<script>
export default {
  data() {
    return {
        propsLoaded: false,
        userData: null,
     
    };
  },
  props:{
    Allregions: Array,
    Allstates:Array,
    Allcities:Array,
  },
  async created() {
    // Verificar si todas las props están cargadas
    const response = await fetch(URLHOME+ "api_rapida.php?evento=obtenerTodo");
      const data = await response.json();
      
      // Asignar los datos del usuario a la propiedad userData
      this.userData = data;
   
    if ( this.userData && this.Allregions && this.Allstates && this.Allcities) {
      this.propsLoaded = true;
    }


    
  },
  methods: {
    async loadMunicipioHab(event) {
    try {
        const state_id = event.target.value;

        // Verificar si state_id es un valor válido
        if (!state_id) {
            console.error('State ID no es válido');
            return;
        }

        const response = await axios.get(URLSERVER + "api/regions/state/" + state_id);

        // Verificar si la solicitud fue exitosa y si hay datos en la respuesta
        if (response && response.status === 200 && response.data && response.data.data) {
            this.Allregions = response.data.data;
        } else {
            console.error('Error al cargar las regiones o la respuesta está incompleta.');
        }
    } catch (error) {
        // Capturar y manejar errores
        console.error('Error al cargar las regiones:', error.message);
    }
},

async loadParroquiaHab(event) {
			try {
				const region_id = event.target.value;

				// Verificar si region_id es un valor válido
				if (!region_id) {
					console.error('Region ID no es válido');
					return;
				}

				const response = await axios.get(URLSERVER + "api/cities/region/" + region_id);

				// Verificar si la solicitud fue exitosa y si hay datos en la respuesta
				if (response && response.status === 200 && response.data && response.data.data) {
					this.Allcities = response.data.data;
				} else {
					console.error('Error al cargar las ciudades o la respuesta está incompleta.');
				}
			} catch (error) {
				// Capturar y manejar errores
				console.error('Error al cargar las ciudades:', error.message);
			}
		},
        async update_profile(user)
			{
				const that = this;
				console.log("this user> antes de guardarse",user);

				const user_data = {
					...user,
          ...user.habDirection[0],
				
					};
					console.log("esto es user_data", user_data);
				await axios.post(URLSERVER+'api/update_profile', {
                    user_data: user_data,
                })
                .then(function (response) {
                	console.log(response.data);
					that.userData = user_data;
          console.log("valor de that.userData",that.userData);
					fetch(URLHOME+ "api_rapida.php?evento=obtenerTodo");
					Swal.fire(
						'Perfil',
						'Tus datos han sido guardado exitosamente',
						'success'
					);
                })
                .catch(function (error) {
                	console.log("esto es el error",error);
                });
			},
     }
};
</script>
