
@extends('voyager::master')
<?php
if(!isset($_GET['minimo'])){
    ?>
@section('page_title', __('voyager::generic.view').' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

        @can('edit', $dataTypeContent)
         @if( $rol=Auth::user()->role_id!=7)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager::generic.edit') }}
            </a>
            @endif
        @endcan
        @can('delete', $dataTypeContent)
            @if($isSoftDeleted)
                <a href="{{ route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey()) }}" title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore" data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
                </a>
            @else
                <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
                </a>
            @endif
        @endcan

        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop
<?php
}
?>
@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
<?php
//$evento='consutar_nuevas_ordenes_deliveryd';
//$url=url('/').'/api_rapida_admin.php?token=leonardomelendez&evento='.$evento;

$id=$dataTypeContent->getAttribute('id');


//Se debe realizar una funcion global para manejar correctamente la moneda base del eCommerce (ya sea Dolar o Bolivar).
//El manejo de la moneda de funcionar dinamicamente
$sql="SELECT 
    (
        SELECT 
            json_agg(
                json_build_object(
                    'id', op.products_id, 
                    'cant', op.cant,
                    'image', p.photo,
                    'name', p.name,
                    'price', op.price
                )
            ) 
        FROM 
            order_products op 
        INNER JOIN 
            products p ON p.id = op.products_id 
        WHERE 
            op.orders = o.id
    ) AS productos,
    oa.address,
    p.phone,
    p.phone_home,
    p.name AS nombre_usuario,
    p.rif,
    p.name AS nombre_usuario,
    concat_ws(', ', 'Zipcode:' || oa.zip_code, oa.urb, oa.sector, '#' || oa.nro_home, oa.reference_point) AS dir_entrega,
    o.*,
    TO_CHAR(o.created_at, 'dd/mm/yyyy HH12:MI AM') AS fecha,
    TO_CHAR(o.delivery_time_date, 'dd/mm/yyyy HH12:MI AM') AS fecha_entrega,
    os.name AS status_tracking,
    t.orders_status_id 
FROM 
    (
        SELECT 
            o.*,
            MAX(t.id) as t_id 
        FROM 
            orders o 
        INNER JOIN 
            trackings t ON t.orders_id = o.id 
        GROUP BY 
            o.id
    ) o 
INNER JOIN 
    trackings t ON t.id = o.t_id 
INNER JOIN 
    orders_status os ON os.id = t.orders_status_id 
LEFT JOIN 
    order_address oa ON oa.id = o.order_address_id 
INNER JOIN 
    users ON o.users_id = users.id 
INNER JOIN 
    peoples p ON p.id = users.peoples_id 
WHERE 
    o.id = '$id'
";



//exit($sql);
$a=DB::select($sql);

function formato_numero($numero){
	return "Bs ".number_format($numero, 4, ".", ",");
	}

if(isset($a)){
    $o=$a[0];
$nro_factura=str_pad($o->id, 8, "0", STR_PAD_LEFT);
$direccion_usuario=($o->dir_entrega=='' ? 'Valencia' : $o->dir_entrega);
$direccion_entrega=($o->dir_entrega=='' ? $o->address : $o->dir_entrega);
$transport_id = $o->transports_id;

if($direccion_entrega==''){
    $direccion_entrega='Retirar en Zona Pickup';
}
//$fecha_factura=date('d/m/Y',strtotime($o->fecha_enviado_bio));
//$hora_factura=date('h:i:s A',strtotime($o->fecha_enviado_bio));
$fecha_factura=date('d/m/Y',strtotime($o->created_at));
$hora_factura=date('h:i:s A',strtotime($o->created_at));
if($transport_id != 3){
   $fecha_entrega=$o->fecha_entrega; 
}else{
    $fecha_entrega="Antes de 24 horas recibira su pedido";
}




$fac= "
<style>
    /* Estilo general para la tabla */
    table {
        width: 50%;
        max-width: 800px;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        margin: 0 auto;
    }

    /* Estilo para las celdas de título */
    table thead {
        //border-bottom: 1px solid #1e1e1e;
    }
    table thead tr th {
        color: #1e1e1e;
        font-size: 10px;
        text-align: center;
    }
    table thead tr #titulo {
        background-color: #fff;
        font-weight: bold;
        font-size: 2vw;
    }
    tbody tr td {
        //border-bottom: 1px solid #ddd;
        word-wrap: break-word;
        padding: 3px 2vw;
    }
    tbody tr .subTitulo {
        font-weight: bold;
        border-bottom: 1px solid #ddd;
    }  
    tbody tr .direccionEntrega {
        padding-bottom: 1.5vw;
    }
        
    tbody tr .subTituloInformacion {
        font-weight: bold;
        border-bottom: 1px solid #ddd;
        padding-top: 1vw;
    }  
    tbody tr .columnaPaddingBottom {
        padding-bottom: 1.5vw;
    }  
    tbody tr .segundoTitulo {
        background-color: #3c3c3c;
        color: #fff;
        font-weight: bold;
        text-align: center;
        padding: 10px;
    }
    tbody tr .tituloDetalle {
        background-color: #3c3c3c;
        color: #fff;
        font-weight: bold;
        padding: 10px 2vw;
    }
    tbody tr .detalleFactura {
        font-weight: bold;
        border-bottom: 1px solid #ddd;
        padding-top: 10px;
        padding-bottom: 10px;
    }  
</style>

<table id='t'>
    <thead>
        <tr>
            <th colspan='2'>SENIAT</th>
        </tr>
        <tr>
            <th colspan='2'>J-317219686</th>
        </tr>
        <tr>
            <th colspan='2'>ALIMENTOS FM C.A.</th>
        </tr>
        <tr>
            <th colspan='2'>CALLE CALLEJON MAÑONGO (176)</th>
        </tr>
        <tr>
            <th colspan='2'>TERRENO CIVICO NRO. 01-A-15 LOCAL 1</th>
        </tr>
        <tr>
            <th colspan='2'>NRO 1 URB MAÑONGO NAGUANAGUA</th>
        </tr>
        <tr>
            <th colspan='2'>ESTADO CARABOBO ZONA POSTAL 2005</th>
        </tr>
        <tr>
            <th id='titulo' colspan='2'>FACTURA</th>
        </tr>
        <tr>
            <th id='titulo' colspan='2'>$nro_factura</th>
        </tr>
    </thead>
    <tbody>
        <!-- INFORMACIÓN DE LA FACTURA -->
        <tr>
            <td class='subTitulo'>Cliente:</td>
            <td class='subTitulo'>Teléfonos:</td>
            <!-- <td>Cajero: E-commerce</td> -->
        </tr>
        <tr>
            <td>$o->nombre_usuario</td>
            <td>$o->phone $o->phone_home</td>
        </tr>
        <tr>
            <td class='subTitulo'>RIF:</td>
            <td class='subTitulo'>Dirección:</td>
            <!-- <td>Caja: N/P</td> -->
        </tr>
        <tr>
            <td>$o->rif</td>
            <td>$direccion_usuario</td>
        </tr>
        <tr>
            <td class='subTitulo' colspan='2'>Dirección de entrega:</td>
        </tr>
        <tr>
            <td class = 'direccionEntrega'>$direccion_entrega</td>
        </tr>
        <!-- DETALLE DE LA FACTURA -->

        <tr>
            <td class='segundoTitulo' colspan='2'>INFORMACIÓN DE LA FACTURA</td>
        </tr>
        <tr>
            <td class='subTituloInformacion'>Fecha:</td>
            <td class='subTituloInformacion'>Hora:</td>
        </tr>
        <tr>
            <td class='columnaPaddingBottom '>$fecha_factura</td>
            <td class='columnaPaddingBottom '>$hora_factura</td>
        </tr>
    </tbody>
";

$pro=json_decode($o->productos);
$jsonTasaCambio = json_decode($o->rate_json);

//Se trae la Tasa de Cambio de Dolares a Bolivares. Favor de hacer dinamico
foreach($jsonTasaCambio as $k=>$v){
    if ($v->id == 1){
        $tasaCambio = $v->rate;
    }
}

foreach($pro as $k=>$v){
    $fac.="
    <tr>
        <td class='tituloDetalle'>Descripción</td>
        <td class='tituloDetalle'>Total</td>
    </tr>
    <tr>
        <td class='detalleFactura'>$v->cant x $v->name</td>
        <td class='detalleFactura'>".formato_numero(($v->price*$v->cant) * $tasaCambio)."</td>
    </tr>";
}


$fac.="
<tr>
    <td>Productos</td>
    <td>".formato_numero($o->sub_total * $tasaCambio)."</td>
</tr>
<tr>
    <td>Envío</td>
    <td>".formato_numero($o->total_transport * $tasaCambio)."</td>
</tr>
<tr>
    <td>Sub total</td>
    <td>".formato_numero(($o->total_transport+$o->sub_total) * $tasaCambio)."</td>
</tr>
<tr>
    <td>Exento</td>
    <td>".formato_numero($o->exento * $tasaCambio)."</td>
</tr>
<tr>
    <td>Base imponible</td>
    <td>".formato_numero($o->bi * $tasaCambio)."</td>
</tr>
<tr>
    <td>Impuestos</td>
    <td>".formato_numero($o->total_tax * $tasaCambio)."</td>
</tr>
<tr>
    <td>TOTAL</td>
    <td>".formato_numero($o->total_pay * $tasaCambio)."</td>
</tr>

</table>
";
echo $fac;
//bonito($a);
}else{
    echo "Disculpe, no hay datos disponibles.";
}


//Esta fue una funcion creada para debuggear. Sin embargo, no tiene utilidad y tiende a causar muchos problemas a nivel de fuente. Usar en cambio dd(<nombre de la variable a ver datos>) que es nativo de Laravel
/*function bonito($var){
echo "<pre>".print_r($var,true)."</pre>";
}*/
    
?>

                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->getTranslatedAttribute('display_name_singular')) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
