<?php
cabecera('On');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$a=extraer_datos_db();
$con=conectar_db($a['host'],$a['database'],$a['user'],$a['password'],$a['port']);
$datos=run();
session_start();

$json=$_GET['json'];
$_GET=seguro($_GET);
$_POST=seguro($_POST);

$host = $_SERVER['HTTP_HOST'];

    include_once './Clases/Login.php';
    include_once './Clases/LeerXML.php';
    include './constantes.php';
   
   // $archivo=fopen("log.txt",'a+');
    //fwrite($archivo,"PaginaWeb: Llegando a nuestro servidor\n");
    
   $numeroControl=$_GET['control'];
    //$numeroControl='1588992434924134839';
    //$numeroControl='1588970854595134761'; //mala
    //echo $numeroControl;
    if(!$numeroControl) echo "Disculpe, intente mas tarde";
   // fwrite($archivo,"Control: $numeroControl\n");
    
    $url=URL_MEGA."/payment/action/paymentgatewayuniversal-querystatus?control=$numeroControl";
    
    //fwrite($archivo,"URL de petición de XML: $url\n");
    
    $control = new Login();
    

   // fwrite($archivo,"Obteniendo Login\n");
   // fwrite($archivo,"Datos a enviar:\n");
   // fwrite($archivo,"URL:".$url." USERNAME: ".USERNAME." PASSWORD: ".PASSWORD."\n");
    
    $xml=$control->loginHTTPS($url,USERNAME,PASSWORD);
   // fwrite($archivo,"Resultado $xml \n");
    
   // fclose($archivo);
    $xml= new leerXML($xml);
    echo '<div style="display:none">'.$xml->getEstado().'</div>';
    if($xml->getEstado()=='A'){
        salidaBuena($xml);
    }elseif($xml->getEstado()=='R'){
        salidaMala($xml);
    }else{
        header("Location: ".'http://'.$host.'/mega/PreRegistro.php?nro_orden='.$xml->getFactura().'&total='.$xml->getMonto());
        
    }

