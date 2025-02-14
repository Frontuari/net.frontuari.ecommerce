@extends('partials.base')

@section('title','Perfil')

@section('body')


<?php
if(isset($_GET['orders_id'])){

?>

<section class="jumbotron" style="">
		<div class="container">
			<div class="text-center">
				<h1>Carrito de Compras</h1>
			</div>

		</div>
	</section>
	<div class="container">
	<div class="row" style="text-align:center;" id="div_image_top">
		<div class="col-lg-12 col-12">
			<img style="margin:0 auto; width: 100% !important;" src="img/topPagar.png">
		</div>
	</div>
	</DIV>
	<div class="container">
		<div class="row">
			<div class="col-md-8" id="div_completo_metodo_pago">
				<div class="row">
                    <div class="col-md-12 text-center h4" style="color:#203876">Métodos de pago</div>
				</div>
				<div class="row">
                    <div class="col-md-12"><span class="text-danger">Importante:</span><br>
                    	<!-- <span class="text-danger">*</span> Puede realizar un máximo de 2 pagos<br> -->
                    	<span class="text-danger">*</span> Si desea pagar en efectivo USD y combinar su pago con otro método de pago, debe seleccionar primero la opción Efectivo USD.
                    </div>
				</div>
				<div id="metodosPago"></div>
			</div>
			<div class="col-md-4 text-center">
				
				<div id="factura"></div>
			</div>
		
		</div>
	</div>
<?php


}else{
	?>
		<section class="jumbotron" style="background-image: url('');">
		<div class="container">
			<div class="text-center">
				<h1>Mi Cuenta</h1>
			</div>
		</div>
	</section>
	<profile :tasadolar="{{$tasa_dolar}}" :userlogged="{{ json_encode($_SESSION['usuario'] ?? '') }}"></profile>
	<?php
}
?>

@stop

@section('js')
<?php
	if(isset($_GET['orders_id'])):
?>
	<script>
		var orders_id=<?= $_GET['orders_id']; ?>;
		var user_data = "<?php print $_SESSION['usuario']['rif'].','.$_SESSION['usuario']['name'].','.$_SESSION['usuario']['email'] ?>";
	</script>
<?php endif; ?>
@endsection