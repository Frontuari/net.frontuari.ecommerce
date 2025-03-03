var aPagarBs = 0;
var aPagarUsd = 0;
var paymentDataip;
var checkDeliveryType = 0;

if (document.getElementById("div_fecha")) {

	get('horasDisponiblesEntrega');
	div_fecha.innerHTML = "Cargando...";

}

if (document.getElementById("div_direccion_entrega")) {

	div_direccion_entrega.innerHTML = "Cargando...";
	get('getAdreess');

}

if (document.getElementById("div_resumen_compra")) {
	div_resumen_compra.innerHTML = "<div class='loaderb'><div>";
	get('web_no_login');
}

if (document.getElementById("factura")) {
	factura.innerHTML = "<div class='loaderb'><div>";

	get('consultarOrden', '&id=' + orders_id);
}


var id_orders = "";
if (typeof (orders_id) !== "undefined") {
	id_orders = orders_id;
}
var activar_envio = false;
var direccionOrden = 0;
var horaEntregaOrden = "NULL";

var limite_max_pagos_alcanzado = false;
var ordenPagada = false;

//var aPagarBs = 0;
//var aPagarUsd = 0;


function refrescar() {
	location.reload();
}
function procesarPago() {
	var amount = input_amount.value;

	var coins_id = input_coins_id.value;
	var rate = input_rate.value;
	var bank_datas_id = input_bank_datas_id.value;
	var mega_amount = '';
	var ref = '';

	console.log('Esto es el rate de bolivares ', rate);

	if (coins_id == 1) { //Dolares
		if (amount > aPagarBs) {
			Swal.fire("Pagos en Línea", "El monto a pagar en Dolares debe ser exacto", "warning");
			throw new Error("El monto a pagar debe ser exacto");
			return false;
		}
		amount = parseFloat(formato_moneda(amount)) * rate;
		mega_amount = amount.toFixed(2);
	}
	if (coins_id == 2) { //Bolivares
		if(amount > aPagarUsd) {
			Swal.fire("Bio en Línea","El monto a pagar en Bolivares debe ser exacto","warning");
			throw new Error("El monto aa pagar debe ser exacto");
			return false;
		}
		amount = amount * rate;
	}

	if (bank_datas_id == 3) {
		datosBancarios.innerHTML = `
		<div class="row"><div class="col-md-12 text-center"><br>Luego de procesar su pago exitoso en TDC se refrescará esta ventana</div></div>
		`;

		url_popup = url_base + "/mega/PreRegistro.php?nro_orden=" + id_orders + "&total=" + mega_amount;

		ventana = window.open(url_popup, "myWindow", "width=400,height=450");
		var winTimer = window.setInterval(function () {
			if (ventana.closed !== false) {
				window.clearInterval(winTimer);
				refrescar();
			}
		}, 200);
		return false;
	}

	if (bank_datas_id == 6) {
		datosBancarios.innerHTML = `
		<div class="row"><div class="col-md-12 text-center"><br>Luego de procesar su pago exitoso en TDD se refrescará esta ventana</div></div>
		`;

		url_popup = url_base + "/mercantil/index.php?evento=inicio&nroFactura=" + id_orders + "&amount=" + mega_amount;
		ventana = window.open(url_popup, "myWindow", "width=400,height=550");
		var winTimer = window.setInterval(function () {
			if (ventana.closed !== false) {
				window.clearInterval(winTimer);
				refrescar();
			}
		}, 200);
		return false;
	}

	if (document.getElementById('input_ref')) {
		ref = input_ref.value;
	} else {
		ref = '';

	}

	div_btn_guardar_pago.innerHTML = "<div class='loaderb'><div>";

	get('guardarPago', '&amount=' + amount + '&ref=' + ref + '&coins_id=' + coins_id + '&orders_id=' + id_orders + '&bank_datas_id=' + bank_datas_id);
	return false;
}

function elegidoMetodo(id, name) {
	// window.location.href="#bancosDelMetodo";
	bancosDelMetodo.innerHTML = "<div class='loaderb'><div>";
	get("listarBancosdelMetododePago", "&payment_methods_id=" + id);
	location.href = "#utlimo_metodo_pago";
}
function elegidoBanco(id, name, titular, descripcion, moneda, coins_id, rate) {
	console.log("id::> ", id);

	var div_referencia = `<div class="col-md-6">
	<label>Referencia Bancaria:</label>
	<input id="input_ref" name="ref" class="form-control" type="text">
		</div>`;
	var otro_ancho = '';
	var txt_btn_pagar = 'Pagar';
	var monto_total = 0;
	var html_boton = "<button onclick='return procesarPago();' class='btn btn-success'>" + txt_btn_pagar + "</button>";

	if (id == 3 || id == 2 || id == 6 || id == 7 || id == 10 || id == 12 || id == 15) {
		div_referencia = '';
		otro_ancho = '<div class="col-md-3"></div>';
	}

	if (id == 3) {
		txt_btn_pagar = 'Procesar TDC';
	}

	if (id == 6) {
		txt_btn_pagar = 'Procesar TDD';
	}

	html_boton = "<button onclick='return procesarPago();' class='btn btn-success'>" + txt_btn_pagar + "</button>";

	if (id == 15) {
		var udata = user_data.split(",");
		var cedula = udata[0].split("-")[1];
		var nombre = udata[1].split(" ")[0];
		var apellido = udata[1].split(" ")[1];
		var orderNo = orders_id;
		var email = udata[2];

		monto_total = up(aPagarUsd, 2);

		url_popup = url_base + "/international-payment-button/" + nombre + "/" + apellido + "/" + cedula + "/" + orderNo + "/" + monto_total + '/' + email;
		html_boton = "<iframe src='" + url_popup + "' width='250' height='250' frameborder='0'></iframe>";
	}

	if (coins_id == 1) {
		var patron = "^\\$?(([1-9](\\d*|\\d{0,2}(,\\d{3})*))|0)(\\.\\d{1,2})?$";
		var msj = "Use punto (.) para decimales";
		monto_total = aPagarBs;
	} else {
		var patron = "^\\$?(([1-9](\\d*|\\d{0,2}(\.\\d{3})*))|0)(,\\d{1,2})?$";
		var msj = "Use coma (,) para decimales";
		monto_total =  up(aPagarUsd, 2);
	}

	var mensaje = "Ingrese el monto en " + moneda + ":";

	if (name == 'bio wallet') {
		mensaje = "Introduzca el monto que desea usar de su saldo disponible en bio wallet";
	}

	datosBancarios.innerHTML = `
	<div class='row text-center h5'>
	<div class="col-md-12">
	Banco: `+ name + `
	</div>
</div>
	<div class='row text-center h5'>
		<div class="col-md-12">
Titular: `+ titular + `
		</div>
 
	</div>
	<div class='row text-center h5'>
		<div class="col-md-12">
		Datos: `+ descripcion + `
		</div>
	</div>
	<div class='row text-center h5'>
		<div class="col-md-12">
		Moneda: `+ moneda + `
		</div>
	</div>
<form onsubmit="return false;" autocomplete="off">
	<div class='row'>
		`+ otro_ancho + `
		<div class="col-md-6">
			<label>`+ mensaje + `:</label>
			<input id="input_amount" title="`+ msj + `" pattern="` + patron + `" name="amount" value="` + monto_total.toFixed(2) + `" required class="form-control" type="text">
			<input id="input_coins_id" type="hidden" name="coins_id" value="`+ coins_id + `">
			<input id="input_rate" type="hidden" name="rate" value="`+ rate + `">
			<input id="input_bank_datas_id" type="hidden" name="bank_datas_id" value="`+ id + `">
		</div>
		`+ div_referencia + `
	</div>
	<div class='row text-center'>
		<div class="col-md-12">
		<br>
			<div id="div_btn_guardar_pago">
				`+ html_boton + `
			 </div>
		</div>
	</div>
   </form> 
	
	`;

}

