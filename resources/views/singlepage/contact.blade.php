<script>
    fetch("/api/call-name")
        .then(response => response.json())
        .then(data => {
            console.log("Resultado de callName():", data);
            const info = data[0];

			document.getElementById("phone_number").textContent = info.phone ?? 'No disponible';
            document.getElementById("email_address").textContent = info.email ?? 'No disponible';
            document.getElementById("address").textContent = info.address ?? 'No disponible';

        })
        .catch(error => {
            console.error("Error al llamar a callName:", error);
        });
</script>

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
							<li><strong>Tel&eacute;fono: &nbsp;</strong><a href="#"><span id="phone_number"></span></a></li>
							<li><strong>Email: &nbsp;</strong><a href="#"><span id="email_address"></span></a></li>  
							<li><strong>Direcci&oacute;n: &nbsp;</strong><a href="#"> Sede Principal: <span id="address"></span></a></li>
							
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