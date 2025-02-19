
<template>

<div class="col-12">
    <div v-for="(direction, index) in userData?.directions"
        :key="direction.id" :id="'address-' + index"
        class="address-section">
        <div class="row">

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="address-1-state">Estados:</label>
                    <!-- <button class="btn btn-edit-info" type="button"><img src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img src="assets/img/confirmar-bio-mercados.svg"></button> -->
                    <select class="form-control"
                        @change="loadMunicipio($event)"
                        v-model="direction.state_id">
                        <option value="">Seleccione</option>

                        <option v-for="state in Allstates" :key="state.id"
                            :value="state.id">{{ state.name }}</option>
                    </select>
                    <!-- <input type="text" class="form-control dropdown-toggle"  data-toggle="dropdown" aria-expanded="false" id="address-1-state" name="address-1-state" disabled="disabled"  autocomplete="off"> -->
                    <!-- <div class="dropdown-menu dropdown-menu-state">
                        <div class="dropdown-item" v-for="state in states" :key="state.id">
                            <div class="form-check form-check-radio">
                                <input type="radio" class="form-check-input" :id="state.name+'-address-1'" name="radio-address-1" v-model="state.name">
                                <label :for="state.name+'-address-1'" class="custom-check">{{state.name}}</label>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="address-prov">Municipio:</label>
                    <!-- <button class="btn btn-edit-info" type="button"><img src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img src="assets/img/confirmar-bio-mercados.svg"></button> -->
                    <!-- <input type="text" class="form-control" id="address-prov" name="address-prov" disabled="disabled" v-model="direction.ciudad"> -->
                    <select class="form-control"
                        @change="loadParroquia($event)"
                        v-model="direction.region_id">
                        <option value="">Seleccione</option>
                        <option v-for="region in regions" :key="region.id"
                            :value="region.id">{{ region.name }}</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="address-prov">Parroquia:</label>
                    <!-- <button class="btn btn-edit-info" type="button"><img src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img src="assets/img/confirmar-bio-mercados.svg"></button> -->
                    <!-- <input type="text" class="form-control" id="address-prov" name="address-prov" disabled="disabled" v-model="direction.ciudad"> -->
                    <select class="form-control"
                        v-model="direction.city_id">
                        <option value="">Seleccione</option>
                        <option v-for="city in cities" :key="city.id"
                            :value="city.id">{{ city.name }}</option>
                    </select>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address-name">Dirección Corta (ejm: Mi Casa,
                        Mi Oficina):</label>
                    <button class="btn btn-edit-info" type="button"><img
                            src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img
                            src="assets/img/confirmar-bio-mercados.svg"></button>
                    <input type="text" class="form-control"
                        id="address-name" name="address-name"
                        disabled="disabled" v-model="direction.address">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address-urb">Urbanización / Empresa:</label>
                    <button class="btn btn-edit-info" type="button"><img
                            src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img
                            src="assets/img/confirmar-bio-mercados.svg"></button>
                    <input type="text" class="form-control" id="address-urb"
                        name="address-urb" disabled="disabled"
                        v-model="direction.urb">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address-av">Sector, Avenida, calles,
                        veredas:</label>
                    <button class="btn btn-edit-info" type="button"><img
                            src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img
                            src="assets/img/confirmar-bio-mercados.svg"></button>
                    <input type="text" class="form-control" id="address-av"
                        name="address-av" disabled="disabled"
                        v-model="direction.sector">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address-num">Número de casa / Local / Apto /
                        Piso:</label>
                    <button class="btn btn-edit-info" type="button"><img
                            src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img
                            src="assets/img/confirmar-bio-mercados.svg"></button>
                    <input type="text" class="form-control" id="address-num"
                        name="address-num" disabled="disabled"
                        v-model="direction.nro_home">
                </div>
            </div>



            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address-post">Código postal:</label>
                    <button class="btn btn-edit-info" type="button"><img
                            src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img
                            src="assets/img/confirmar-bio-mercados.svg"></button>
                    <input type="text" class="form-control"
                        id="address-post" name="address-post"
                        disabled="disabled" v-model="direction.zip_code">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address-ref">Punto de Referencia
                        (opcional):</label>
                    <button class="btn btn-edit-info" type="button"><img
                            src="assets/img/editar-bio-mercados.svg"></button>
                    <button class="btn btn-confirm-info" type="button"><img
                            src="assets/img/confirmar-bio-mercados.svg"></button>
                    <input type="text" class="form-control" id="address-ref"
                        name="address-ref" disabled="disabled"
                        v-model="direction.reference_point">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <button class="btn btn-submit"
                        @click="saveDirection(direction, index)"
                        type="button">GUARDAR CAMBIOS</button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <button class="btn btn-delete-section"
                        @click="deleteDirection(direction, index)"
                        type="button">Eliminar Dirección <img
                            src="assets/img/eliminar-bio-mercados.svg"></button>
                        </div>
                    </div>
                </div>
                    
            </div>
                                <div class="col-12">
                                    <button type="button" @click="showAddDirection()"
                                        class="btn btn-add-section">Agregar nueva dirección <img
                                            src="assets/img/nueva-direccion-bio-mercados.svg"></button>
                                </div>
            </div>