function procesar(data, evento) {
	console.log("esto es lo que hay en data", data);
	console.log("esto es el evento", evento);

	switch (evento) {
		case 'guardarPago':

			console.log("entre aqui en Guardar Pago")
			// var data = JSON.parse(data);

			var datas = data;

			// Expresión regular para extraer el objeto JSON dentro de la cadena de texto
			var regex = /{.*}/;

			// Buscar el objeto JSON utilizando la expresión regular
			var match = datas.match(regex);

			// Verificar si se encontró un objeto JSON
			if (match) {
				try {
					// Parsear el objeto JSON encontrado en la cadena de texto a un objeto JavaScript
					var objetoJSON = JSON.parse(match[0]);

					// Ahora puedes utilizar objetoJSON como un objeto JavaScript
					data = objetoJSON
					console.log("esto es el onjeto", objetoJSON);
				} catch (error) {
					console.error("Error al parsear el objeto JSON:", error);
				}
			} else {
				console.error("No se encontró ningún objeto JSON en la cadena de texto.");
			}
			console.log(data);



			if (data.success == true) {
				Swal.fire("Exitoso", "Su pago ha sido procesado", "success");
				location.reload();

			} else {
				Swal.fire("Exitoso", data.msj_general, "success");
				div_btn_guardar_pago.innerHTML = '<button class="btn btn-success">Pagar</button>';

			}



			break;
		case 'listarBancosdelMetododePago':


			var datas = data;

			// Expresión regular para extraer el objeto JSON dentro de la cadena de texto
			var regex = /{.*}/;

			// Buscar el objeto JSON utilizando la expresión regular
			var match = datas.match(regex);

			// Verificar si se encontró un objeto JSON
			if (match) {
				try {
					// Parsear el objeto JSON encontrado en la cadena de texto a un objeto JavaScript
					var objetoJSON = JSON.parse(match[0]);

					// Ahora puedes utilizar objetoJSON como un objeto JavaScript
					data = objetoJSON
					console.log("esto es el onjeto", objetoJSON);
				} catch (error) {
					console.error("Error al parsear el objeto JSON:", error);
				}
			} else {
				console.error("No se encontró ningún objeto JSON en la cadena de texto.");
			}
			console.log(data);


			if (data.success == true) {
				var h = '<hr>';
				var datos = data.data;
				for (var [key, value] of Object.entries(datos)) {
					var descrip = ''
					if (value.description != null) {
						descrip = value.description.replace(/(\r\n|\n|\r)/gm, "");
					} else {
						descrip = 'megasoft';
					}
					h += '<div class="row"><div class="col-md-1 col-1"></div><div class="col-md-1 col-1"><input name="b"  class="form-controld" type="radio" onclick="elegidoBanco(\'' + value.id + '\',\'' + value.b_name + '\',\'' + value.titular + '\',\'' + descrip + '\',\'' + value.c_name + '\',\'' + value.coins_id + '\',\'' + value.rate + '\')" value="' + value.id + '"></div><div class="col-md-10 col-10">' + value.b_name + ' (' + value.c_name + ')</div></div><hr>';
				}

				bancosDelMetodo.innerHTML = h + "<div id='datosBancarios'></div>";
			}

			break;
		case 'listarMetodosDePago':

			if (limite_max_pagos_alcanzado == true) {
				metodosPago.innerHTML = "<div class='text-danger center'><br>Disculpe, ya agoto sus 2 pagos máximos, deber ir a nuestra tienda más cercana para reportar su situación.</div>";
			} else {
				var datas = data;

				// Expresión regular para extraer el objeto JSON dentro de la cadena de texto
				var regex = /{.*}/;

				// Buscar el objeto JSON utilizando la expresión regular
				var match = datas.match(regex);

				// Verificar si se encontró un objeto JSON
				if (match) {
					try {
						// Parsear el objeto JSON encontrado en la cadena de texto a un objeto JavaScript
						var objetoJSON = JSON.parse(match[0]);

						// Ahora puedes utilizar objetoJSON como un objeto JavaScript
						data = objetoJSON
						console.log("esto es el onjeto", objetoJSON);
					} catch (error) {
						console.error("Error al parsear el objeto JSON:", error);
					}
				} else {
					console.error("No se encontró ningún objeto JSON en la cadena de texto.");
				}
				// var data = JSON.parse(data);
				if (data.success == true) {
					var h = '<hr>';
					var datos = data.data;
					var ultimo = "";

					for (var [key, value] of Object.entries(datos)) {

						console.log("Esto es el valor ", value);

						if (key == 0) {
							ultimo = "id='utlimo_metodo_pago'";
						}

						h += '<div class="row"><div class="col-md-1 col-1"><input name="a" ' + ultimo + '  class="form-controld" type="radio" onclick="elegidoMetodo(\'' + value.id + '\',\'' + value.name + '\')" value="' + value.id + '"></div><div class="col-md-11 col-11">' + value.name + '</div></div><hr>';
					}

					metodosPago.innerHTML = h + "<div id='bancosDelMetodo'></div>";
				}
			}
			break;
		case 'totalPagar':

			var datas = data;

			// Expresión regular para extraer el objeto JSON dentro de la cadena de texto
			var regex = /{.*}/;

			// Buscar el objeto JSON utilizando la expresión regular
			var match = datas.match(regex);

			// Verificar si se encontró un objeto JSON
			if (match) {
				try {
					// Parsear el objeto JSON encontrado en la cadena de texto a un objeto JavaScript
					var objetoJSON = JSON.parse(match[0]);

					// Ahora puedes utilizar objetoJSON como un objeto JavaScript
					data = objetoJSON
					console.log("esto es el onjeto", objetoJSON);
				} catch (error) {
					console.error("Error al parsear el objeto JSON:", error);
				}
			} else {
				console.error("No se encontró ningún objeto JSON en la cadena de texto.");
			}

			// var data = JSON.parse(data);

			console.log("Datos Sacados ==> " + JSON.stringify(data));
			if (data.success == true) {
				ra = data.data[0];

				var rateb = JSON.parse(ra.rate_json);
				for (var i = 0; i < rateb.length; i++) {

					var id_rateb = (+rateb[i]['id']);
					_rateb = parseFloat(rateb[i]['rate']);
					if (id_rateb == 1) break;
				}

				var htotalD = parseFloat(ra.total_pay) * _rateb;
				htotalD = up(htotalD, 2);
				var pagado = 0.00;
				if (ra.cant_pagos != '0') {

					var pj = JSON.parse(ra.pago_json);
					for (var i = 0; i < pj.length; i++) {


						pagado += parseFloat(pj[i]['amount']);

					}
					//validar la cantidad maxima de pagos.
					// if(parseFloat(ra.cant_pagos)>1 &&  pagado<parseFloat(ra.total_pay)){
					//     limite_max_pagos_alcanzado=true;
					// }
					//alert(pagado.toFixed(2));

				

					if (pagado.toFixed(2) >= parseFloat(ra.total_pay)) {
						ordenPagada = true;
						div_image_top.innerHTML = `<ul class="progressbar">
						<li id="order-verification" class="progressbar-item active">
							<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" width="100" height="100" viewBox="0 0 26.458333 26.458334" version="1.1" id="svg954" inkscape:version="0.92.3 (2405546, 2018-03-11)" sodipodi:docname="verificar-pedido-bio.svg"> <defs id="defs948"/> <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="5.6" inkscape:cx="45.945476" inkscape:cy="44.557247" inkscape:document-units="mm" inkscape:current-layer="layer1" showgrid="false" units="px" inkscape:window-width="1920" inkscape:window-height="1017" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1"/> <metadata id="metadata951"> <rdf:RDF> <cc:Work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/> <dc:title/> </cc:Work> </rdf:RDF> </metadata> <g inkscape:label="Capa 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-270.54165)"> <path inkscape:connector-curvature="0" class="cls-1" d="m 152.66081,104.88754 h -1.29117 v -0.57943 a 1.5266458,1.5266458 0 0 0 -1.16152,-1.47373 v -4.071942 a 0.38629167,0.38629167 0 0 0 -0.38894,-0.38629 h -9.1731 a 0.38629167,0.38629167 0 0 0 -0.38629,0.38629 v 10.620382 a 0.38629167,0.38629167 0 0 0 0.38629,0.38893 h 5.969 v 0.31221 a 1.5213542,1.5213542 0 0 0 1.52135,1.51606 h 3.39461 a 1.5187083,1.5187083 0 0 0 1.51871,-1.51606 v -4.81012 a 0.38629167,0.38629167 0 0 0 -0.38894,-0.3863 z m -2.0664,-0.57943 v 0.57943 h -1.524 v -0.57943 a 0.762,0.762 0 0 1 1.524,0 z m -9.55939,4.68841 v -9.845142 h 8.39787 v 3.704162 a 1.524,1.524 0 0 0 -1.13771,1.4658 v 0.57943 h -1.29116 a 0.38629167,0.38629167 0 0 0 -0.38894,0.3863 v 3.70945 z m 11.2395,1.08744 a 0.74347917,0.74347917 0 0 1 -0.74348,0.74083 h -3.39461 a 0.74347917,0.74347917 0 0 1 -0.74612,-0.74083 v -4.42119 h 0.90487 v 1.0213 a 0.3889375,0.3889375 0 0 0 0.77523,0 v -1.0213 h 1.524 v 1.0213 a 0.3889375,0.3889375 0 0 0 0.77523,0 v -1.0213 h 0.90488 z" id="path18" style="stroke-width:0.26458332"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.36502817;stroke-opacity:1" id="rect871" width="17.322243" height="20.246883" x="1.8368255" y="271.68835"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.19695915;stroke-opacity:1" id="rect871-0" width="9.6682243" height="10.561244" x="14.513832" y="284.80243"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.06544681;stroke-opacity:1" id="rect871-0-0" width="3.2898765" height="3.4269435" x="17.691982" y="280.47778"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 24.665539,283.60513 h -2.435885 v -1.13425 a 2.8801343,2.9884481 0 0 0 -2.191297,-2.88487 v -7.97092 a 0.72876884,0.75617583 0 0 0 -0.733761,-0.75618 H 1.9988326 a 0.72876884,0.75617583 0 0 0 -0.728769,0.75618 v 20.78967 a 0.72876884,0.75617583 0 0 0 0.728769,0.76134 H 13.259809 v 0.61115 a 2.8701513,2.9780897 0 0 0 2.870151,2.96773 h 6.40418 a 2.8651597,2.9729105 0 0 0 2.865159,-2.96773 v -9.41592 a 0.72876884,0.75617583 0 0 0 -0.73376,-0.7562 z m -3.898414,-1.13425 v 1.13425 h -2.875143 v -1.13425 a 1.4375716,1.4916347 0 0 1 2.875143,0 z m -18.0345304,9.17768 v -19.2721 H 18.575826 v 7.25098 a 2.8751427,2.9832689 0 0 0 -2.146373,2.86934 v 1.13425 h -2.435885 a 0.72876884,0.75617583 0 0 0 -0.733759,0.75619 v 7.26134 z m 21.2041754,2.12869 a 1.4026304,1.4553795 0 0 1 -1.40263,1.4502 h -6.40418 a 1.4026304,1.4553795 0 0 1 -1.407622,-1.4502 v -8.65459 h 1.707115 v 1.99922 a 0.73376039,0.7613551 0 0 0 1.462529,0 v -1.99922 h 2.875143 v 1.99922 a 0.73376039,0.7613551 0 0 0 1.462529,0 v -1.99922 h 1.707116 z" id="path18-9" style="fill-opacity:1;stroke-width:0.50845605"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 6.3814296,274.1374 -0.8286009,0.92192 -0.0549,-0.0724 a 0.73376039,0.7613551 0 0 0 -1.1380771,0.95298 l 0.5790221,0.74582 a 0.72876884,0.75617583 0 0 0 0.5440809,0.2797 h 0.02994 a 0.73376039,0.7613551 0 0 0 0.534098,-0.24345 l 1.4076219,-1.55378 a 0.73286427,0.76042525 0 1 0 -1.0731867,-1.03584 z" id="path20" style="stroke-width:0.50845605"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 9.8505686,276.19358 h 6.5289694 a 0.73376039,0.7613551 0 1 0 0,-1.51753 H 9.8505686 a 0.73376039,0.7613551 0 1 0 0,1.51753 z" id="path22" style="stroke-width:0.50845605"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 6.3814296,278.75732 -0.8286009,0.9271 -0.0549,-0.0724 a 0.73376039,0.7613551 0 0 0 -1.1380771,0.93228 l 0.584014,0.75618 a 0.72876884,0.75617583 0 0 0 0.5440809,0.27967 h 0.02996 a 0.74873511,0.77689297 0 0 0 0.5291061,-0.23307 l 1.407622,-1.55378 a 0.73376039,0.7613551 0 0 0 -1.073187,-1.03587 z" id="path24" style="stroke-width:0.50845605"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 9.8505686,280.79796 h 4.0930844 a 0.73376039,0.7613551 0 0 0 0,-1.51753 H 9.8505686 a 0.73376039,0.7613551 0 1 0 0,1.51753 z" id="path26" style="stroke-width:0.50845605"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 6.3814296,283.34101 -0.8286009,0.92707 -0.0549,-0.0724 a 0.73376039,0.7613551 0 1 0 -1.1380771,0.94782 l 0.584014,0.75618 a 0.75372666,0.78207224 0 0 0 0.5440809,0.28485 h 0.02996 a 0.73376039,0.7613551 0 0 0 0.5340969,-0.24342 l 1.407623,-1.55378 a 0.73376039,0.7613551 0 1 0 -1.0731867,-1.03587 z" id="path28" style="stroke-width:0.50845605"/> <path inkscape:connector-curvature="0" class="cls-1" d="M 11.06851,283.88482 H 9.8505686 a 0.73376039,0.7613551 0 1 0 0,1.51753 H 11.06851 a 0.73376039,0.7613551 0 0 0 0,-1.51753 z" id="path30" style="stroke-width:0.50845605"/> </g></svg>
							Verificación del pedido
						</li>
		
						<li id="shipment-data" class="progressbar-item active">
							<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 26.09 20" version="1.1" id="svg30" sodipodi:docname="datos-de-envio-bio.svg" inkscape:version="0.92.3 (2405546, 2018-03-11)"> <metadata id="metadata34"> <rdf:RDF> <cc:Work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/> </cc:Work> </rdf:RDF> </metadata> <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666" borderopacity="1" objecttolerance="10" gridtolerance="10" guidetolerance="10" inkscape:pageopacity="0" inkscape:pageshadow="2" inkscape:window-width="1920" inkscape:window-height="1017" id="namedview32" showgrid="false" inkscape:zoom="16.68772" inkscape:cx="32.238103" inkscape:cy="-0.78023136" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1" inkscape:current-layer="svg30"/> <defs id="defs4"> </defs> <title id="title6">en-camino-bio-mercados</title> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-opacity:1" id="rect841" width="20.982712" height="5.1301694" x="4.237288" y="11.48" ry="0.0645146"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.73681211;stroke-opacity:1" id="rect841-0" width="21.194576" height="2.757288" x="4.1611862" y="10.595932" ry="0.034674358"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.17707145;stroke-opacity:1" id="rect841-0-3" width="15.518463" height="9.6105976" x="-1.8213768" y="7.8415132" ry="0.12085835" transform="matrix(0.99992374,-0.01235001,0.70867613,0.70553395,0,0)"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.79678148;stroke-opacity:1" id="rect841-0-0" width="9.711525" height="7.0369492" x="3.7671187" y="5.4857626" ry="0.08849337"/> <circle style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-opacity:1" id="path879" cx="5.6029224" cy="5.6181674" r="5.0026026"/> <g id="Capa_2" data-name="Capa 2" transform="translate(0.0033536,-1.0790039e-4)"> <g id="Perfil_de_Usuario" data-name="Perfil de Usuario"> <path inkscape:connector-curvature="0" class="cls-1" d="M 26,11 20.6,5.6 A 1.26,1.26 0 0 0 19.68,5.22 h -7.51 v 0.87 h 2.18 v 6.52 h 0.87 V 6.09 h 4.42 a 0.45,0.45 0 0 1 0.31,0.12 l 0.74,0.75 h -2 a 0.87,0.87 0 0 0 -0.87,0.87 v 3.91 a 0.87,0.87 0 0 0 0.87,0.87 h 6.52 v 3.48 a 0.44,0.44 0 0 1 -0.44,0.43 h -0.9 a 3,3 0 0 0 -6,0 H 11.7 a 3,3 0 0 0 -6,0 H 4.78 A 0.43,0.43 0 0 1 4.35,16.09 V 12.17 H 3.48 v 3.92 a 1.3,1.3 0 0 0 1.3,1.3 h 0.91 a 3,3 0 0 0 0.88,1.74 H 0 V 20 h 20.87 a 3,3 0 0 0 3,-2.61 h 0.9 a 1.31,1.31 0 0 0 1.31,-1.3 V 11.3 A 0.43,0.43 0 0 0 26,11 Z M 6.52,17 A 2.18,2.18 0 1 1 8.7,19.13 2.19,2.19 0 0 1 6.52,17 Z m 4.3,2.17 a 3,3 0 0 0 0.88,-1.74 h 6.16 a 3.13,3.13 0 0 0 0.88,1.74 z m 10.05,0 A 2.18,2.18 0 1 1 23,17 2.17,2.17 0 0 1 20.83,19.17 Z M 18.7,11.74 V 7.83 h 2.86 l 3.66,3.65 v 0.26 z" id="path8"/> <path inkscape:connector-curvature="0" class="cls-1" d="M 5.65,11.3 A 5.65,5.65 0 1 0 0,5.65 5.65,5.65 0 0 0 5.65,11.3 Z m 0,-10.43 A 4.78,4.78 0 1 1 0.87,5.65 4.78,4.78 0 0 1 5.65,0.87 Z" id="path20"/> <path inkscape:connector-curvature="0" class="cls-1" d="M 5.65,9.57 A 0.44,0.44 0 0 0 6,9.44 C 6.24,9.16 8.7,6.65 8.7,4.78 a 3.045,3.045 0 0 0 -6.09,0 c 0,1.87 2.45,4.38 2.73,4.66 a 0.48,0.48 0 0 0 0.31,0.13 z m 0,-7 A 2.18,2.18 0 0 1 7.83,4.78 C 7.83,5.9 6.46,7.62 5.65,8.5 4.85,7.62 3.48,5.9 3.48,4.78 A 2.17,2.17 0 0 1 5.65,2.61 Z" id="path22"/> <path inkscape:connector-curvature="0" class="cls-1" d="M 7,4.78 A 1.31,1.31 0 1 0 5.65,6.09 1.31,1.31 0 0 0 7,4.78 Z m -1.74,0 A 0.43,0.43 0 0 1 5.69,4.35 0.44,0.44 0 0 1 6.13,4.78 0.44,0.44 0 0 1 5.69,5.22 0.44,0.44 0 0 1 5.26,4.78 Z" id="path24"/> </g> </g> <path style="stroke:none;stroke-width:0.99999994px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 1.3033536,11.739892 v 0.87 h 0.8700001 v -0.87 z" id="path829" inkscape:connector-curvature="0"/> <path style="stroke:none;stroke-width:0.99999994px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 8.2633536,16.519893 v 0.87 h 0.8700001 v -0.87 z" id="path829-0" inkscape:connector-curvature="0"/> <path style="stroke:none;stroke-width:0.99999994px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 20.433355,16.519893 v 0.87 h 0.87 v -0.87 z" id="path829-0-9" inkscape:connector-curvature="0"/> <path style="stroke:none;stroke-width:1.2279979px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 0.86141189,13.479892 v 0.87 H 2.1733537 v -0.87 z" id="path829-3" inkscape:connector-curvature="0"/> <path style="stroke:none;stroke-width:1.58054018px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 0,15.219892 v 0.87 h 2.1733537 v -0.87 z" id="path829-3-0" inkscape:connector-curvature="0"/> <path style="stroke:none;stroke-width:1.41245294px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1" d="m 16.523354,13.479892 v 0.87 h 1.735671 v -0.87 z" id="path829-3-8" inkscape:connector-curvature="0"/></svg>
							Datos de envío
						</li>
		
						<li id="pay-invoice" class="progressbar-item active">
							<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" width="100" height="100" viewBox="0 0 26.458333 26.458334" version="1.1" id="svg954" sodipodi:docname="pagar-factura-bio.svg" inkscape:version="0.92.3 (2405546, 2018-03-11)"> <defs id="defs948"/> <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="5.6" inkscape:cx="-34.488683" inkscape:cy="38.724245" inkscape:document-units="mm" inkscape:current-layer="layer1" showgrid="false" units="px" inkscape:window-width="1920" inkscape:window-height="1017" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1"/> <metadata id="metadata951"> <rdf:RDF> <cc:Work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/> <dc:title/> </cc:Work> </rdf:RDF> </metadata> <g inkscape:label="Capa 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-270.54165)"> <path inkscape:connector-curvature="0" class="cls-1" d="m 153.84198,107.43888 h -1.29117 v -0.57943 a 1.5266458,1.5266458 0 0 0 -1.16152,-1.47373 v -4.07194 a 0.38629167,0.38629167 0 0 0 -0.38894,-0.38629 h -9.1731 a 0.38629167,0.38629167 0 0 0 -0.38629,0.38629 v 10.62038 a 0.38629167,0.38629167 0 0 0 0.38629,0.38893 h 5.969 v 0.31221 a 1.5213542,1.5213542 0 0 0 1.52135,1.51606 h 3.39461 a 1.5187083,1.5187083 0 0 0 1.51871,-1.51606 v -4.81012 a 0.38629167,0.38629167 0 0 0 -0.38894,-0.3863 z m -2.0664,-0.57943 v 0.57943 h -1.524 v -0.57943 a 0.762,0.762 0 0 1 1.524,0 z m -9.55939,4.68841 v -9.84514 h 8.39787 v 3.70416 a 1.524,1.524 0 0 0 -1.13771,1.4658 v 0.57943 h -1.29116 a 0.38629167,0.38629167 0 0 0 -0.38894,0.3863 v 3.70945 z m 11.2395,1.08744 a 0.74347917,0.74347917 0 0 1 -0.74348,0.74083 h -3.39461 a 0.74347917,0.74347917 0 0 1 -0.74612,-0.74083 v -4.42119 h 0.90487 v 1.0213 a 0.3889375,0.3889375 0 0 0 0.77523,0 v -1.0213 h 1.524 v 1.0213 a 0.3889375,0.3889375 0 0 0 0.77523,0 v -1.0213 h 0.90488 z" id="path18" style="stroke-width:0.26458332"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.27696145;stroke-opacity:1" id="rect820" width="23.020847" height="17.173929" x="1.6973457" y="271.86725"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 20.443293,290.98672 a 0.47909954,0.55825186 0 0 0 -0.663706,0.14344 5.305258,6.1817433 0 0 1 -0.483497,0.70676 5.1909776,6.0485822 0 0 1 -0.465913,0.51215 0.47470412,0.5531303 0 0 0 -0.06153,0.79386 0.46591328,0.54288714 0 0 0 0.360422,0.19975 0.49668118,0.57873818 0 0 0 0.312076,-0.13318 6.3689471,7.4211648 0 0 0 0.54503,-0.60433 6.8436511,7.9742951 0 0 0 0.580195,-0.82971 0.48349495,0.56337346 0 0 0 -0.123067,-0.78872 z" id="path68" style="stroke-width:0.474462"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 17.726931,293.21974 v 0 a 0.47909954,0.55825186 0 0 0 0.193396,1.06528 0.48789034,0.56849502 0 0 0 0.189003,-0.0461 0.08790818,0.10243154 0 0 0 0.03517,0 0.48381714,0.56374887 0 1 0 -0.404379,-1.02432 z" id="path70" style="stroke-width:0.474462"/> <path inkscape:connector-curvature="0" class="cls-1" d="M 24.029947,270.99209 H 2.4265123 a 1.4285078,1.6645124 0 0 0 -1.428508,1.66452 v 15.60031 a 1.4285078,1.6645124 0 0 0 1.428508,1.66452 H 12.483206 a 8.0084343,9.3315131 0 0 0 2.237263,4.54283 c 1.230716,1.39307 2.637246,2.13571 3.186674,2.13571 0.549425,0 1.951561,-0.74264 3.182274,-2.13571 a 7.9732711,9.2905403 0 0 0 2.237263,-4.54283 h 0.703267 a 1.4329032,1.669634 0 0 0 1.419715,-1.66452 v -15.60031 a 1.4329032,1.669634 0 0 0 -1.419715,-1.66452 z M 1.9518083,275.44274 H 24.50465 v 2.22789 H 1.9518083 Z m 0.474704,-3.33926 H 24.029947 a 0.47470412,0.5531303 0 0 1 0.474703,0.55313 v 1.67474 H 1.9518083 v -1.67474 a 0.47470412,0.5531303 0 0 1 0.474704,-0.55313 z M 20.447688,293.6141 a 6.0568729,7.0575329 0 0 1 -2.549338,1.85401 6.0348961,7.0319252 0 0 1 -2.558128,-1.81305 7.0722122,8.240617 0 0 1 -2.136168,-5.99736 v -2.76052 a 21.537501,25.095725 0 0 0 4.6899,-2.30983 22.152859,25.812747 0 0 0 4.698693,2.30983 v 2.74004 a 7.0722122,8.240617 0 0 1 -2.136168,6.01784 z m 3.573467,-4.82966 h -0.540637 a 8.197437,9.5517409 0 0 0 0.05715,-1.16772 v -3.14465 a 0.4703087,0.54800873 0 0 0 -0.351632,-0.51215 21.379266,24.911349 0 0 1 -5.050324,-2.47372 0.4703087,0.54800873 0 0 0 -0.479101,0 20.768304,24.199449 0 0 1 -5.041534,2.43787 0.4703087,0.54800873 0 0 0 -0.351632,0.51215 v 3.16515 a 8.197437,9.5517409 0 0 0 0.05715,1.16772 H 2.4265123 a 0.4703087,0.54800873 0 0 1 -0.474704,-0.54802 V 278.8025 H 24.50465 v 9.45442 a 0.47470412,0.5531303 0 0 1 -0.474703,0.54802 z" id="path72" style="stroke-width:0.474462"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 6.729618,282.68465 a 2.1977043,2.5607884 0 0 0 -0.835129,0.19462 2.1537501,2.5095725 0 0 0 -2.9844817,2.30983 2.1449594,2.4993295 0 0 0 2.9844817,2.30472 2.1054007,2.4532353 0 0 0 0.835129,0.19973 2.1493547,2.504451 0 0 0 0,-5.0089 z m -2.8658076,2.50445 a 1.1955511,1.3930689 0 1 1 1.1955506,1.38795 1.1955511,1.3930689 0 0 1 -1.1955506,-1.38795 z m 2.9844826,1.38284 a 2.1141914,2.4634784 0 0 0 0.360423,-1.38284 2.1361685,2.4890863 0 0 0 -0.360423,-1.38795 1.1955511,1.3930689 0 0 1 0,2.77079 z" id="path74" style="stroke-width:0.474462"/> <path inkscape:connector-curvature="0" class="cls-1" d="M 3.3847113,281.29158 H 5.841744 a 0.47909954,0.55825186 0 1 0 0,-1.1165 H 3.3847113 a 0.47909954,0.55825186 0 0 0 0,1.1165 z" id="path76" style="stroke-width:0.474462"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 7.230693,281.29158 h 0.02637 a 0.47909954,0.55825186 0 0 0 0,-1.1165 h -0.02637 a 0.47909954,0.55825186 0 0 0 0,1.1165 z" id="path78" style="stroke-width:0.474462"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 19.849913,286.35682 -2.553734,2.97564 -1.318622,-1.53648 a 0.47909954,0.55825186 0 0 0 -0.676893,0.78873 l 1.67465,1.95132 a 0.48789034,0.56849502 0 0 0 0.338447,0.16395 0.47909954,0.55825186 0 0 0 0.338448,-0.16395 l 2.892178,-3.37 a 0.47470412,0.5531303 0 0 0 0,-0.78873 0.48349495,0.56337346 0 0 0 -0.694474,-0.0205 z" id="path80" style="stroke-width:0.474462"/> </g></svg>
							Pagar Factura
						</li>
		
						<li id="purchase-completed" class="progressbar-item active">
							<svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" width="100" height="100" viewBox="0 0 26.458333 26.458334" version="1.1" id="svg954" sodipodi:docname="compra-completada-bio.svg" inkscape:version="0.92.3 (2405546, 2018-03-11)"> <defs id="defs948"/> <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="5.6" inkscape:cx="-1.5422546" inkscape:cy="38.724245" inkscape:document-units="mm" inkscape:current-layer="layer1" showgrid="false" units="px" inkscape:window-width="1920" inkscape:window-height="1017" inkscape:window-x="-8" inkscape:window-y="-8" inkscape:window-maximized="1"/> <metadata id="metadata951"> <rdf:RDF> <cc:Work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"/> <dc:title/> </cc:Work> </rdf:RDF> </metadata> <g inkscape:label="Capa 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-270.54165)"> <path inkscape:connector-curvature="0" class="cls-1" d="m 152.47182,104.93479 h -1.29117 v -0.57943 a 1.5266458,1.5266458 0 0 0 -1.16152,-1.47373 v -4.071945 a 0.38629167,0.38629167 0 0 0 -0.38894,-0.38629 h -9.1731 a 0.38629167,0.38629167 0 0 0 -0.38629,0.38629 v 10.620385 a 0.38629167,0.38629167 0 0 0 0.38629,0.38893 h 5.969 v 0.31221 a 1.5213542,1.5213542 0 0 0 1.52135,1.51606 h 3.39461 a 1.5187083,1.5187083 0 0 0 1.51871,-1.51606 v -4.81012 a 0.38629167,0.38629167 0 0 0 -0.38894,-0.3863 z m -2.0664,-0.57943 v 0.57943 h -1.524 v -0.57943 a 0.762,0.762 0 0 1 1.524,0 z m -9.55939,4.68841 v -9.845145 h 8.39787 v 3.704165 a 1.524,1.524 0 0 0 -1.13771,1.4658 v 0.57943 h -1.29116 a 0.38629167,0.38629167 0 0 0 -0.38894,0.3863 v 3.70945 z m 11.2395,1.08744 a 0.74347917,0.74347917 0 0 1 -0.74348,0.74083 h -3.39461 a 0.74347917,0.74347917 0 0 1 -0.74612,-0.74083 v -4.42119 h 0.90487 v 1.0213 a 0.3889375,0.3889375 0 0 0 0.77523,0 v -1.0213 h 1.524 v 1.0213 a 0.3889375,0.3889375 0 0 0 0.77523,0 v -1.0213 h 0.90488 z" id="path18" style="stroke-width:0.26458332"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.26458332;stroke-opacity:1" id="rect815" width="7.50734" height="5.3258348" x="9.7840652" y="279.89655" ry="0.017069498"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.20391062;stroke-opacity:1" id="rect835" width="0.75056797" height="5.325839" x="17.102013" y="280.09656" ry="0.019711599"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.17213303;stroke-opacity:1" id="rect835-0" width="0.70332098" height="4.0501695" x="17.653" y="280.09656" ry="0.014990185"/> <rect style="opacity:1;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:0.15452284;stroke-opacity:1" id="rect835-0-6" width="1.0180732" height="2.2547827" x="17.852581" y="280.09656" ry="0.0083452333"/> <path inkscape:connector-curvature="0" class="cls-1" d="m 19.328808,279.8071 -7.972015,-0.35232 a 0.41133633,0.41612291 0 1 0 -0.03482,0.8315 l 7.428705,0.32413 -1.459273,4.61197 h -6.502298 l -1.1736883,-6.46873 a 0.41793009,0.42279337 0 0 0 -0.25424,-0.31357 l -1.925963,-0.76455 a 0.41133334,0.41611989 0 0 0 -0.299515,0.77512 l 1.71003,0.67998 1.1945843,6.58502 a 0.41096457,0.41574683 0 0 0 0.407481,0.35232 h 0.195035 l -0.449276,1.27191 a 0.34827506,0.35232779 0 0 0 0.0383,0.31709 0.34827506,0.35232779 0 0 0 0.282103,0.14799 h 0.31693 a 1.2363765,1.2507637 0 1 0 2.159305,0.83501 1.2259282,1.2401939 0 0 0 -0.320412,-0.83501 h 2.709579 a 1.2328937,1.2472405 0 0 0 0.915964,2.08577 1.2398592,1.254287 0 0 0 1.239858,-1.25076 1.2259282,1.2401939 0 0 0 -0.320413,-0.83501 h 0.386585 a 0.34827726,0.35233004 0 1 0 0,-0.70466 h -6.58588 l 0.369171,-1.05699 h 6.216709 a 0.41096457,0.41574683 0 0 0 0.39355,-0.28891 l 1.716997,-5.42233 a 0.41793009,0.42279337 0 0 0 -0.05224,-0.35232 0.42489559,0.42983994 0 0 0 -0.320413,-0.17969 z m -3.043925,8.27267 a 0.5502746,0.55667796 0 1 1 -0.546792,0.55667 0.5502746,0.55667796 0 0 1 0.546792,-0.55667 z m -4.527575,0 a 0.5502746,0.55667796 0 1 1 -0.553757,0.55667 0.54679186,0.55315466 0 0 1 0.553757,-0.55667 z m 6.488363,-13.7866 0.599035,-1.05697 a 0.40174511,0.40642006 0 1 1 0.696549,0.40518 l -0.599033,1.05698 a 0.39703356,0.40165372 0 0 1 -0.348274,0.20083 0.41096457,0.41574683 0 0 1 -0.198517,-0.0529 0.40051633,0.40517699 0 0 1 -0.146276,-0.55316 z m 3.876303,4.32307 a 0.40051633,0.40517699 0 0 1 0.146275,-0.55315 l 1.044826,-0.60601 a 0.40174672,0.4064217 0 1 1 0.400516,0.70466 l -1.044825,0.60599 a 0.34827506,0.35232779 0 0 1 -0.198517,0.0564 0.40051633,0.40517699 0 0 1 -0.348275,-0.20435 z m 3.357371,5.15456 a 0.40051633,0.40517699 0 0 1 -0.400517,0.40518 H 23.87728 a 0.40051932,0.40518001 0 0 1 0,-0.81036 h 1.201548 a 0.39703356,0.40165372 0 0 1 0.400517,0.40518 z m -1.633411,6.16573 a 0.40051633,0.40517699 0 0 1 -0.348274,0.20435 0.42141283,0.42631664 0 0 1 -0.201999,-0.0564 l -1.044826,-0.606 a 0.40051633,0.40517699 0 0 1 -0.146275,-0.55316 0.39703356,0.40165372 0 0 1 0.543309,-0.14797 l 1.044826,0.606 a 0.39703356,0.40165372 0 0 1 0.146275,0.55315 z m -4.315127,3.96017 a 0.40051633,0.40517699 0 0 1 -0.146276,0.55316 0.36917156,0.37346747 0 0 1 -0.198517,0.0529 0.39703356,0.40165372 0 0 1 -0.348274,-0.20082 l -0.599033,-1.05698 a 0.40174503,0.40641998 0 0 1 0.696549,-0.40518 z m -5.840572,0.58486 v 1.21553 a 0.40051659,0.40517725 0 1 1 -0.801033,0 v -1.21553 a 0.40051659,0.40517725 0 0 1 0.801033,0 z m -5.3460223,-1.23314 -0.602516,1.05698 a 0.40399906,0.40870026 0 0 1 -0.546792,0.14797 0.40399906,0.40870026 0 0 1 -0.146276,-0.55315 l 0.602516,-1.05698 a 0.40174598,0.40642095 0 1 1 0.696551,0.40518 z m -3.8763021,-4.32659 a 0.39703356,0.40165372 0 0 1 -0.1462754,0.55315 l -1.0448246,0.60953 a 0.41793009,0.42279337 0 0 1 -0.1985168,0.0564 0.40051633,0.40517699 0 0 1 -0.2019996,-0.7575 l 1.0448254,-0.60958 a 0.40399906,0.40870026 0 0 1 0.546791,0.14798 z M 2.7021567,284.17598 H 1.5006078 a 0.40051932,0.40518001 0 1 1 0,-0.81036 h 1.2015489 a 0.40051932,0.40518001 0 0 1 0,0.81036 z m 1.7657539,-5.55974 a 0.40051633,0.40517699 0 0 1 -0.3482742,0.20435 0.38310256,0.38756061 0 0 1 -0.1985168,-0.0564 l -1.0448254,-0.60596 a 0.40174476,0.40641971 0 0 1 0.4005164,-0.70465 l 1.0448246,0.606 a 0.40051633,0.40517699 0 0 1 0.1462754,0.55316 z m 2.5807181,-4.97135 a 0.40174545,0.40642043 0 0 1 0.69655,-0.40518 l 0.602517,1.05699 a 0.40051633,0.40517699 0 0 1 -0.146275,0.55316 0.41444733,0.4192701 0 0 1 -0.202001,0.0529 0.39703356,0.40165372 0 0 1 -0.348275,-0.20083 z m 5.8405733,-0.58486 v -1.21554 a 0.40051659,0.40517725 0 0 1 0.801033,0 v 1.21554 a 0.40051659,0.40517725 0 0 1 -0.801033,0 z" id="path42" style="stroke-width:0.35029563"/> </g></svg>
							Compra Completada
						</li>
					</ul>`
						div_completo_metodo_pago.innerHTML = '<div class="row mt-4"><div class="col-md-12 center h3 text-center" style="color:#203876"><br><br><br><br>Desde EOS Delivery agradecemos su preferencia, nuestra prioridad es ofrecer el mejor servicio siempre. ¡Fácil, Rápido y Seguro!</div></div>';
					}

				}
				var pagadoD = pagado * _rateb;

				var resta = parseFloat((parseFloat(ra.total_pay) - pagado).toFixed(2));
				var restaD = resta * _rateb;
				restaD = up(restaD, 2);

				aPagarBs = resta;
				aPagarUsd = restaD;

				var mostrar = "";
				var titulopago = "Debes Pagar";

				if (aPagarBs <= 0) {
					mostrar = "style='display:none'";
					titulopago = "Has pagado";
				}

				if (resta > 0) {
					var colorFalta = 'text-danger';
				} else {
					var colorFalta = '';
				}

				console.log(ra);

				cuadroPagado.innerHTML = `
			<div class="row">
			<div class="col-md-6 text-left"><b>`+ titulopago + `</b></div><div class="col-md-6 text-right"><b>` + formatD(ra.total_pay) + ` / ` + formatB(htotalD) + `</b></div>
		</div>
		<div class="row" `+ mostrar + `>
			<div class="col-md-6 text-left"><b>Has pagado</b></div><div class="col-md-6 text-right"><b>`+ formatD(pagado) + ` / ` + formatB(pagadoD) + `</b></div>
		</div>
		<div class="row `+ colorFalta + `" ` + mostrar + `>
			<div class="col-md-6 text-left "><b>Saldo restante</b></div><div class="col-md-6 text-right"><b>`+ formatD(resta) + ` / ` + formatB(restaD) + `</b></div>
		</div>   
			`;
			}
			break;
		case 'consultarOrden':


			var datas = data;

			// Expresión regular para extraer el objeto JSON dentro de la cadena de texto
			var regex = /{.*}/;

			// Buscar el objeto JSON utilizando la expresión regular
			var match = datas.match(regex);

			// Verificar si se encontró un objeto JSON
			if (match) {
				try {
					// Parsear el objeto JSON encontrado en la cadena de texto a un objeto JavaScript
					var objetoJSON = JSON.parse(match[0]);

					// Ahora puedes utilizar objetoJSON como un objeto JavaScript
					data = objetoJSON
					console.log("esto es el onjeto", objetoJSON);
				} catch (error) {
					console.error("Error al parsear el objeto JSON:", error);
				}
			} else {
				console.error("No se encontró ningún objeto JSON en la cadena de texto.");
			}

			// var data = JSON.parse(data);

			if (data.success == true) {
				r = data.data[0];
				var subTotal = parseFloat(r.total_transport) + parseFloat(r.sub_total);
				var rate = JSON.parse(r.rate_json);
				for (var i = 0; i < rate.length; i++) {

					var id_rate = (+rate[i]['id']);
					_rate = parseFloat(rate[i]['rate']);
					if (id_rate == 1) break;
				}

				var totalD = up((parseFloat(Math.ceil(r.total_pay)) * _rate), 2);

				_totalProductoB = new Object();
				_totalProductoD = new Object();
				_totalProductoBConFormato = new Object();
				_totalProductoDConFormato = new Object();
				res = JSON.parse(r.productos);
				var p_totalB = 0.00;
				var p_totalD = 0.00;
				var detalles = '';


				for (var i = 0; i < res.length; i++) {
					var name = res[i]['name'];
					var cant = res[i]['cant'];
					var precio = res[i]['price'] * _rate;;
					_totalProductoB[i] = parseFloat(precio) * parseFloat(cant);
					_totalProductoBConFormato[i] = formatB(_totalProductoB[i]);
					p_totalB += _totalProductoB[i];

					_totalProductoD[i] = _totalProductoB[i] * _rate;
					_totalProductoDConFormato[i] = formatD(_totalProductoD[i]);
					p_totalD += _totalProductoD[i];


					detalles += `
					<div class="row celda" style="font-size:10px; border-bottom:1px solid #ddd">
						<div class="col-md-5 text-left">`+ name + `</div>
						<div class="col-md-3 text-right">`+ formatB(precio) + `</div>
						<div class="col-md-1 text-right">`+ cant + `</div>
						<div class="col-md-3 text-right">`+ formatB(_totalProductoB[i]) + `</div>
					</div>`;
				}

				console.log( 'Esto es el carrito',r);

				factura.innerHTML = `
				<div class="row">
					<div class="col-md-12 text-center h4" style="color:#203876">Detalles de la orden #${id_orders}</div>
				</div>

				<div id="cuadroPagado"></div>
		   
				<hr>                      
				<div class="row" style="font-size:12px">
					<div class="col-md-5 text-left"><b>Producto</b></div>
					<div class="col-md-3 text-right"><b>Precio Und.</b></div>
					<div class="col-md-1 text-right"><b>Cant.</b></div>
					<div class="col-md-3 text-right"><b>Total</b></div>
				</div>
				<div >`+ detalles + `</div>
			   <div class="row">
					<div class="col-md-6 text-left">Productos</div><div class="col-md-6 text-right">`+ formatB(r.sub_total * _rate ) + `</div>
				</div>
				<div class="row">    
					<div class="col-md-6 text-left">Envío</div><div class="col-md-6 text-right">`+ formatB(r.total_transport * _rate) + `</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-left">Sub total</div><div class="col-md-6 text-right">`+ formatB(subTotal * _rate ) + `</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-left">Exento</div><div class="col-md-6 text-right">`+ formatB(r.exento * _rate ) + `</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-left">Base Imponible.</div><div class="col-md-6 text-right">`+ formatB(r.bi * _rate) + `</div>
				</div>
				<div class="row">
					<div class="col-md-6 text-left">Impuestos</div><div class="col-md-6 text-right">`+ formatB(r.total_tax * _rate) + `</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6 text-left"><b>TOTAL A PAGAR</b></div><div class="col-md-6 text-right"><b>`+ formatB(r.total_pay * _rate) + ` / ` + formatD(r.total_pay ) + `</b></div>
			   </div>

				`;
			
				console.log('calculo', r.total_pay * _rate);
				
				

				if (document.getElementById("cuadroPagado")) {
					cuadroPagado.innerHTML = "<div class='loaderb'><div>";

					get('totalPagar', '&orders_id=' + id_orders);
				}
				if (document.getElementById("metodosPago")) {

					cuadroPagado.innerHTML = "<div class='loaderb'><div>";

					get('listarMetodosDePago');
				}
			} else {
				Swal.fire("Bio en Línea", data.msj_general);
			}

			break;

		case 'crearOrden':

			// Cadena de texto que contiene el objeto JSON y las etiquetas <script>




			console.log("Esto es el Data", data);

			// Cadena de texto que contiene el objeto JSON dentro de un script
			var datas = data;

			// Expresión regular para extraer el objeto JSON dentro de la cadena de texto
			var regex = /{.*}/;

			// Buscar el objeto JSON utilizando la expresión regular
			var match = datas.match(regex);

			// Verificar si se encontró un objeto JSON
			if (match) {
				try {
					// Parsear el objeto JSON encontrado en la cadena de texto a un objeto JavaScript
					var objetoJSON = JSON.parse(match[0]);

					// Ahora puedes utilizar objetoJSON como un objeto JavaScript
					data = objetoJSON
					console.log("esto es el onjeto", objetoJSON);
				} catch (error) {
					console.error("Error al parsear el objeto JSON:", error);
				}
			} else {
				console.error("No se encontró ningún objeto JSON en la cadena de texto.");
			}

			console.log("esto es data en objeto", data);

			// var data = JSON.parse(data);


			if (data.success == true) {
				var orders_id = data.data[0].id;
				// alert("Su orden fue procesada exitosamente, proceda a realizar el pago.");
				window.location = "/profile?orders_id=" + orders_id;

				vaciarCarrito();
			} else {
				Swal.fire("Pago en Línea", data.msj_general);
			}

			break;
		case 'web_no_login':
			console.log('Esto es lo que hay en data en el case web no login1', jsonData);

			// var data = JSON.parse(JXG.decompress(data));

			if (data.success == true) {
				let datos = data.data;
				for (var [key, value] of Object.entries(datos)) {
					setLocal(key, value);
				}
				// console.log(data);
				actualizarResumenOrden();
			}

			break;
		case 'web_no_logina':
			console.log('Esto es lo que hay en data en el case web no login2', data);
			var data = JSON.parse(JXG.decompress(data));
			break;
		case 'horasDisponiblesEntrega':
			// var data = JSON.parse(JXG.decompress(data));
			var cadena = `<script>console.log(' Entre aqui ');</script><script>console.log([{"id":1,"day":"1","hours_start":"08:00","hours_end":"18:00","status":"A","created_at":"2020-04-03 23:42:12","updated_at":"2020-04-03 23:42:12"},{"id":2,"day":"2","hours_start":"08:00","hours_end":"18:00","status":"A","created_at":"2020-04-03 23:42:31","updated_at":"2020-04-03 23:42:31"},{"id":3,"day":"3","hours_start":"08:00","hours_end":"18:00","status":"A","created_at":"2020-04-03 23:43:24","updated_at":"2020-04-03 23:43:24"},{"id":4,"day":"4","hours_start":"08:00","hours_end":"18:00","status":"A","created_at":"2020-04-03 23:43:45","updated_at":"2020-04-03 23:43:45"},{"id":5,"day":"5","hours_start":"08:00","hours_end":"18:00","status":"A","created_at":"2020-04-03 23:44:04","updated_at":"2020-04-03 23:44:04"}]);</script><script>console.log([{"id":0,"time":1707222090,"name":"Martes - 08:21AM"},{"id":1,"time":1707225690,"name":"Martes - 09:21AM"},{"id":2,"time":1707229290,"name":"Martes - 10:21AM"},{"id":3,"time":1707232890,"name":"Martes - 11:21AM"},{"id":4,"time":1707236490,"name":"Martes - 12:21PM"},{"id":5,"time":1707240090,"name":"Martes - 01:21PM"},{"id":6,"time":1707243690,"name":"Martes - 02:21PM"},{"id":7,"time":1707247290,"name":"Martes - 03:21PM"},{"id":8,"time":1707250890,"name":"Martes - 04:21PM"},{"id":9,"time":1707254490,"name":"Martes - 05:21PM"},{"id":10,"time":1707308490,"name":"Miercoles - 08:21AM"},{"id":11,"time":1707312090,"name":"Miercoles - 09:21AM"}]);</script><script>console.log({"success":true,"msj_general":"Listando horas disponible para entrega","data":[{"id":0,"time":1707222090,"name":"Martes - 08:21AM"},{"id":1,"time":1707225690,"name":"Martes - 09:21AM"},{"id":2,"time":1707229290,"name":"Martes - 10:21AM"},{"id":3,"time":1707232890,"name":"Martes - 11:21AM"},{"id":4,"time":1707236490,"name":"Martes - 12:21PM"},{"id":5,"time":1707240090,"name":"Martes - 01:21PM"},{"id":6,"time":1707243690,"name":"Martes - 02:21PM"},{"id":7,"time":1707247290,"name":"Martes - 03:21PM"},{"id":8,"time":1707250890,"name":"Martes - 04:21PM"},{"id":9,"time":1707254490,"name":"Martes - 05:21PM"},{"id":10,"time":1707308490,"name":"Miercoles - 08:21AM"},{"id":11,"time":1707312090,"name":"Miercoles - 09:21AM"}],"login":true});</script>`;

			var parser = new DOMParser();
			var doc = parser.parseFromString(data, 'text/html');

			var jsonData;
			var scripts = doc.querySelectorAll('script');
			scripts.forEach(script => {
				var content = script.textContent.trim();
				if (content.startsWith('console.log(') && content.endsWith(');')) {
					var jsonContent = content.substring(content.indexOf('(') + 1, content.lastIndexOf(')'));
					try {
						jsonData = JSON.parse(jsonContent);
					} catch (error) {
						// JSON no válido en este script
					}
				}
			});

			console.log("Esto es el jsonData", jsonData);

			console.log("esto es data horas Disponibles de entrega", data);

			var options = '';
			if (jsonData.success) {
				console.log("entre aqui en data succes", jsonData);
				var datos = jsonData.data;
				for (var [key, value] of Object.entries(datos)) {
					options += "<option value=" + value.time + ">" + value.name + "</option>";
					console.log(key + " Esto es un espacio " + value.name);
				}
				div_fecha.innerHTML = "<select class='form-control' id='fecha_hora_entrega' name='timepick' v-model='datetime' name='fecha_hora_entrega'>" + options + "</select>";
			} else {
				// alert(data.msj_general);
				return false;
			}
			break;
		case 'getAdreess':

			var data = JSON.parse(data);

			console.log("data getAddress::> ", data);

			var options = '';

			if (data.success) {

				var datos = data;

				options += "<option value='0' id='one_value'>Pick - Up</option>";

				for (var key in datos) {
					if (key === "success" || key === "msj_general") {
						continue; // Saltar las claves "success" y "msj_general"
					}

					var value = datos[key];

					options += "<option value=" + value.id + ">" + value.address + " - " + value.st_name + ", " + value.re_name + ", " + value.urb + ", " + value.sector + ", #" + value.nro_home + "</option>";

				}

				div_direccion_entrega.innerHTML = "<select style='pointer-events: none;' onchange='activarEnvio(this)' class='form-control' id='direccion_selected' name='direccion' v-model='selectedDirection'  >" + options + "</select><br><a href='/profile'>Agregar nueva dirección</a>";

			} else {

				div_direccion_entrega.innerHTML = "<select class='form-control' id='direccion_selected' name='direccion' v-model='selectedDirection'><option value='0'>Pick - Up</option></select><br><a href='/profile?tab=my-address'>Agregar nueva dirección</a>";
				//alert(data.msj_general);

				return false;
			}

			break;

	}

}
function procesarOrden() {

	if (document.getElementById("direccion_selected")) {
		console.log("esto es apagar usd", aPagarUsd);
		if (checkDeliveryType == 2 && aPagarUsd < 3) {
			Swal.fire("Pago en Línea", "Para este tipo de delivery el monto debe ser al menos de 3$", "error");
		} else {
			Swal.fire({
				title: 'Pago en Línea',
				text: "A partir de este momento no podra modificar su carrito, esta seguro de continuar?",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.value) {

					var datos = getLocal('cartNew');
					var orden = new Object();
					var arrProductos = new Object();

					if (direccionOrden == 0 || direccionOrden == '0') {
						// orden['direccion']= "NULL";
						//orden="direccion:NULL";
						orden.direccion = 'NULL';
						//orden.push('direccion: '+'NULL');
						orden.delivery_type = document.getElementById('dvy_type').value;

					} else {
						//orden['direccion']= direccionOrden;
						//orden.push('direccion: '+direccionOrden);
						orden.direccion = direccionOrden;
						orden.delivery_type = document.getElementById('dvy_type').value;
						//orden.set("direccion",direccionOrden);
						//orden.add
					}

					orden.hora_entrega = fecha_hora_entrega.value;
					// orden.push('hora_entrega: '+fecha_hora_entrega.value);
					//orden.set("hora_entrega",fecha_hora_entrega.value);

					for (var [key, value] of Object.entries(datos)) {
						var id = value.product.id;
						var cant = value.cant;

						arrProductos[id] = cant;
						//arrProductos.set("cant",id);
					}
					//orden.push('productos:{'+arrProductos+'}');
					orden.productos = arrProductos;
					//orden.set("productos",arrProductos);
					//orden.push('productos: '+fecha_hora_entrega.value);
					var json = JSON.stringify(orden);
					// console.log(json);
					get('crearOrden', '&json=' + json);
				}
			});
		}
	} else {
		Swal.fire("Bio en Línea", "No hay direcciones registradas", "error");
	}

}

