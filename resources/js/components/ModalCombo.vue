<template>
    <div class="modal fade" id="ModalProdCombo" tabindex="-1" role="dialog" aria-labelledby="ModalProdComboLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="product-block">
						<div class="row">
							<div class="col-lg-5">
								<div class="product-img">
									<img :src="'storage/'+combo.image">
								</div>
							</div>
							<div class="col-lg-7">
								<div class="product-description">
									<a href="#" class="product-title">{{combo.name}}</a>

									<span class="product-info" v-for="p in combo.products" :key="p.id">
										{{ p.name }} X {{p.cant_combo}}
										<span v-if="p.qty_avaliable <= 0"><font color="red">Agotado</font></span>
										<span v-else-if="p.cant_combo > p.qty_avaliable"><font color="red"> ({{p.qty_avaliable}} Disponible) </font></span>
									</span>
									
									<div class="product-prices">
									
										<p> Bs{{ (combo.combo_price * tasadolar) | FormatNumber}} / $ {{ combo.combo_price | FormatDolar  }}</p>
									</div>
								</div>
								<div class="product-options">
									<form action="">
										<!-- <div class="product-quantity">
                                            <label>Cantidad</label>
                                            <div class="product-quantity-group">
                                                <input id="quantity" class="form-control" type="number" name="quantity" v-model="cantModal" value="1">
                                                <div class="product-quantity-buttons">
                                                    <button type="button" class="btn" @click="increaseValue()">
                                                        <img src="assets/img/increase.png" alt="Increase">
                                                    </button>
                                                    <button type="button" class="btn" @click="decreaseValue()">
                                                        <img src="assets/img/decrease.png" alt="decrease">
                                                    </button>
                                                </div>
                                            </div>
                                        </div> -->
										<div class="product-prices">
											<p><b>Total:</b> Bs {{ (totalModal * tasadolar) | FormatDolar}} / $ {{totalModal | FormatNumber}} </p>
										</div>
										<div class="product-buttons">
											<button type="button" class="btn btn-addcart" @click="addComboToCart(combo.products)">Añadir al carrito</button>
											<!-- <button type="button" class="btn btn-addfavorite">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14.93 15"><title>añadir-favorito-bio</title><g id="Capa_2" data-name="Capa 2"><g id="Guias_y_recursos" data-name="Guias y recursos"><path class="cls-1" d="M4.7,7.56a.42.42,0,0,1-.42-.42V3.5H14.51a.43.43,0,0,1,0,.85H5.13V7.14A.42.42,0,0,1,4.7,7.56Z"/><path class="cls-1" d="M14.93,15H7.19a.43.43,0,0,1,0-.85h6.9V5.09a.42.42,0,1,1,.84,0Z"/><path class="cls-1" d="M11.53,6a.42.42,0,0,1-.42-.43V2a1,1,0,0,0-.43-.84A1.86,1.86,0,0,0,9.6.85C9,.85,8,1.15,8,2V5.53a.42.42,0,1,1-.84,0V2A2.18,2.18,0,0,1,9.6,0,2.12,2.12,0,0,1,12,2V5.53A.43.43,0,0,1,11.53,6Z"/><path class="cls-1" d="M8.74,8.11a2.23,2.23,0,0,0-1.63-.77A3.6,3.6,0,0,0,4.7,8.39,3.58,3.58,0,0,0,2.3,7.34a2.23,2.23,0,0,0-1.63.77A2.51,2.51,0,0,0,0,10.31C.32,12,2,13.69,4.52,15a.39.39,0,0,0,.18,0,.41.41,0,0,0,.19,0c2.57-1.27,4.2-3,4.48-4.65A2.51,2.51,0,0,0,8.74,8.11Zm-.21,2.06c-.1.66-.7,2.34-3.83,3.93C1.57,12.51,1,10.83.87,10.17a1.68,1.68,0,0,1,.4-1.47h0a1.39,1.39,0,0,1,1-.51h0a3.14,3.14,0,0,1,2,1.09.44.44,0,0,0,.6,0A3.15,3.15,0,0,1,7.09,8.18a1.41,1.41,0,0,1,1,.51h0A1.63,1.63,0,0,1,8.53,10.17Z"/></g></g></svg>
											</button> -->
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
    export default{
        data(){
            return{
                cantModal: 1
            }
        },
        props: {
            combo: Object,
			tasadolar: Number,
			index: Number
		},
		methods: {
            increaseValue()
            {
                // const productID = this.combo.id;
                // const qty_avaliable = this.product.qty_avaliable;
                // if(this.cantModal < qty_avaliable ) {
                    this.cantModal++;
                // }
            },
            decreaseValue()
            {
                // const productID = this.combo.id;
                // const qty_avaliable = this.product.qty_avaliable;
                if(this.cantModal > 1 ) {
                    this.cantModal--;
                }
            }
        },
		computed: {
			totalModal: function() {
                let price = 0;
                price = this.combo.combo_price * this.cantModal;
				return price;
			}

		}
    }
</script>