</template>


<script>
export default {
  data() {
    return {
        propsLoaded: false,
        userData: null,
        localRegions: [],
        regions:[],
        cities:[],

    };
  },

  mounted(){
    this.getRegions();
    this.getCities();
  },

  props:{
    Allstates:Array,
    userlogged:Object,
  },
  
  async created() {
    // Verificar si todas las props están cargadas
    const response = await fetch(URLHOME+"api_rapida.php?evento=obtenerTodo");
      const data = await response.json();


      // Asignar los datos del usuario a la propiedad userData
      this.userData = data;
   
    if ( this.userData && this.Allregions && this.Allstates && this.Allcities) {
      this.propsLoaded = true;
    }


    
  },
  methods: {
    	async loadMunicipio(event) {
			const state_id = event.target.value;
			const response = await axios.get(URLSERVER + "api/regions/state/" + state_id);
			this.regions = response.data.data;
		},
        async loadParroquia(event) {
			const region_id = event.target.value;
			const response = await axios.get(URLSERVER + "api/cities/region/" + region_id);
			this.cities = response.data.data;
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
        saveDirection(direction, index) {
			const that = this;
			console.log("direction::> ", direction);
			console.log("direction.action::> ", direction.action);
			if (typeof direction.action === 'undefined') {

				axios.put(URLHOME+'api/user_address/' + direction.id, {
					id: direction.id,
					cities_id: direction.city_id,
					address: direction.address,
					status: direction.status,
					users_id: direction.users_id,
					created_at: direction.created_at,
					updated_at: direction.updated_at,
					zip_code: direction.zip_code,
					urb: direction.urb,
					sector: direction.sector,
					nro_home: direction.nro_home,
					reference_point: direction.reference_point,
					city_id: direction.city_id,
					ciudad: direction.ciudad,
				})
					.then(function (response) {
						Swal.fire("Direccion Actualizada exitosamente");
						fetch(URLHOME+ "api_rapida.php?evento=obtenerDireccion");
					})
					.catch(function (error) {
						console.log(error);
					});

			} else {
				console.log("esta entrando por el POST");
				axios.post(URLHOME+'api/user_address', {
					id: direction.id,
					cities_id: direction.city_id,
					address: direction.address,
					status: direction.status,
					users_id: direction.users_id,
					updated_at: direction.updated_at,
					zip_code: direction.zip_code,
					urb: direction.urb,
					sector: direction.sector,
					nro_home: direction.nro_home,
					reference_point: direction.reference_point,
					city_id: direction.city_id,
					ciudad: direction.ciudad,
				})
					.then(function (response) {
						console.log(response);
						Swal.fire("Direccion Guardada exitosamente");
						fetch(URLHOME+ "api_rapida.php?evento=obtenerDireccion");
					})
					.catch(function (error) {
						console.log(error);
					});

			}

		},
		deleteDirection(direction, index) {

			Swal.fire({
				title: 'Eliminar Dirección',
				text: "¿Desea eliminar su dirección?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Eliminar!',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.value) {
					this.userlogged.directions.splice(index, 1);

					axios.delete(URLHOME+ 'api/user_address/' + direction.id, {
						id: direction.id,
					})
						.then(function (response) {
							fetch(URLHOME+ "api_rapida.php?evento=obtenerDireccion");
						})
						.catch(function (error) {
							console.log(error);
						});
					Swal.fire(
						'Eliminado!',
						'Su dirección ha sido borrada.',
						'success'
					)
				}
			})


		},
        showAddDirection() {
			if (this.userlogged.directions == true) {
				this.userlogged.directions = [];
			}
			this.userlogged.directions.push({
				id: '',
				cities_id: '1',
				address: '',
				status: '',
				users_id: this.userData.id,
				created_at: '',
				updated_at: '',
				zip_code: '',
				urb: '',
				sector: '',
				nro_home: '',
				reference_point: '',
				city_id: '',
				state_id: '',
				region_id: '',
				ciudad: '',
				action: 'save',
			});

			this.userData = this.userlogged;

		},
        async getRegions() {
			const response = await axios.get(URLSERVER + "api/regions");
			this.regions = response.data.data;

	
		},
		async getCities() {
			const response = await axios.get(URLSERVER + "api/cities");
			this.cities = response.data.data;

		
		},
       
     }
};
</script>