function activarEnvio(a) {

	var dataOption = document.getElementById("direccion_selected").value;

	if (a.value == 0) {
		activar_envio = false;
		direccionOrden = null;
	} else if (a.value == 1) {
		direccionOrden = dataOption;
		activar_envio = true;
	} else if (a.value == 2) {
		activar_envio = false;
		direccionOrden = dataOption;
	}
	actualizarResumenOrden();
}
function getOrder(id) {
	window.location = "/profile?orders_id=" + id.value;

}

function actualizarResumenOrden() {
	try {
		console.log("se actualizo el resumen de orden");
		var h = '';
		var productos = getLocal('productosb');
		var d_envio = getLocal('envio').data[0];
		console.log("esto es lo que hay en envio", d_envio);
		// console.log(d_envio);

		var detalle = '';
		var totalB = 0.00;
		var totalD = 0.00;
		var totalPeso = 0.00;
		var totalEnvioB = 0.00;
		var totalEnvioD = 0.00;
		var datos = getLocal('cartNew');
		console.log("Estos son los datos del cartNew", datos);

		console.log(productos);

		if (datos) {

			var contador = 0;
			for (var [key, value] of Object.entries(datos)) {
				console.log("Estos son los valores de value en carnew", value);
				var p = productos[value.product.id];
				console.log("esto es el producto", p);
				if (p != null) {
					var peso = parseFloat(p.peso);
					contador++;
					var cant = value.cant;
					console.log("esto es la cantidad", cant);
					// var precio_con_iva = (p.total_precio * cant);
					// var precio_dolar = (p.total_precio_dolar * cant);
					var precio_con_iva = (p.price * cant);
					var precio_dolar = parseFloat((p.price * cant) * productos.tasadolar);
					var nombre = p.name;
					totalB += precio_con_iva;
					totalD += precio_dolar;
					totalPeso += peso * cant;
					console.log("precio dolar carrito", precio_dolar, "p price", p.price, "productos tasadolar", productos.tasadolar);
					detalle += '<div class="row" style="margin-bottom:5px; border-bottom:1px solid #ddd "><div class="col-md-1" style="margin:0"><img width="30px" src="storage/' + p.image + '"></div><div class="col-md-5" style="font-size:13px">' + nombre + ' <span style="color:red"> X ' + cant + '</span></div><div class="col-md-5" style="text-align:right">' + formatB(precio_con_iva) + '<br>' + formatD(up(precio_dolar, 2)) + '</div></div>';
				}
			}


			var peso_max = d_envio.peso_max;
			var precioEnvioB = d_envio.precio_b;
			var precioEnvioD = d_envio.precio_d;
			var peso_cargado = peso_max;
			var multiplo_peso = 1;

			// var peso_max = 23;
			// var precioEnvioB = 14;
			// var precioEnvioD = 18;
			// var peso_cargado = 15;
			// var multiplo_peso = 1;

			while (totalPeso > peso_cargado) {
				multiplo_peso++;
				peso_cargado += (peso_max + peso_cargado);
			}

			if (activar_envio == false) {
				multiplo_peso = 0;
			}



			totalEnvioB = precioEnvioB * multiplo_peso;
			totalEnvioD = precioEnvioD * multiplo_peso;
			totalPagarB = totalEnvioB + totalB;
			totalPagarD = totalEnvioD + totalD;

			aPagarUsd = totalPagarD;

			console.log("total envio Dolar", totalEnvioD, "totalD", totalD);

			console.log("Total a pagar D", totalPagarD);

			console.log("esto es el total a pagar", aPagarUsd);

			h = '<div class="detalleOrdenProducts">' + detalle + '</div><br>' +
				'<div class="row"><div class="col-md-4">Sub total:</div><div class="col-md-8" style="text-align:right">' + formatB(totalB) + ' / ' + formatD(up(totalD, 2)) + '</div></div>' +
				'<div class="row"><div class="col-md-4">Envío:</div><div class="col-md-8" style="text-align:right">' + formatB(totalEnvioB) + ' / ' + formatD(up(totalEnvioD, 2)) + '</div></div>' +
				'<div class="row"><div class="col-md-4" style="font-size:17px">TOTAL:</div><div class="col-md-8" style="font-size:17px; text-align:right">' + formatB(totalPagarB) + ' / ' + formatD(up(totalPagarD, 4)) + '</div></div>' +
				'<div class="row"><div class="col-md-12" style="color:red; text-align:right">(impuestos incluidos)</div></div><br>';
		}

		if (document.getElementById("div_resumen_compra")) {
			div_resumen_compra.innerHTML = h;
		}

		if (document.getElementById("div_resumen_compra2")) {
			div_resumen_compra2.innerHTML = h;
		}
	} catch (error) {
		console.error("Error al actualizar el resumen de la orden:", error);
		// Puedes agregar aquí código adicional para manejar el error, como mostrar un mensaje al usuario o realizar acciones de recuperación.
	}
}

