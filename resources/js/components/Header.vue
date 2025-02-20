<template>
    <header id="myHeader" style="margin-bottom: 40px;  ">
		<!-- <div class="top-header color-white">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="top-info">
							<a href="mailto:contacto@biomercado.com">contacto@biomercado.com</a>
							<a href="tel:584241234567">+58 424 123 4567</a>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="middle-header" style="position: relative; background-color: white;">
			<div class="container-fluid container-movil">
				<div class="row align-items-center-md">
					<div id="toggler-header" class="col-3">
						<button class="navbar-toggler toggle-menu" type="button">
							<img src="/assets/img/Menu.png" alt="Menu Bars">
						</button>
					</div>
					<div id="brand-header" class="col-lg-2 col-4">
						<a  href="/" class="navbar-brand"><img  src="/img/Logo.png" alt="Bio Mercados" style="width: 80%; height: auto"></a>
					</div>

					<div id="search-header" class="col-lg-6 col-md-14">
						<form class="form-inline" style=" display: flex; align-items: center;justify-content: space-between;width: 100%;" v-on:submit="search()">
							<div style="display: flex; width: 90%; align-items: center ;  ">
							<input class="form-control" style="  flex-grow: 1;  border-top-left-radius: 100px;border-bottom-left-radius: 100px; padding: 10px;"id="bio-search" type="text" placeholder="Buscar Productos" aria-label="Search" v-on:input="SearchProducts($event)" v-model="searchText" autocomplete="off">
							
							<button class="btn btn-search"  style=" height: 39px; display: flex; align-items:  center; justify-content: center; background-color: #203876; padding: 5px 5px; border-top-right-radius: 100px; border-bottom-right-radius: 100px;margin-left: -1px;cursor: pointer;  font-size: 16px; " type="button" @click="search()">
								 <img style=" width: 20px; height: 20px; margin-right: 10px;" src="/assets/img/Lupa.png"> <span style="color: white; padding: 10px 15px" >Buscar</span>
							</button>
						    </div>
							
							<div class="keyup_search" :style="{ display: dSearch }">
								<span  :style="{display: gifSearch}">Cargando.....</span>
								<ol>
									<li v-for="ser in searched" :key="ser.id" @click="goToCatalog(ser.id)">
										<img v-if="ser.photo" :style="{ width: '6%' }" :src="ser.photo">
										{{ ser.name }}
									</li>

								</ol>
							</div>
						</form>
					</div>
					
					<div id="nav-header" class="col-lg-4 col-5">
						<ul>
							<!-- no loggeado-->
							<li id="nav-login" class="dropdown" style="width: 25%;" >
								<a href="#" v-if="!userlogged" id="navbarLogin" class="navbarLogin" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div style="display: flex; width: 45%; align-items: center; justify-content: space-between">
									
									<img src="/assets/img/Usuario.png" alt="Login"  > 
								   </div>
								</a>
				
								<!-- el login-->
								<div class="dropdown-menu  login_navbar" aria-labelledby="navbarLogin" style=" background-color: #203876;">
									<form action="#">
										<h3>Acceder a la cuenta</h3>
										<div class="form-group">
											<label>Correo electrónico</label>
											<input type="text" class="form-control" name="email" v-model="user.email">
										</div>
										<div class="form-group">
											<label>Contraseña</label>
											<input type="password" class="form-control" name="password" v-model="user.pass" @keypress="enterLogin($event)">
										</div>
										<div class="form-group">
											<input type="checkbox"> Recordar Contraseñas
										</div>
										<div class="form-group">
											<button type="button" @click="login()" class="btn">Entrar</button>
										</div>
										<div class="form-group form-group-register">
											<small>¿No tienes cuenta? <a  href="/join" class="white">Registrate aquí</a></small>
											<small><a href="/recover" class="white">Olvidó su Contraseña?</a></small>
										</div>
									</form>
								</div>
							</li>
							<!-- no loggeado -->
							<!-- loggeado -->
							<li id="nav-logged" v-if="!!userlogged">
								<a href="/profile"><img :src="userlogged.avatar" alt="User" style="margin-left:15px !important;"><span class="link-text" style="color: black;"v-if="!!userlogged"> {{userlogged.name}}</span></a> 
								<a href="javascript:void(0)" @click="logout()" class="logout">
									<img src="/assets/img/Derecha@2x.png">
								</a>
							</li>
							<!-- loggeado -->
							
							<li id="nav-cart" data-toggle="tooltip" data-placement="bottom" title="Haga click para ver el carrito">
								<a href="/cart"><img src="/assets/img/Carrito.png" alt="Cart" ><span class="quantity-span" >{{ cant_cart }}</span></a>
							</li>

							<li id="nav-fav" v-if="userlogged" data-toggle="tooltip" data-placement="bottom" title="Haga click para ver sus favoritos">
								<a href="/profile?tab=my-favorites"><img src="/assets/img/Favorito.png" alt="Favorites"><span class="quantity-span">{{cant_favorite}}</span></a>
							</li>

							<!-- loggeado -->
							<!--<li id="nav-logout"><a href="javascript:void(0)" @click="logout()"><img src="/assets/img/icono-salir-bio.png"></a></li>-->
							<!-- loggeado -->
						</ul>

					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-light color-white navbar-custom" style=" width: 80%; background-color: white; border-bottom: 1px solid #ccc; padding: 0;">
			<div class="container-fluid" style=" width: 100%; position: relative; padding: 0px 0;">
				<div id="mainNavbar">
					<div id="top-info" class="w-100 align-items-center">
						<div class="col-md-12 text-right">
							<button class="navbar-toggler toggle-menu" type="button">
								<img src="/assets/img/x.svg" style="fill: gray" alt="Menu Bars">
							</button>
						</div>
					</div>
					<div>
						<ul class="navbar-nav" style="display: flex;align-items: left; padding-right: 15px;">
							<li id="nav-categories" class="nav-item dropdown">
							<a class="nav-link" href="#" id="navbarCategories" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div style="width: 100%; display: flex; align-items: left; justify-content: center; padding-left: 100px; ">
								<img src="/assets/img/Menu.png" style="width: 55px; height: 35px; padding-right: 10px;" alt="Menu">
								<span style="color: black; font-weight: 800; font-size: 16px; font-family: Arial, Helvetica, sans-serif; padding-left: 15px; padding-right: 15px;" >Todas las categorías</span>
								<hr  style="width: 2px; height: 35px; background-color: black; border: none; margin: 0px 6px; opacity: 0.3;" >
							</div>
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="margin-left: -10px; background-color: #203876; height: 600px; overflow-y: scroll; ">
								
								<a v-for="cat in categories.slice(5)" :key="cat.id" class="dropdown-item" :href="'/catalog?cat='+cat.id">{{cat.name}}</a>
						</div>
						</li> 
						
						<li class="nav-item" v-for="cat in categories.slice(0,5)" :key="cat.id">
							<a class="nav-link" :href="'/catalog?cat=' + cat.id" style="display: flex; align-items: center;">
							<span style="font-family: Arial, Helvetica, sans-serif; font-weight: 900; color: black; display: flex; align-items: center;">
								{{ cat.name + " " }}
								<img src="/assets/img/Abajo.png" alt="icon" style="margin-left: 5px;">
							</span>
							</a>

						</li>
					
						<li id="nav-all-categories" class="nav-item dropdown">
							<div class="dropdown-menu" aria-labelledby="navbarCategories" style="height: 600px; overflow-y: scroll;">
								<a v-for="cat in categories" :key="cat.id" class="dropdown-item" :href="'/catalog?cat='+cat.id" >{{cat.name}}</a>
							</div>
						</li>
						<li id="nav-bios" class="nav-item dropdown">
						
							<!-- <div class="dropdown-menu" aria-labelledby="navbarBios">
								<a class="dropdown-item" href="/culture">Cultura bio</a>
								<a class="dropdown-item" href="/sucursal">Sucursales</a>
								<a class="dropdown-item" target="_blank" href="http://portalproveedores.biomercados.com.ve:18880/webui/">Proveedores</a>
								<a class="dropdown-item" href="/contact">Contacto</a>
							</div> -->
						</li>
					</ul>
					</div>
				</div>
			</div>
		</nav>
	</header>
