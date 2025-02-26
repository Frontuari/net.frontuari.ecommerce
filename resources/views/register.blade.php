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
			<div class>
				<div class>
					<register :userlogged="{{ json_encode($_SESSION['usuario'] ?? '') }}"></register>
				</div>
			</div>
		</div>
	</section>
@stop