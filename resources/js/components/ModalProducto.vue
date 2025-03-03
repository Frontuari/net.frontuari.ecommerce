<template>
    <div class="modal fade" id="ModalProd" tabindex="-1" role="dialog" aria-labelledby="ModalProdLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-block">
                        <div class="row" style="width: 100%">
                            <div class=" col-lg-4">
                                <div :id="'modalslider' + product.id" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->

                                    <ul class="carousel-indicators" v-if="product.photo != null">
                                        <li data-target="'#modalslider' + product.id" data-slide-to="0" class="active"></li>
                                    </ul>
                                    <!-- The slideshow -->
                                    <div class="carousel-inner" v-if="product.photo != null">
                                        <div class="carousel-item active">
                                            <img :src="product.photo" class="d-block w-100" alt="Imagen del carrusel">
                                        </div>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="carousel-control-prev" :href="'#modalslider' + product.id" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" :href="'#modalslider' + product.id" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>
                                </div>
                            </div>
                            <!-- fin del carrusel-->
                            <div class="col-lg-8">
                                <div class="product-description">
                                    <a href="#" class="product-title">{{ product.name }}</a>
                                    <span class="product-info" v-html="product.description"></span>
                                    <div class="product-prices" v-if="product.impuesto > 0">
                                        <p>IVA INCLUIDO</p>
                                    </div>
                                    <div class="product-prices" v-if="!product.impuesto">
                                        <p>EXENTO DE IVA</p>
                                    </div>
                                    <div class="product-prices" v-if="product.impuesto > 0">
                                        <p> Bs{{ (product.calculado * tasadolar) | FormatNumber  }} / $ {{ product.calculado |
                                             FormatDolar }}</p>
                                    </div>
                                    <div class="product-prices" v-if="!product.impuesto">
                                        <p> Bs{{ (product.price * tasadolar) |  FormatNumber}} / $ {{ product.price |
                                             FormatDolar}}</p>
                                    </div>
                                </div>
                                <div class="product-options">
                                    <span class="product-info" v-if="product.qty_avaliable > 0">Disponibles:
                                        <b>{{ product.qty_avaliable }} en Stock</b></span>

                                    <span class="product-info" v-else>Producto<b> Agotado!</b></span>

                                    <form action="">
                                        <div class="product-quantity" v-if="product.qty_avaliable > 0">
                                            <label>Cantidad</label>
                                            <div class="product-quantity-group">
                                                <input id="quantity" class="form-control" type="number" name="quantity"
                                                    v-model="cantModal" value="1" :min="1" @input="handleInput(product)">
                                                <div class="product-quantity-buttons">
                                                    <button type="button" class="btn" @click="increaseValue()">
                                                        <img src="assets/img/increase.png" alt="Increase">
                                                    </button>
                                                    <button type="button" class="btn" @click="decreaseValue()">
                                                        <img src="assets/img/decrease.png" alt="decrease">
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-prices">
                                            <p><b>Total:</b> Bs {{ (up((totalModal * tasadolar), 2)) | FormatNumber }} / $
                                                {{ totalModal |  FormatDolar }} </p>
                                        </div>
                                        <div class="product-buttons">
                                            <button type="button" class="btn" v-if="product.qty_avaliable > 0"
                                                @click="addToCart(product, cantModal)">Añadir al carrito</button>
                                            <button type="button" class="btn" @click="addToFavorite(product, user_id)">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.93 15">
                                                    <title>añadir-favorito-bio</title>
                                                    <g id="Capa_2" data-name="Capa 2">
                                                        <g id="Guias_y_recursos" data-name="Guias y recursos">
                                                            <path class="cls-1"
                                                                d="M4.7,7.56a.42.42,0,0,1-.42-.42V3.5H14.51a.43.43,0,0,1,0,.85H5.13V7.14A.42.42,0,0,1,4.7,7.56Z" />
                                                            <path class="cls-1"
                                                                d="M14.93,15H7.19a.43.43,0,0,1,0-.85h6.9V5.09a.42.42,0,1,1,.84,0Z" />
                                                            <path class="cls-1"
                                                                d="M11.53,6a.42.42,0,0,1-.42-.43V2a1,1,0,0,0-.43-.84A1.86,1.86,0,0,0,9.6.85C9,.85,8,1.15,8,2V5.53a.42.42,0,1,1-.84,0V2A2.18,2.18,0,0,1,9.6,0,2.12,2.12,0,0,1,12,2V5.53A.43.43,0,0,1,11.53,6Z" />
                                                            <path class="cls-1"
                                                                d="M8.74,8.11a2.23,2.23,0,0,0-1.63-.77A3.6,3.6,0,0,0,4.7,8.39,3.58,3.58,0,0,0,2.3,7.34a2.23,2.23,0,0,0-1.63.77A2.51,2.51,0,0,0,0,10.31C.32,12,2,13.69,4.52,15a.39.39,0,0,0,.18,0,.41.41,0,0,0,.19,0c2.57-1.27,4.2-3,4.48-4.65A2.51,2.51,0,0,0,8.74,8.11Zm-.21,2.06c-.1.66-.7,2.34-3.83,3.93C1.57,12.51,1,10.83.87,10.17a1.68,1.68,0,0,1,.4-1.47h0a1.39,1.39,0,0,1,1-.51h0a3.14,3.14,0,0,1,2,1.09.44.44,0,0,0,.6,0A3.15,3.15,0,0,1,7.09,8.18a1.41,1.41,0,0,1,1,.51h0A1.63,1.63,0,0,1,8.53,10.17Z" />
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            cantModal: 1
        }
    },
    props: {
        product: Object,
        user_id: Number,
        tasadolar: Number
    },
    methods: {
        handleInput(product) {
            if (this.cantModal < 1) {
                this.cantModal = 1; // Establece el valor mínimo como 1 si el usuario intenta ingresar un valor negativo o 0
            } else if (this.cantModal > product.qty_avaliable) {
                this.cantModal = product.qty_avaliable; // Establece el valor máximo como el máximo disponible del producto
            }
        },
        increaseValue() {
            const productID = this.product.id;
            const qty_avaliable = this.product.qty_avaliable;
            if (this.cantModal < qty_avaliable) {
                this.cantModal++;
            }
        },
        decreaseValue() {
            const productID = this.product.id;
            const qty_avaliable = this.product.qty_avaliable;
            if (this.cantModal > 1) {
                this.cantModal--;
            }
        },
        up(v, n) {
            return Math.ceil(v * Math.pow(10, n)) / Math.pow(10, n);
        }
    },
    computed: {
        totalModal: function () {
            let price = 0;
            if (this.product.impuesto > 0) {
                price = this.product.calculado * this.cantModal;
            } else if (!this.product.impuesto) {
                price = this.product.price * this.cantModal;;
            }

            return price;
        }

    }
}
</script>
