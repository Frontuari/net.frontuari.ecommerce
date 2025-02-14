@extends('partials.base')

@section('title','Registro')

@section('body')
<section class="jumbotron" style="background-image: url('');">
		<div class="container">
			<div class="text-center">
				<h1>Registro de Usuario</h1>
			</div>
		</div>
	</section>
	<section id="register">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="register-content">
						<h2><i>Beneficios de ser usuario de</i></h2>
						<h1>bio mercados</h1>
						<ul class="items">
							<li>Tendrá acceso a nuestra tienda virtual y nuestras aplicaciones móviles con una sola cuenta.</li>
							<!-- <li>Podrá acumular y canjear sus puntos bio por productos y ahorrar dinero en las compras.</li> -->
							<li>Obtendrá grandes descuentos, promociones y más, en los precios de nuestros productos y cambios bio.</li>
							<li>Podrá realizar una compra sin salir de su hogar y recibir los productos en la puerta de su casa u oficina.</li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<register :userlogged="{{ json_encode($_SESSION['usuario'] ?? '') }}"></register>
				</div>
			</div>
		</div>
	</section>
@stop