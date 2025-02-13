@extends('partials.base')
@section('title','Cultura BIO')
@section('body')

<div class="parallax"></div>
<section class="inspirate">
	<div class="section-subtitle"><h1>Inspirados en servir.</h1></div>
	<div class="pmv"><p>En Biomercados ofrecemos a diario nuestra mejor sonrisa, acompañada de la mejor calidad, variedad y servicio, para así seguir creciendo y poder estar cada vez más cerca de todos ustedes. Gracias por acompañarnos en este camino y vivir con nosotros la experiencia de estar Inspirados en servir...</p></div>
</section>

<div class="container">
	<div class='row align-children' style="padding: 50px 0;">
		<div class='col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 text-center'>
			<img class="photografy" src="http://wp523.biomercados.com.ve/wp-content/uploads/2019/11/DSC_1004-2.jpg">
		</div>
		<div id="mision" class='col-md-5 col-sm-5 mb-xs-24'>
			<div class="section-subtitle"><h2>Misi&oacute;n</h2></div>
			<div class="pmv"><p>Ser reconocidos como la cadena de supermercados que ofrece una amplia variedad de alimentos y no alimentos, con precios competitivos y de alta calidad, liderado por un equipo humano que con entusiasmo trabaja en pro del bien común, y que comprende que satisfacer las necesidades del cliente es nuestra razón de existir.</p></div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row align-children">
			<div id="vision"  class="col-md-5 col-sm-5 mb-xs-24">
				<div class="section-subtitle"><h2>Visi&oacute;n</h2></div>
				<div class="pmv"><p>Consolidar un equipo humano con excelencia profesional y vocación de servicio que contribuya a que seamos reconocidos a largo plazo como una empresa que promueve relaciones eficaces entre empleados, clientes, proveedores y la comunidad, a través de la comercialización de alimentos, estimulando el desarrollo económico y con impacto positivo al medio ambiente del país.</p>
				</div>
			</div>
			<div class="col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 text-center">
				<img class="photografy" src="http://wp523.biomercados.com.ve/wp-content/uploads/2019/11/DSC_0030.jpg">
			</div>
	</div>
</div>

@stop

@section('css')

<style>
.parallax {
  /* The image used */
  background-image: url("http://wp523.biomercados.com.ve/wp-content/uploads/2019/11/Cultura-Bio.jpg");

  /* Set a specific height */
  height: 500px;

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.section-subtitle h1,h2 {
    display: inline-flex;
    justify-content: center;
    font-style: italic;
    color: #203876;
    width: 100%;
}

.inspirate {
    background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(238,238,238,1) 100%);
}

.inspirate > .pmv > p {
	font-size: 25px;
	margin-inline-start:100px;
	margin-inline-end:100px;
}

.container > .row > .photografy {
    margin-left: auto;
    margin-right: auto;
}

.photografy {
    display: block;
    max-width: 100%;
    height: auto;
}

#mision > .pmv > p, #vision > .pmv > p {
	font-size: 15px;
	margin-inline-start:100px;
	margin-inline-end:100px;
}

#mision, #vision {
	margin-top: 5%;
}

section {
    padding: 96px 0;
    position: relative;
    overflow: hidden;
}

</style>
@endsection