function salidaMala($xml){
    echo '
    <div style="text-align: center; "><img src="../logo.png" width="200" /></div>
<p>&nbsp;</p>
<div style="text-align: center;">Transacción <b><span style="color:red">RECHAZADA</span></b><br> <b>Cod. '.$xml->getCodigo().' '.$xml->getDescripcion().'</b><br><br> <a href="http://'.$host.'/mega/PreRegistro.php?nro_orden='.$xml->getFactura().'&total='.$xml->getMonto().'">haga clic aquí para intentar nuevamente.</a><br /><br /><hr />www.biomercados.com.ve</div>     
    ';


    $orders_id=$xml->getFactura();
    $sql="SELECT u.id,u.purchase_quantity,u.email FROM orders o INNER JOIN users u ON u.id=o.users_id WHERE o.id='$orders_id'";
    $arr=q($sql);
    if(is_array($arr)){
     $users_email=$arr[0]['email'];
    }
    enviarCorreo($users_email,'VOUCHER DE PAGO RECHAZADO',formatear($xml->getVoucher()));
    exit();
}
function salidaBuena($xml){
    echo '
    <div style="text-align: center; "><img src="../logo.png" width="200" /></div>
<p>&nbsp;</p>
<div style="text-align: center;">Transacción <b><span style="color:green">APROBADA</span></b><br />
Nro de control '.$xml->getControl().'
Orden Nro. '.$xml->getFactura().'<br>
Referencia. '.$xml->getReferencia().'<br>
<br /><hr />www.biomercados.com.ve</div>     
    ';

    $amount=$xml->getMonto()/100;
    //$amount=set_formato_moneda($xml->getMonto());
   // exit("monto: ".$amount." origen: ".$xml->getMonto()." otros ".$xml->getVoucher());
    $orders_id=$xml->getFactura();
    $bank_datas_id=3;
    $ref="MEGA ".$xml->getReferencia()." ".$xml->getControl();
    $description=substr(segurob($xml->getVoucher()), 0, 254);
    $coins_id=2;
    $status='aprobado';

    //PARA ARREGLAR PROBLEMA DE DIFERENCIAS EN DECIMALES CAMBIARIAS
    $diferencia_aceptable=0;
    if($coins_id==1){ //dolares
        $diferencia_aceptable=convertir_a_bs($coins_id,0.01);
        $sumar_sql="+$diferencia_aceptable";
       
    }
    //----------------------

    $sql="SELECT u.id,u.purchase_quantity,u.email FROM orders o INNER JOIN users u ON u.id=o.users_id WHERE o.id='$orders_id'";
   $arr=q($sql);
   if(is_array($arr)){
    $users_id=$arr[0]['id'];
    $users_purchase_quantity=$arr[0]['purchase_quantity'];
    $users_email=$arr[0]['email'];
   }
    q("BEGIN");
    $sql="INSERT INTO det_bank_orders (description,coins_id,other_amount,status,ref,amount,orders_id,bank_datas_id,created_at,updated_at,users_id) VALUES('$description','$coins_id','$diferencia_aceptable','$status','$ref',$amount,$orders_id,$bank_datas_id,NOW(),NOW(),$users_id) RETURNING id";
   // exit($sql);
    $arr=q($sql);
    if(is_array($arr)) $pagoAbonado=true;

    $sql="SELECT id FROM orders WHERE id=$orders_id AND total_pay<=((SELECT (SUM(amount)$sumar_sql) as amount FROM det_bank_orders dbo WHERE dbo.orders_id=$orders_id and (status='aprobado' OR status='efectivo') GROUP BY dbo.orders_id))"; 
    //exit($sql);
    $arr=q($sql);

    if(is_array($arr)){
        $order_status_id=4;
        $arr=q("INSERT INTO trackings (orders_id,orders_status_id,users_id,created_at,updated_at) VALUES ($orders_id,$order_status_id,$users_id,NOW(),NOW()) RETURNING id");
        //primera compra
        if($users_purchase_quantity==0){
            $users_purchase_quantity=1;
            enviarPaginaCorreo(4,$users_email);
        }
    }else{
        $sql="SELECT id FROM orders WHERE id=$orders_id AND total_pay<=((SELECT (SUM(amount)$sumar_sql) as amount FROM det_bank_orders dbo WHERE dbo.orders_id=$orders_id and (status='nuevo' OR status='aprobado' OR status='efectivo') GROUP BY dbo.orders_id))";
    
        $arr=q($sql);
        if(is_array($arr)){
            $order_status_id=2;
            $arr=q("INSERT INTO trackings (orders_id,orders_status_id,users_id,created_at,updated_at) VALUES ($orders_id,$order_status_id,$users_id,NOW(),NOW()) RETURNING id");
            //primera compra
            if($users_purchase_quantity==0){
                $users_purchase_quantity=1;
                enviarPaginaCorreo(4,$users_email);
            }
        }
    }
    q("COMMIT");
    if($pagoAbonado){

        enviarCorreo($users_email,'VOUCHER DE PAGO',formatear($xml->getVoucher()));
   }else{
        // salidaNueva(null,"Disculpe, intente de nuevo",false);
   } 












    exit();
}
function formatear($data){
    $data=str_replace("_", "", $data);
return "
<table border='0' cellspacing='0' width='100%''>
    <tr>
        <td></td>
        <td width='300' style=' font-family: \"Courier New\", Courier, monospace; padding:20px; border:1px solid #000; border-radius: 15px; border-style: dashed; width:300px; margin:0 auto; background:#F2F2F2'>
        <div >
<div style='text-align:center;background:#203876; color:white; margin-bottom:10px' >VOUCHER<BR>ELECTRÓNICO<BR></div>
Alimentos FM, C.A.<br>
RIF: J-31721968-6<br>
<br>
".nl2br($data)."<BR></div><hr><div style='text-align:center'><br>Para más información, visita la sección contáctanos de www.biomercados.com.ve<br><span style=''><b>¡INSPIRADOS EN SERVIR!</b><span></div>

        </td>
        <td></td>
     </tr>
</table> ";
}

function formatear_VIEJO($data){
    
    return "<div style='font-family: \"Courier New\", Courier, monospace; padding:20px; border:1px solid #000; border-radius: 15px; border-style: dashed; width:300px; margin:0 auto; background:#F2F2F2'>
    <div style='text-align:center;background:#203876; color:white'>VOUCHER<BR>ELECTRÓNICO<BR></div>
    Alimentos FM, C.A.<br>
    RIF: J-31721968-6<br>
    <br>
    ".nl2br($data)."<BR></div><div style='text-align:center'><br>Para más información, visita la sección contáctanos de www.biomercados.com.ve<br><span style=''><b>¡INSPIRADOS EN SERVIR!</b><span></div>";
    
    }