function actualizarStore() {
	get('web_no_login');
}

window.onload = function () {
	// setInterval('actualizarStore()',1500);
}

function get(evento, variables = "") {
	var host = window.location.host;
	var protocol = window.location.protocol;
	var xmlhttp = new XMLHttpRequest();
	console.log("esto es el evento", evento);
	let data = new Map();
	data['success'] = false;
	data['msj_general'] = "Intente mas tarde";
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
			if (xmlhttp.status == 200 || xmlhttp.status == 409) {
				console.log("entre aqui en xmlhttp 200", xmlhttp.responseText);
				procesar(xmlhttp.responseText, evento); // Pasar xmlhttp.responseText a procesar
			} else {
				procesar(JSON.stringify(data), evento); // Si hay un error, pasar data como cadena JSON a procesar
			}
		}
	};

	console.log(evento);

	xmlhttp.open("GET", protocol + "//" + host + "/api_rapida.php?evento=" + evento + variables, true);
	xmlhttp.send();

}


function post(evento, datai) {
	//var datai = new FormData(document.getElementById(idFormulario));

	datai.append("evento", evento);

	var host = window.location.host;
	var protocol = window.location.protocol;
	var xmlhttp = new XMLHttpRequest();
	let data = new Map();
	data['success'] = false;
	data['msj_general'] = "Intente mas tarde";
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
			if (xmlhttp.status == 200 || xmlhttp.status == 409) {
				procesar(xmlhttp.responseText, evento);
			} else {
				procesar(data, evento);
			}
		}
	};

	xmlhttp.open("POST", protocol + "//" + host + "/api_rapida.php", true);
	xmlhttp.send(datai);
}

