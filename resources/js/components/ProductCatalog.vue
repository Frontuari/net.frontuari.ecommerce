<template>
    <div class="product-list">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 col-lg-12" v-for="product in products.data" v-bind:key="product.id">
                    <div class="product-block">
                        <div class="product-img">
                            <div :id="'slider'+product.id" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ul class="carousel-indicators">
                                <!-- Indicador del carrusel -->
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            </ul>
                            <div class="carousel-inner">
                                <!-- Contenido del carrusel -->
                                <div class="carousel-item active">
                                    <!-- Imagen del carrusel -->
                                    <img :src="product.photo" class="d-block w-100" alt="Imagen del carrusel">
                                </div>
                            </div>

                                <!-- Left and right controls -->
                                <a class="carousel-control-prev" :href="'#slider'+product.id" data-slide="prev">
                                    <span class="carousel-control-prev-icon" ></span>
                                </a>
                                <a class="carousel-control-next" :href="'#slider'+product.id" data-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </a>
                            </div>
                            <!-- fin del carrusel-->
                            <div class="product-actions">
                                <button type="button" class="btn" @click="addToCart(product,cant_product[product.id])">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.31 15"><title>añadir-carrito-bio</title><g id="Capa_2" data-name="Capa 2"><g id="Guias_y_recursos" data-name="Guias y recursos"><path class="cls-1" d="M13.2,11.58H8.83a.45.45,0,1,0,0,.9H10.1a.81.81,0,1,1-.81.81.46.46,0,0,0-.91,0,1.72,1.72,0,1,0,3.22-.81h1.6a.45.45,0,1,0,0-.9Z"/><path class="cls-1" d="M14.21,3.33a.48.48,0,0,0-.35-.16H4V1.35A.45.45,0,0,0,3.67.92L.58,0A.45.45,0,0,0,0,.32a.45.45,0,0,0,.3.56l2.77.81v9.89H2.65a.45.45,0,0,0,0,.9h2.6a.81.81,0,1,1-.81.81.45.45,0,1,0-.9,0,1.72,1.72,0,1,0,1.71-1.71H4v-.77h8.52a.43.43,0,0,0,.22-.06.46.46,0,0,0,.22-.3L14.3,3.71A.48.48,0,0,0,14.21,3.33Zm-.9.74L13,5.39H4V4.07ZM4,9.91V8.59H10.1a.45.45,0,0,0,0-.9H4V6.29h8.87l-.72,3.62Z"/></g></g></svg>
                                </button>
                                <button type="button" class="btn" @click="addToFavorite(product,user_id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.93 15"><title>añadir-favorito-bio</title><g id="Capa_2" data-name="Capa 2"><g id="Guias_y_recursos" data-name="Guias y recursos"><path class="cls-1" d="M4.7,7.56a.42.42,0,0,1-.42-.42V3.5H14.51a.43.43,0,0,1,0,.85H5.13V7.14A.42.42,0,0,1,4.7,7.56Z"/><path class="cls-1" d="M14.93,15H7.19a.43.43,0,0,1,0-.85h6.9V5.09a.42.42,0,1,1,.84,0Z"/><path class="cls-1" d="M11.53,6a.42.42,0,0,1-.42-.43V2a1,1,0,0,0-.43-.84A1.86,1.86,0,0,0,9.6.85C9,.85,8,1.15,8,2V5.53a.42.42,0,1,1-.84,0V2A2.18,2.18,0,0,1,9.6,0,2.12,2.12,0,0,1,12,2V5.53A.43.43,0,0,1,11.53,6Z"/><path class="cls-1" d="M8.74,8.11a2.23,2.23,0,0,0-1.63-.77A3.6,3.6,0,0,0,4.7,8.39,3.58,3.58,0,0,0,2.3,7.34a2.23,2.23,0,0,0-1.63.77A2.51,2.51,0,0,0,0,10.31C.32,12,2,13.69,4.52,15a.39.39,0,0,0,.18,0,.41.41,0,0,0,.19,0c2.57-1.27,4.2-3,4.48-4.65A2.51,2.51,0,0,0,8.74,8.11Zm-.21,2.06c-.1.66-.7,2.34-3.83,3.93C1.57,12.51,1,10.83.87,10.17a1.68,1.68,0,0,1,.4-1.47h0a1.39,1.39,0,0,1,1-.51h0a3.14,3.14,0,0,1,2,1.09.44.44,0,0,0,.6,0A3.15,3.15,0,0,1,7.09,8.18a1.41,1.41,0,0,1,1,.51h0A1.63,1.63,0,0,1,8.53,10.17Z"/></g></g></svg>
                                </button>
                                <button type="button" @click="getProduct(product)" class="btn" data-toggle="modal" data-target="#ModalProd">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.03 15"><title>visualizar-producto-bio</title><g id="Capa_2" data-name="Capa 2"><g id="Guias_y_recursos" data-name="Guias y recursos"><path class="cls-1" d="M5.77,11.54A5.77,5.77,0,0,1,1.69,1.69,5.77,5.77,0,0,1,9.85,9.85,5.74,5.74,0,0,1,5.77,11.54ZM5.77.77A5,5,0,1,0,9.3,2.23,5,5,0,0,0,5.77.77Z"/><path class="cls-1" d="M14.64,15a.4.4,0,0,1-.27-.11l-5.06-5a.37.37,0,0,1,0-.54.39.39,0,0,1,.55,0l5.06,5a.39.39,0,0,1,0,.55A.39.39,0,0,1,14.64,15Z"/></g></g></svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-content" >
                            <a href="#ModalProd" data-toggle="modal" data-target="#ModalProd" @click="getProduct(product)" class="product-title" v-if="!product.name_insuperable">{{ product.name }}</a>
                            <a href="#ModalProd" data-toggle="modal" data-target="#ModalProd" @click="getProduct(product)" class="product-title" v-if="product.name_insuperable" v-html="product.name_insuperable"></a>
                            <!-- <span class="product-info">500 g</span> -->

                            <div class="product-prices" v-if="product.impuesto > 0">
                                <p>IVA INCLUIDO</p>
                            </div>
                            <div class="product-prices" v-if="!product.impuesto">
                                <p>EXENTO DE IVA</p>
                            </div>
                            <div class="product-prices" v-if="product.impuesto > 0">
                                <p>  Bs{{ (up((product.calculado * tasadolar), 2)) | FormatNumber}} / $ {{ product.calculado | FormatDolar  }}</p>
                            </div>
                            <div class="product-prices" v-if="!product.impuesto">
                                <p>  Bs {{ (up((product.price * tasadolar), 2)) | FormatNumber }} / $ {{ product.price | FormatDolar  }}</p>
                            </div>
                        </div>
                        <div class="product-add">
                            <span class="product-info" v-if="product.qty_avaliable > 0">Disponibles: <b>{{product.qty_avaliable}} en Stock</b></span>

                            <span class="product-info" v-else>Producto<b> Agotado!</b></span>

                            <form action="">
                                <div class="product-quantity" v-if="product.qty_avaliable > 0">
                                    <label>Cantidad</label>
                                    <div class="product-quantity-group">
                                        <input :class="'cantidad_'+product.id" class="form-control" type="text" name="quantity" v-model="cant_product[product.id]" :max="product.stock" @input="updateQuantity(product)">
                                        <div class="product-quantity-buttons">
                                            <span class="max-stock" style="display:none;">{{product.qty_avaliable}}</span>
                                            <button type="button" class="btn " @click="increaseValue(product)">
                                                <img src="assets/img/increase.png" alt="Increase">
                                            </button>
                                            <button type="button" class="btn" @click="decreaseValue(product)" >
                                                <img src="assets/img/decrease.png" alt="decrease">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-buttons">

                                    <button type="button" class="btn btn-addcart-outline"  v-if="product.qty_avaliable > 0" @click="addToCart(product,cant_product[product.id])">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.31 15"><title>añadir-carrito-bio</title><g id="Capa_2" data-name="Capa 2"><g id="Guias_y_recursos" data-name="Guias y recursos"><path class="cls-1" d="M13.2,11.58H8.83a.45.45,0,1,0,0,.9H10.1a.81.81,0,1,1-.81.81.46.46,0,0,0-.91,0,1.72,1.72,0,1,0,3.22-.81h1.6a.45.45,0,1,0,0-.9Z"/><path class="cls-1" d="M14.21,3.33a.48.48,0,0,0-.35-.16H4V1.35A.45.45,0,0,0,3.67.92L.58,0A.45.45,0,0,0,0,.32a.45.45,0,0,0,.3.56l2.77.81v9.89H2.65a.45.45,0,0,0,0,.9h2.6a.81.81,0,1,1-.81.81.45.45,0,1,0-.9,0,1.72,1.72,0,1,0,1.71-1.71H4v-.77h8.52a.43.43,0,0,0,.22-.06.46.46,0,0,0,.22-.3L14.3,3.71A.48.48,0,0,0,14.21,3.33Zm-.9.74L13,5.39H4V4.07ZM4,9.91V8.59H10.1a.45.45,0,0,0,0-.9H4V6.29h8.87l-.72,3.62Z"/></g></g></svg>
                                        Añadir al carrito
                                    </button>

                                    <button type="button" class="btn btn-addfavorite" @click="addToFavorite(product,user_id)">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.93 15"><title>añadir-favorito-bio</title><g id="Capa_2" data-name="Capa 2"><g id="Guias_y_recursos" data-name="Guias y recursos"><path class="cls-1" d="M4.7,7.56a.42.42,0,0,1-.42-.42V3.5H14.51a.43.43,0,0,1,0,.85H5.13V7.14A.42.42,0,0,1,4.7,7.56Z"/><path class="cls-1" d="M14.93,15H7.19a.43.43,0,0,1,0-.85h6.9V5.09a.42.42,0,1,1,.84,0Z"/><path class="cls-1" d="M11.53,6a.42.42,0,0,1-.42-.43V2a1,1,0,0,0-.43-.84A1.86,1.86,0,0,0,9.6.85C9,.85,8,1.15,8,2V5.53a.42.42,0,1,1-.84,0V2A2.18,2.18,0,0,1,9.6,0,2.12,2.12,0,0,1,12,2V5.53A.43.43,0,0,1,11.53,6Z"/><path class="cls-1" d="M8.74,8.11a2.23,2.23,0,0,0-1.63-.77A3.6,3.6,0,0,0,4.7,8.39,3.58,3.58,0,0,0,2.3,7.34a2.23,2.23,0,0,0-1.63.77A2.51,2.51,0,0,0,0,10.31C.32,12,2,13.69,4.52,15a.39.39,0,0,0,.18,0,.41.41,0,0,0,.19,0c2.57-1.27,4.2-3,4.48-4.65A2.51,2.51,0,0,0,8.74,8.11Zm-.21,2.06c-.1.66-.7,2.34-3.83,3.93C1.57,12.51,1,10.83.87,10.17a1.68,1.68,0,0,1,.4-1.47h0a1.39,1.39,0,0,1,1-.51h0a3.14,3.14,0,0,1,2,1.09.44.44,0,0,0,.6,0A3.15,3.15,0,0,1,7.09,8.18a1.41,1.41,0,0,1,1,.51h0A1.63,1.63,0,0,1,8.53,10.17Z"/></g></g></svg>
                                        Añadir a Favoritos
                                    </button>
                                    <button type="button" class="btn btn-view" @click="getProduct(product)" data-toggle="modal" data-target="#ModalProd">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15.03 15"><title>visualizar-producto-bio</title><g id="Capa_2" data-name="Capa 2"><g id="Guias_y_recursos" data-name="Guias y recursos"><path class="cls-1" d="M5.77,11.54A5.77,5.77,0,0,1,1.69,1.69,5.77,5.77,0,0,1,9.85,9.85,5.74,5.74,0,0,1,5.77,11.54ZM5.77.77A5,5,0,1,0,9.3,2.23,5,5,0,0,0,5.77.77Z"/><path class="cls-1" d="M14.64,15a.4.4,0,0,1-.27-.11l-5.06-5a.37.37,0,0,1,0-.54.39.39,0,0,1,.55,0l5.06,5a.39.39,0,0,1,0,.55A.39.39,0,0,1,14.64,15Z"/></g></g></svg>
                                        Ver Producto
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="pagination">
                        <ul>
                            <li v-if="!!products.prev_page_url">
                                <a href="javascript:void(0)" @click="getpage(products.current_page - 1)"><img src="assets/img/prev.png" alt="Prev"></a>
                            </li>

                            <li v-for="index in products.last_page" :key="index">
                                <a href="javascript:void(0)" @click="getpage(index)" :class="products.current_page == index ? 'active' : ''">
                                    {{index}}
                                </a>
                            </li>

                            <li v-if="!!products.next_page_url">
                                <a href="javascript:void(0)" @click="getpage(products.current_page + 1)"><img src="assets/img/next.png" alt="Next"></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <ModalProducto :tasadolar="tasadolar" :product="oneproduct" :user_id="user_id"></ModalProducto>
    </div>
