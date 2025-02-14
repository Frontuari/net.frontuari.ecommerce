@extends('partials.base')
@section('title','Contacto')
@section('body')
	<section id="register">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="register-content">
						<h2><i>Informaci&oacute;n de contacto</i></h2>
						<ul class="items">
							<li><strong>Tel&eacute;fono :&nbsp;</strong><a href="#">número de telefono</a></li>
							<li><strong>Email :&nbsp;</strong><a href="#">contacto@sitio.com.ve</a></li>  
							<li><strong>Direcci&oacute;n:</strong><a href="#">Sede Principal: Localización.</a></li>
							<!-- TODO: ^^ Arreglar información de contacto ^^ -->
						</ul>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<contact/>
				</div>
			</div>
		</div>
	</section>
@stop