function setLocal(key, value) {
	localStorage.setItem(key, JSON.stringify(value));
}
function getLocal(key) {
	return JSON.parse(localStorage.getItem(key));
}
function delLocal(key) {
	localStorage.removeItem(key);
}

function formatB(amount) {
	return formatMoney(amount, 2, ",", ".") + " Bs";
}
function formatD(amount) {
	return "$" + formatMoney(amount, 2, ".", ",");
}
function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
	try {
		decimalCount = Math.abs(decimalCount);
		decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

		const negativeSign = amount < 0 ? "-" : "";

		let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
		let j = (i.length > 3) ? i.length % 3 : 0;

		return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
	} catch (e) {
		console.log(e)
	}
}
function vaciarCarrito() {
	// localStorage.clear();
	localStorage.removeItem('cartNew');
	localStorage.setItem('ModalPrincipal', 'visto');
}

function formato_moneda(value) {
	var listo = '';
	var b = value.trim();
	var c;
	// b=b.replaceAll(RegExp(r'\s'), '');
	// b=b.replaceAll(RegExp(r',\.'), ' ');
	b = b.split(' ').join('');
	b = b.split('.').join(' ');
	b = b.split(',').join(' ');
	//b=b.replaceAll(' ', '');
	//b=b.replaceAll('.', ' ');
	//b=b.replaceAll(',', ' ');
	c = b.split(' ');

	var total = c.length;

	if (total > 1) {
		c[total - 1] = "." + c[total - 1];

		//  for(int i=0; i<c.length; i++){
		//  listo=listo+c[i];
		// }
		c.forEach((element) => listo = listo + element);
	} else {
		listo = b;
	}
	return listo;
}

