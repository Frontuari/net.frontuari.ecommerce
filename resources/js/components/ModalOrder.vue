<template>
    <div class="modal modal-order fade" id="ModalOrder" tabindex="-1" role="dialog" aria-labelledby="ModalOrderLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="order-block">
						<div class="row">
							<div class="col-lg-12">
								<h3 class="order-number order-text">Orden #{{order.id}}</h3>
								<div class="order-description">
									<div class="row">
										<div class="col-6"><label class="order-text">Detalles de la orden</label></div>
										<div class="col-6"><label class="order-text">Cantidad</label></div>
									</div>
									<div class="row" v-for="product in order.products" :key="product.id">
										<div class="col-6"><p>{{product.nombre}}</p></div>
										<div class="col-6"><p>{{product.cantidad}}</p></div>
									</div>
								</div>
								<div class="order-total">
									<div class="row">
										<div class="col-12 col-md-4"><h3 class="order-text">Costo Total</h3></div>
										<div class="col-12 col-md-8"><h3 class="order-text">Bs {{ (order.total * tasadolar) | FormatNumber }} / {{order.total | FormatDolar }} $ </h3></div>
									</div>
								</div>
								<label class="order-text">Dirección de envio</label>
								{{order.direction}}
								<p v-if="order.direction == 0">
                                    Pick - Up
                                </p>
                                <p v-if="order.direction > 0">
                                    {{order.direction_text}}
                                </p>
								<label class="order-text">Estado de la orden:</label>
								<div class="process-status in-process">
									<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20.12 19.97"><title>en-proceso-bio-mercados</title><g id="Capa_2" data-name="Capa 2"><g id="Perfil_de_Usuario" data-name="Perfil de Usuario"><path class="cls-1" d="M12.09,18.25l-.5.11A.81.81,0,1,0,11.88,20l.6-.13a.81.81,0,0,0-.39-1.57Z"/><path class="cls-1" d="M18.07,7.41a.9.9,0,0,0,.3.41.79.79,0,0,0,.72.1.8.8,0,0,0,.52-1c-.07-.19-.14-.39-.21-.57a.81.81,0,0,0-1.51.6,4.68,4.68,0,0,1,.18.48Z"/><path class="cls-1" d="M14.72,17.1l-.44.27a.8.8,0,0,0-.3,1.1.86.86,0,0,0,.24.26.83.83,0,0,0,.87,0c.17-.1.35-.21.52-.33a.8.8,0,1,0-.89-1.34Z"/><path class="cls-1" d="M20.11,9.67a.81.81,0,0,0-1.62.06c0,.17,0,.35,0,.52a.8.8,0,0,0,.34.68.77.77,0,0,0,.45.14.8.8,0,0,0,.82-.79c0-.2,0-.41,0-.61Z"/><path class="cls-1" d="M9.56,3.52a.66.66,0,0,0-.65.66V10.7l6,3.08a.66.66,0,0,0,.88-.28.65.65,0,0,0-.28-.88L10.22,9.9V4.18a.67.67,0,0,0-.66-.66Z"/><path class="cls-1" d="M19.13,12a.82.82,0,0,0-1,.53c-.05.17-.1.33-.16.49a.81.81,0,0,0,.28.95.76.76,0,0,0,.18.09.82.82,0,0,0,1.05-.46c.07-.19.14-.39.2-.58a.82.82,0,0,0-.53-1Z"/><path class="cls-1" d="M8.56,18.37a8.33,8.33,0,0,1-2.07-.66l0,0c-.16-.07-.31-.15-.46-.23H6c-.27-.15-.54-.32-.8-.5a8.46,8.46,0,0,1,0-13.83l0,0A8.48,8.48,0,0,1,14.74,3L14.1,4c-.17.26-.06.44.24.41l2.75-.24a.46.46,0,0,0,.41-.59L16.76.87c-.08-.3-.29-.33-.47-.08l-.63.92A10,10,0,0,0,8.34.15L7.57.31h0A9.94,9.94,0,0,0,2,4l0,0-.14.19-.21.32,0,0A10.08,10.08,0,0,0,0,10.49v0c0,.2,0,.4,0,.61v0c0,.2.05.4.09.61A10,10,0,0,0,3,17.19H3a9.71,9.71,0,0,0,1.29,1.08,10,10,0,0,0,4,1.68.81.81,0,1,0,.28-1.59Z"/><path class="cls-1" d="M17.94,15a.8.8,0,0,0-1.13.16l-.32.4a.81.81,0,0,0,.09,1.14l.06,0a.81.81,0,0,0,1.08-.14l.38-.48A.8.8,0,0,0,17.94,15Z"/></g></g></svg> -->
									{{order.status}}
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

			}
        },
        props: {
            order: Object,
            tasadolar: Number
        }
    }
</script>