</template>
<script>

export default {
    data() {
        return {
			cant_cart: 0,
			cant_favorite: 0,
			saldo: 0,
			categories: [],
			products: [],
			searched: {},
			dSearch: 'none',
			gifSearch:'none',
			searchText: '',
			user: {
				name: '',
				email: '',
				pass: ''
			},
			logged: false
        }
	},
	props: {
		userlogged: Object,
	},
    methods: {
    	getAmountBW: async function(){
    		if(this.userlogged){
    			await axios.get(URLHOME+'api/getAmountBW/'+this.userlogged.id).then( datos => {
	    			this.saldo = datos.data;
	    		});
    		}
    	},

		

		search() {
			const route = "/catalog?search="+this.searchText;
			window.location.href = route;
			event.preventDefault();
		},
		goToCatalog(id) {
			const route = "/catalog?id="+id;
			window.location.href = route;
			event.preventDefault();
		},
        async getCategories() {
			const response = await axios.get(URLSERVER+"api/categories");
			this.categories = response.data.data;
		},
		async SearchProducts(e) {
			const len = e.target.value.length;
			let loader = this.gifSearch;
			const val = e.target.value;
			this.searched = {};
			if(len >= 3) {
				this.gifSearch = 'block';
				const response = await axios.get(URLSERVER+"api/products/search/"+val);
				this.searched = response.data.data;
				this.dSearch = 'block';
				this.gifSearch = 'none';

			} else {
				this.dSearch = 'none';
				this.gifSearch = 'none';
				
			}
		},
		async getFavorites() {
			const response = await axios.get(URLSERVER+"api/favorites");
			if(response.data.data.length > 0) {
				this.cant_favorite = response.data.data.length;
			}else {
				this.cant_favorite = 0;
			}
		},
		async enterLogin(event) {
			//13 es igual a enter
			if(event.keyCode == 13 || event.key=="Enter") {
				await this.login();
			}
		},
		async login() {
    // Asegurémonos de que el usuario haya proporcionado un correo electrónico y una contraseña
    if (!this.user.email || !this.user.pass) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Por favor, ingrese su correo electrónico y contraseña',
        });

        return; // Detener la ejecución si falta el correo electrónico o la contraseña
    }

	

    // Realizar la solicitud GET al servidor para iniciar sesión
    await axios.get(`${URLSERVER}api_rapida.php?evento=login&email=${this.user.email}&password=${this.user.pass}`)
        .then(response => {
            // Verificar si la solicitud fue exitosa
			console.log("esta es la respuesta de login ", response.data);
            if (response.data.success === false) {
                // Si la solicitud fue exitosa pero hubo un error de inicio de sesión
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.data.msj_general || 'Error al iniciar sesión',
                });
            } else {
                // Si el inicio de sesión fue exitoso, redirigir al usuario a la página principal
                location.href = window.location.href;
            }
        })
        .catch(error => {
            // Si hubo un error en la solicitud (por ejemplo, error de red o servidor no disponible)
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Las credenciales ingresadas no son correctas. Por favor, verifica tu información e inténtalo de nuevo.",

            });
            console.error('Error en la solicitud:', error);
        });



},

		async logout()
		{
			localStorage.clear();
			localStorage.setItem('ModalPrincipal','visto');
			await axios.get(URLSERVER+"api_rapida.php?evento=logout").then( () => {
				location.href = URLSERVER;
			});
		}
    },
    created() {
        EventBus.$on('update_cantCart', data => {
            this.cant_cart = data;
		});
		
		EventBus.$on('update_cantFavorite', data => {
            this.cant_favorite = data;
        });
    },
    mounted() {
		console.log("esto es la cantidad de cant_cart", this.cant_cart);
		this.getCategories();
		this.getFavorites();
		this.getAmountBW();
		if( window.localStorage.getItem("cartNew") ){
			const _this = this;
			JSON.parse(window.localStorage.getItem("cartNew")).forEach ( (a) => {
				_this.cant_cart += parseInt(a.cant);
			});
		}else{
			this.cant_cart = 0;
		}
    }
}
</script>
