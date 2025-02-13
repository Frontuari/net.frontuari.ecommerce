@extends('partials.base')

@section('title','Resumen de Orden')

@section('body')

<!--MAIN-->
<main id="app">
	<section class="jumbotron" style="background-image: url('');">
		<div class="container">
			<div class="text-center">
				<h1>Carrito de Compras</h1>
			</div>
		</div>
	</section>
	<resume :order="{{$order}}" :userlogged="{{ json_encode($_SESSION['usuario'] ?? '') }}"></resume>
</main>
<!-- CIERRE DEL MAIN-->
@stop

