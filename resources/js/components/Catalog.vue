<template>
	<section id="catalogo" class="main-content">
		<div class="container-fluid">
			<div class="row">
				<div id="sidebar">
					<div class="products-order">
						<div class="form-group">
							<span>Mostrando</span>
							<select id="show" class="form-control" v-model="limitP">
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
								<option value="-1">Todos</option>
							</select>
							<span>Resultados de {{products.total}}</span>
						</div>
						<div class="form-group">
							<h5>Organizar por:</h5>
							<select id="order-by" class="form-control" v-model="orderP">
								<option value="AZasc">De A -> Z</option>
								<option value="ZAdesc">De Z -> A</option>
								<option value="Pasc">Precio - De menor a mayor</option>
								<option value="Pdesc">Precio - De mayor a menor</option>
							</select>
						</div>
					</div>
					<div class="filter-options">
						<h3 class="filter-title" data-toggle="collapse" href="#filters-content" role="button" aria-expanded="false" aria-controls="filters-content">
							<img src="assets/img/filtro-bio-mercados.svg">Filtrar por <img class="rotate-img" src="assets/img/botón-circular-bio.svg">
						</h3>
						<div id="filters-content" class="collapse">
							<!-- * FILTRO DE PRECIOS -->
							<div class="filter filter-price">
								<h4>Precio</h4>
			

								<div class="range-slider">
								    <input type="text" class="js-range-slider" value="" />
								</div>
								  <hr>
								<div class="extra-controls">
									  <div class="form-group">
									    <input type="number" class="js-input-from form-control" v-model="min_price" />
									    <input type="number" class="js-input-to form-control" v-model="max_price" />
									</div>
								 </div>
								

							</div>
							<div class="filter filter-offers">
								<h4>Ofertas</h4>
								<div class="form-group">
									<input type="radio" class="check-box" id="mas-reciente" title="Mas Recientes" name="radioOferta" value="mr" v-model="filterP">
									<label for="mas-reciente">Más Recientes</label>
								</div>
								<div class="form-group">
									<input type="radio" class="check-box" id="mas-buscados" title="Mas Buscados" name="radioOferta" value="mb" v-model="filterP">
									<label for="mas-buscados">Más Buscados</label>
								</div>
								<div class="form-group">
									<input type="radio" class="check-box" id="mas-vendidos" title="Mas Vendidos" name="radioOferta" value="mv" v-model="filterP">
									<label for="mas-vendidos">Más Vendidos</label>
								</div>
								<div class="form-group">
									<input type="radio" class="check-box" id="mejor-precio" title="Mejor Precio" name="radioOferta" value="mj" v-model="filterP"> 
									<label for="mejor-precio">Mejor Precio</label>
								</div>
							</div>
							<div class="filter filter-tags">
								<h4>Por Etiquetas</h4>
								<span v-for="(t,index) in tags" :key="t" class="hashtag" @click="putToggle($event,index)">{{t}}</span>
							</div>
						</div>
					</div>
					<div class="bio-ads">
						<div class="ad-box">
							<Slider :id="'slider_catalog1'" :sliders="ads_a"></Slider>
							<Slider :id="'slider_catalog2'" :sliders="ads_b"></Slider>
							<Slider :id="'slider_catalog3'" :sliders="ads_c"></Slider>
							<Slider :id="'slider_catalog4'" :sliders="ads_d"></Slider>
						</div>
						<!-- <div class="ad-box" v-for="a in ads" :key="a.url">
							<a :href="a.url"><img :src="'storage/'+a.image"></a>
						</div> -->
					</div>
				</div>
				<div id="content">

					
					<!--Filtros seleccionados-->
					<ul id='selected-filters'></ul>
					<!--Fin filtros seleccionados-->


					<div class="products-order">
						<div class="form-group">
							<span>Mostrando</span>
							<select id="show" class="form-control" v-model="limitP">
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="50">50</option>
								<option value="100">100</option>
								<option value="-1">Todos</option>
							</select>
							<span>Resultados de {{products.total}}</span>
						</div>
						<div class="form-group">
							<h5>Organizar por:</h5>
							<select id="order-by" class="form-control" v-model="orderP">
								<option value="AZasc">De A -> Z</option>
								<option value="ZAdesc">De Z -> A</option>
								<option value="Pasc">Precio - De menor a mayor</option>
								<option value="Pdesc">Precio - De mayor a menor</option>
								<!-- <option value="2">Más Vendidos</option>
								<option value="2">Más Recientes</option> -->
							</select>
						</div>
					</div>

					<ProductList v-if="products" v-on:getpage="pageclick" :tasadolar="tasadolar" :products="products" :user_id="datauser.id"></ProductList>

					<div class="bio-ads">
						<Slider :sliders="ads_a"></Slider>
						<!-- <div class="ad-box" v-for="a in ads" :key="a.url">
							<a :href="a.url"><img :src="'storage/'+a.image"></a>
						</div> -->
						
					</div>
				</div>
			</div>
		</div>
		
	</section>