function getPaymentData(paymentData) {
	paymentDataip = paymentData;
	if (!paymentDataip) {
		Swal.fire("Bio en Línea", "Su pago no se ha podido procesar, intente nuevamente!!", "error");
		document.getElementById("div_btn_guardar_pago").innerHTML = "<div class='loaderb'><div>";
		location.reload();
	}
}

function successPayment() {
	/*data = paymentDataip;
	if(data.status == 'ok'){
		procesarPago();
	}else{
		Swal.fire("Bio en Línea","Su pago no se ha podido procesar, intente mas tarde!!","error");
		document.reaload();
	}*/
	document.getElementById("div_btn_guardar_pago").innerHTML = "<div class='loaderb'><div>";
	location.reload();
}



	var optionZero = document.createElement('option');
	optionZero.value = '0';
	optionZero.id = 'one_value';
	optionZero.textContent = 'Pick - Up';
	
	if (typeof selectDireccion !== 'undefined') {
		selectDireccion.add(optionZero);
	}
	


function deli_type(e) {
	var column = document.getElementById('select_address');
	var divDireccionEntrega = document.getElementById('div_direccion_entrega');
	var selectDireccion = document.getElementById('direccion_selected');
	

	checkDeliveryType = e.value;
	if (parseInt(e.value) > 0) {
		// Mostrar el select y otros elementos
		console.log("entre auqi en E VALUE",)
		column.style.display = 'block';

		var oneValueElement = document.getElementById('one_value');
		if (oneValueElement) {
			oneValueElement.style.display = 'block';
		}
		selectDireccion.style.pointerEvents = 'auto';

		// Guardar una copia de la opción con valor 0 si aún no se ha guardado


		// Eliminar la opción con valor 0 del select si existe
		for (var i = 0; i < selectDireccion.options.length; i++) {
			if (selectDireccion.options[i].value == '0') {
				selectDireccion.remove(i);
				break;
			}
		}

		// Seleccionar la primera opción después de eliminar la opción con valor 0
		selectDireccion.selectedIndex = 0;

	} else {
		if (optionZero === null) {
			optionZero = document.createElement('option');
			optionZero.value = '0';
			optionZero.id = 'one_value';
			optionZero.textContent = 'Pick - Up';
		}
		if (optionZero !== null) {
			selectDireccion.add(optionZero); // Agregar la opción al final del select
		}
		// Ocultar el select y otros elementos si el valor de e es 0 o menor
		console.log("esto es optionZero", optionZero);
		column.style.display = 'block';
		document.getElementById('one_value').style.display = 'block';
		selectDireccion.style.pointerEvents = 'none';
		selectDireccion.selectedIndex = selectDireccion.options.length - 1;

		// Agregar la opción con valor 0 si se ha guardado

	}


	if (parseInt(e.value) == 2 || parseInt(e.value) == 1) {
		console.log("Entre en Contenedor de fechas");
		document.getElementById("div_contenedor_fecha").style.display = 'block';
	} else {
		document.getElementById("div_contenedor_fecha").style.display = 'none';
	}

	document.getElementById('dvy_type').value = e.value;

	activarEnvio(e);
}

function up(v, n) {
	return Math.ceil(v * Math.pow(10, n)) / Math.pow(10, n);
}