@extends('partials.base')
@section('title','Home')
@section('body')

<?php 
//exit("<div style='text-align:center'><img style='margin:0 auto' width='200' src='img/logo.png'><br>Estamos trabajando en una actualización, intente más tarde.</div>");
// dd( $medio_bajo );
?>
	<div id="loader-wrapper">
		<div id="loader"></div>
	
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	
	</div>

	<slider :id="'sliderHome1'" :sliders="{{ $sliders }}"></slider>

	<combos :combo_product="{{$combos}}" :tasadolar="{{$tasa_dolar}}"></combos>

	<ads :categories="{{ $categories }}"></ads>

	<!-- <offers :medio_bajo="{{ $medio_bajo }}"></offers> -->
    

	<nuestros-productos 
		:recent="{{ $recent }}"
		:viewed="{{ $viewed }}"
		:sold="{{ $sold }}"
		:best_price="{{ $bestprice }}"
		:tasadolar="{{$tasa_dolar}}" 
		:userlogged="{{ json_encode($_SESSION['usuario'] ?? '') }}">
	</nuestros-productos>

	<!-- <footer-ad :ads="{{ $footer }}"></footer-ad> -->

	<slider :id="'sliderHome3'" :sliders="{{ $footer }}"></slider>

@stop

@section('js')

<script>
	
	console.log("entre aqui en el script de js");

	async function fetchData() {
    try {

        const response = await axios.get(URLHOME+'/api_rapida.php?evento=listarProductosAll');
        // Verificar si la solicitud fue exitosa y si hay datos recibidos
		console.log(response);
        if (response.data) {
			
			console.log("Esto es reponse",response.data);
			response.data.tasaDolar = {{ $tasa_dolar }};

            // Convertir el texto JSON en un objeto
            // Guardar los datos de productos en el local storage con la clave 'productosb'
            window.localStorage.setItem('productosb', JSON.stringify(response.data));
            console.log('Datos de productos guardados en el local storage:', response);
        } else {
            console.error('No se pudo obtener los datos de productos o la solicitud fue fallida:', response.data.message);
        }
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
}

async function fetchDataArray() {
    try {

        const response = await axios.get(URLHOME+'/api_rapida.php?evento=listarProductosArray');
        // Verificar si la solicitud fue exitosa y si hay datos recibidos
		console.log(response);
        if (response.data) {
			
			console.log("Esto es reponse home",response.data);

            // Convertir el texto JSON en un objeto
            // Guardar los datos de productos en el local storage con la clave 'productosb'
            window.localStorage.setItem('productos', JSON.stringify(response.data));
            console.log('Datos de productos guardados en el local storage:', response);
        } else {
            console.error('No se pudo obtener los datos de productos o la solicitud fue fallida:', response.data.message);
        }
    } catch (error) {
        console.error('Error al realizar la solicitud:', error);
    }
}


fetchDataArray();

fetchData();


</script>

@endsection

@section('css')
<style>

	#loader-wrapper {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		z-index: 1000;
		
	}
	#loader {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    border: 3px solid transparent;
    /* border-top-color: red; */
    -webkit-animation: spin 2s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
    animation: spin 2s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
    z-index: 1001;
}

#loader:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 15%;
    border: 3px solid transparent;
    -webkit-animation: spin 3s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
    animation: spin 3s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
    background-image: url("img/Carrito@2x.png");
    background-repeat: no-repeat;
    background-size: contain; /* Cambiado a 'contain' para asegurarse de que la imagen se ajuste correctamente */
    background-position: center; /* Asegura que la imagen esté centrada */
}

#loader:after {
    content: "";
    position: absolute;
    top: 15px;
    left: 15px;
    right: 15px;
    bottom: 15px;
    border-radius: 50%;
    border: 3px solid transparent;
    -webkit-animation: spin 1.5s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
    animation: spin 1.5s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
}

	#loader-wrapper .loader-section {
		position: fixed;
		top: 0;
		width: 51%;
		height: 100%;
		background: #fff;

		z-index: 1000;
	}
	
	#loader-wrapper .loader-section.section-left {
		left: 0;
	}
	
	#loader-wrapper .loader-section.section-right {
		right: 0;
	}
	#loader {
		z-index: 1001; /* anything higher than z-index: 1000 of .loader-section */
		
	}
	h1 {
		color: #EEEEEE;
	}

	.loaded #loader-wrapper .loader-section.section-left {
		-webkit-transform: translateX(-100%);  /* Chrome, Opera 15+, Safari 3.1+ */
		-ms-transform: translateX(-100%);  /* IE 9 */
		transform: translateX(-100%);  /* Firefox 16+, IE 10+, Opera */
	}
	
	.loaded #loader-wrapper .loader-section.section-right {
		-webkit-transform: translateX(100%);  /* Chrome, Opera 15+, Safari 3.1+ */
		-ms-transform: translateX(100%);  /* IE 9 */
		transform: translateX(100%);  /* Firefox 16+, IE 10+, Opera */
	}

	.loaded #loader-wrapper {
		visibility: hidden;
		
	}

	.loaded #loader {
		opacity: 0;
		-webkit-transition: all 0.3s ease-out; 
				transition: all 0.3s ease-out;
				
	}

	.loaded #loader-wrapper .loader-section.section-right,
	.loaded #loader-wrapper .loader-section.section-left {
	
		-webkit-transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000); 
					transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
	}

	.loaded #loader-wrapper {
        -webkit-transform: translateY(-100%);
            -ms-transform: translateY(-100%);
                transform: translateY(-100%);
 
        -webkit-transition: all 0.3s 1s ease-out; 
                transition: all 0.3s 1s ease-out;
				
	}

	
    @-webkit-keyframes spin {
        0%   { 
            -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(0deg);  /* IE 9 */
            transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
        }
        100% {
            -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(360deg);  /* IE 9 */
            transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
        }
    }
    @keyframes spin {
        0%   { 
            -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(0deg);  /* IE 9 */
            transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
        }
        100% {
            -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
            -ms-transform: rotate(360deg);  /* IE 9 */
            transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
        }
    }
</style>
@endsection