function enviarPaginaCorreo($id,$email){
    //3 bienvenido
    //4 primera compra
    $arr=q("SELECT * FROM pages WHERE id='$id'");
    if(is_array($arr)){
        $titulo=$arr[0]['titulo'];
        $body=$arr[0]['body'];
        enviarCorreo($email,$titulo,$body);
    }
}
function enviarCorreo($email,$titulo,$body){

    require __DIR__.'/../../vendor/autoload.php';
   // echo is_file(__DIR__.'/../vendor/autoload.php');


	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
	    $mail->isSMTP();                                            // Send using SMTP
	    $mail->Host       = 'mail.biomercados.com.ve';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'noreply@biomercados.com.ve';                     // SMTP username
	    $mail->Password   = 'Bio2020';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        
	    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
	    $mail->SMTPDebug = 0;
        $mail->CharSet = 'UTF-8';
	    //Recipients
	    $mail->setFrom('noreply@biomercados.com.ve', 'Biomercados - Bio en línea');
	    $mail->addAddress($email);
	    
	    $mail->isHTML(true);
	    $mail->Subject = $titulo;
	    $mail->Body    = $body;
	    
	    $mail->send();
	    return true;
	} catch (Exception $e) {
	    return false;
	}

}

function set_formato_moneda($value){
    $listo=null;
    $patróna = '/[\s]/';
    $patrón = '/[,\.]/';
    $va=preg_replace($patróna,"",trim($value));
    $va=preg_replace($patrón," ",$va);
    $arr=explode(" ",$va);
    $total=count($arr);
    if($total>1){
        $arr[$total-1]=".".$arr[$total-1];
        foreach($arr as $valor) $listo.=$valor;
    }else{

        $listo=$va;
    }
   
    return $listo;
}


    function extraer_datos_db(){
        $gestor = @fopen("../../.env", "r");
        if ($gestor) {
            while (($búfer = fgets($gestor, 4096)) !== false) {
                $arr[]=$búfer;
            }
            fclose($gestor);
        }
        $db['host']     =limpiar($arr[9]);
        $db['port']     =limpiar($arr[10]);
        $db['database'] =limpiar($arr[11]);
        $db['user']     =limpiar($arr[12]);
        $db['password'] =limpiar($arr[13]);
        return $db;
    }
    
    
    
    function limpiar($var){
        return trim(explode('=',$var)[1]);
    }
    function conectar_db($host,$base_dato,$usuario,$clave,$puerto){
        $dbconn = pg_connect("host=".$host." dbname=$base_dato user=$usuario password=$clave port=$puerto")
        or die('No se ha podido conectar: ' . pg_last_error());
        return $dbconn;
    }
    function q($sql){
        $arr=array();
       // $result = pg_query($sql) or die(false);
       $con=$GLOBALS["con"];
        if (pg_send_query($con,$sql)) {
            $res=pg_get_result($con);
            if ($res) {
              $state = pg_result_error_field($res, PGSQL_DIAG_SQLSTATE);
              if ($state==0) {
                while ($line = pg_fetch_array($res, null, PGSQL_ASSOC)) {
                    $arr[]=$line;
                }
                if(count($arr)){
                    return $arr;
                }else{
                    return true;
                }
              }
              else {
                  switch($state){
                      case 23505:
                        salida(null,"El registro ya existe, intente de nuevo.",false);
                      break;
                      case '22P02':
                        salida(null,"Ingrese todos los campos obligatorios.",false);
                        
                      break;
                      default:
                        exit($sql);
                  }
              }
            }  
          }
          salida('',"Disculpe, intente de nuevo",false);
    
    
    }
    
    
    
    
    
    
    
    
    
    
    
    
    function salida($row,$msj_general="",$bueno=true){
        $rowa['success']=$bueno;
        if(!$bueno) header('HTTP/1.1 409 Conflict');
        $rowa['msj_general']=$msj_general;
        $rowa['data']=$row;
        echo json_encode($rowa);
        exit();
    }
    
    
    
    function cabecera($error="Off"){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        header("Access-Control-Allow-Headers: content-type, authorization");
        //header('Content-type: text/html; charset=utf-8');
        ini_set('display_errors',$error);
        error_reporting(E_ALL ^E_NOTICE ^E_DEPRECATED);
        ini_set('max_execution_time', 155);
    }
    function run(){
        $postdata = file_get_contents("php://input");
        $input = json_decode($postdata);
        if($_GET['id_sesion']){
            session_id($_GET['id_sesion']);
        }
        return $input;
    }
    function seguro($varb){
        foreach($varb as $id=>$var){
            $_GET[$id]= pg_escape_string(htmlspecialchars(filter_var($var,FILTER_SANITIZE_STRING)));
        }
        return $_GET;
    }
    function segurob($var){
       return pg_escape_string(htmlspecialchars(filter_var($var,FILTER_SANITIZE_STRING)));
        
    }

?>