</template>
<script>
	import ProductList from './ProductCatalog.vue';
	import Slider from './SliderVertical.vue';

    export default {
        data() {
            return {
				id: 0,
				cat: 0,
				search: '',
				sParam: '',
				idParam: '',
				fTags: '',
				selectedTags:'',
				products: {},
				filterP: '',
				limitP: 20,
				orderP: 'AZasc',
				rangeP: '',
				min_price: 0,
				max_price: 50,
				page: 1,
            	datauser:[],

            }
		},
		components: {
			ProductList,
			Slider
        },
		props: {
			userlogged: Object,
			tasadolar: Number,
			tags: Array,
			ads_a: Array,
			ads_b: Array,
			ads_c: Array,
			ads_d: Array
		},
        methods: {
			filterProducts: async function() {
				const response = await axios.get(URLSERVER+'api/products?'+this.filtros);
				this.products = response.data?.data;
				console.log("filterProducts: ",response.data);
			},
			putToggle(event) {
				let tmp = [];
				event.target.classList.toggle('hashtag_active');
				document.querySelectorAll(".hashtag_active").forEach( a => {
				 	tmp.push(a.innerHTML.replace("#",""));
				});
				this.selectedTags = tmp.join(" ");
				if(!!this.selectedTags) {
					this.fTags = "&tags="+this.selectedTags;
				}else {
					this.fTags = '';
				}
			},
			pageclick(value) {
				this.page = value;
			},
			isObject: function(o) 
			{ 
				return typeof o == "object" 
			},
		
        },
        mounted() {
        	console.log("ads::> ",this.ads);
			if(this.isObject(this.userlogged)){
				this.datauser = this.userlogged;
			}else{
				console.log("Not logout");
				this.datauser.id = 'undefined';
			}

			if(!!window.location.href.split("cat=")[1]){
				this.cat = window.location.href.split("cat=")[1].split("&search=")[0] || 0;
			}
			
			if(!!window.location.href.split("search=")[1]) {
				this.search = window.location.href.split("search=")[1] || '';	
				this.sParam = "&search="+this.search;
			}

			if(!!window.location.href.split("id=")[1]) {
				this.id = window.location.href.split("id=")[1] || 0;	
				this.idParam = "&id="+this.id;
			}

		},
		computed: {
			filtros: function() {
				const params = [];

				// Se agregan los filtros solo si tienen valores válidos
				if (this.filterP) {
					params.push(this.filterP);
				}

			
				
				if (this.cat) {
					params.push(`cat=${this.cat}`);
				}
				if (this.limitP) {
					params.push(`limit=${this.limitP}`);
				}
				if (this.orderP) {
					params.push(`order=${this.orderP}`);
				}
				// El filtro de this.min_price y this.max_price se debe ajustar a una logica flexible.
				// Siempre filtra por un rango de precios por default.
				// Se habilitara un boton que habilite el filtro por rango de precios para evitar ser siempre enviado en los filtros de la URL...
				if (this.min_price || this.max_price) {
					params.push(`precio=${this.min_price},${this.max_price}`);
				}

				if (this.page) {
					params.push(`page=${this.page}`);
				}
				if (this.sParam) {
					params.push(this.sParam);
				}
				if (this.fTags) {
					params.push(this.fTags);
				}
				if (this.idParam) {
					params.push(this.idParam);
				}

				console.log(params);
				
				// Se une todos los parámetros en una cadena
				return params.length ? '&' + params.join('&') : '';
			}
		},
		created: function() {
			// console.log("ads::> ",this.ads);
			this.getDebounceProducts = _.debounce(this.filterProducts,100);
		},
		watch: {
			filtros: function() {
				// this.filterProducts();
				this.getDebounceProducts();
			}
		}
    }
</script>
