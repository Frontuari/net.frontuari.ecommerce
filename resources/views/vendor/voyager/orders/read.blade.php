
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
#t{
    border:1px solid #000;
    margin:0 auto;
}
.titu{
    text-align:center
}
#t td { padding: 1px; }
</style>
<table id='t'>
<tr>
    <td class='titu' colspan='2'>SENIAT</td>
</tr>
<tr>
    <td class='titu' colspan='2'>J-317219686</td>
</tr>
<tr>
    <td class='titu' colspan='2'>ALIMENTOS FM C.A.</td>
</tr>
<tr>
    <td class='titu' colspan='2'>CALLE CALLEJON MAÑONGO (176)</td>
</tr>
<tr>
    <td class='titu' colspan='2'>TERRENO CIVICO NRO. 01-A-15 LOCAL 1</td>
</tr>
<tr>
    <td class='titu' colspan='2'>NRO 1 URB MAÑONGO NAGUANAGUA</td>
</tr>
<tr>
    <td class='titu' colspan='2'>ESTADO CARABOBO ZONA POSTAL 2005</td>
</tr>
<tr>
    <td>Documento: $nro_factura</td>
    <td></td>
</tr>
<tr>
    <td>Cliente: $o->nombre_usuario</td>
    <td></td>
</tr>
<tr>
    <td>Rif: $o->rif</td>
    <td>Teléfonos: $o->phone $o->phone_home</td>
</tr>
<tr>
    <td>Dirección: $direccion_usuario</td>
    <td></td>
</tr>

<tr>
    <td>Dirección de entrega: $direccion_entrega</td>
    <td></td>
</tr>
<tr>
    <td>Fecha para entrega: $fecha_entrega</td>
    <td></td>
</tr>
<tr>
    <td>Cajero: E-commerce</td>
  
    <td>Caja: N/P</td>
</tr>

<tr>
<td  class='titu' colspan='2'>FACTURA</td>
</tr>

<tr>
    <td>Factura:</td>
    <td>$nro_factura</td>
</tr>
<tr>
    <td>Fecha: $fecha_factura</td>
    <td>Hora: $hora_factura</td>
   
</tr>
<tr>
    <td colspan='2'>&nbsp;</td>
  
</tr>
";

$pro=json_decode($o->productos);

foreach($pro as $k=>$v){
    $fac.="<tr>
    <td>$v->cant x $v->name</td>
    <td>".formato_numero($v->price*$v->cant)."</td>
    </tr>";
}


$fac.="
<tr>
    <td colspan='2'>&nbsp;</td>
  
</tr>
<tr>
    <td>Productos</td>
    <td>".formato_numero($o->sub_total)."</td>
</tr>
<tr>
    <td>Envío</td>
    <td>".formato_numero($o->total_transport)."</td>
</tr>
<tr>
    <td>Sub total</td>
    <td>".formato_numero($o->total_transport+$o->sub_total)."</td>
</tr>
<tr>
    <td>Exento</td>
    <td>".formato_numero($o->exento)."</td>
</tr>
<tr>
    <td>Base imponible</td>
    <td>".formato_numero($o->bi)."</td>
</tr>
<tr>
    <td>Impuestos</td>
    <td>".formato_numero($o->total_tax)."</td>
</tr>
<tr>
    <td>TOTAL</td>
    <td>".formato_numero($o->total_pay)."</td>
</tr>

</table>
";
echo $fac;
//bonito($a);
}else{
    echo "Disculpe, no hay datos disponibles.";
}



function bonito($var){
echo "<pre>".print_r($var,true)."</pre>";
}

function formato_numero($numero){
	return "Bs ".number_format($numero, 4, ".", ",");
	}
    
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