</template>
<script>
    import ModalProducto from './ModalProducto.vue';
    import LazyImg from './LazyImg.vue';
    export default {
        data() {
            return {
                oneproduct: {},
                page: 1,
                cant_product:[]
            }
        },
        components:{
			ModalProducto,
            LazyImg
        },
        mounted (){
            this.fetchDataArray();
        },
    
        methods: {
            updateQuantity(product) {
            console.log("esto es product", product);
            const maxStock = product.qty_avaliable;
            const minStock = 1; // Valor mínimo permitido
            const enteredQuantity = this.cant_product[product.id];

                if (enteredQuantity < minStock) {
                    this.cant_product[product.id] = minStock;
                } else if (enteredQuantity > maxStock) {
                    this.cant_product[product.id] = maxStock;
                }
        },   
            async fetchDataArray() {
             try {

        const response = await axios.get( URLHOME+'/api_rapida.php?evento=listarProductosArray');
        // Verificar si la solicitud fue exitosa y si hay datos recibidos
		console.log(response);
        if (response.data) {
			
			console.log("Esto es reponse de api",response.data);
            // Convertir el texto JSON en un objeto
            // Guardar los datos de productos en el local storage con la clave 'productosb'
            window.localStorage.setItem('productos', JSON.stringify(response.data));
            console.log('Datos de productos guardados en el local storage:', response);
        } else {
            console.error('No se pudo obtener los datos de productos o la solicitud fue fallida:', response.data.message);
        }
         } catch (error) {
        console.error('Error al realizar la solicitud:', error);
         }

        },

            getProduct: function(objP) {
                console.log(objP);
				this.oneproduct = objP;
            },
            getpage(index) {
                this.page = index;
                this.$emit("getpage",this.page);
                document.location = '#';
            },
            increaseValue(product)
            {
                const productID = product.id;
                const qty_avaliable = product.qty_avaliable;
                if(this.cant_product[productID] < qty_avaliable ) {
                    this.cant_product[productID]++;
                }
                $('.cantidad_'+productID).val(this.cant_product[productID]);
                $('.cantidad_'+productID)[0].dispatchEvent(new CustomEvent('input'));
            },
            decreaseValue(product) {
                const productID = product.id;
                const qty_avaliable = product.qty_avaliable;
                if(this.cant_product[productID] > 1 ) {
                    this.cant_product[productID]--;
                }
                $('.cantidad_'+productID).val(this.cant_product[productID]);
                $('.cantidad_'+productID)[0].dispatchEvent(new CustomEvent('input'));
            },
            up(v, n){
                return Math.ceil(v * Math.pow(10, n)) / Math.pow(10, n);
            }
        },
            created() {
                 
                    const storedProducts = window.localStorage.getItem("productos");
                    console.log("esto es productosB", storedProducts);
                    let products = JSON.parse(storedProducts);

                    console.log("esto es el valor de products", products);
            if (products.success) {

                console.log("entre aqui");

                Object.values(products).forEach(product => {
                    // Acceder a cada producto y establecer su cantidad a 1
                    this.cant_product[product.id] = 1;
                    // Aquí puedes realizar cualquier otra operación necesaria con el producto
                    console.log("estos son los productos", product);
                });
            } else {
                // Manejar el caso en el que no hay productos almacenados en el local storage
         }
        },

        props: {
            products: Object,
            images   : Array,
            tasadolar: Number,
            user_id: Number
        }
    }
</script>