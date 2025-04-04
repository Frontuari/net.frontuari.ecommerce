<?php
cabecera('On');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$a=extraer_datos_db();
$con=conectar_db($a['host'],$a['database'],$a['user'],$a['password'],$a['port']);
$datos=run();


   const OPENSSL_CIPHER_NAME = "aes-128-ecb";
    require_once("AesCipher.php");

    $_GET           =seguro($_GET);
    $nacionalidad   =$_GET['nacionalidad'];
    $cedula         =$_GET['cedula'];
    $customer_id    =$nacionalidad.$cedula;
    $card_number    =$_GET['card_number'];
    $amount         =$_GET['amount'];
    $nroFactura     =$_GET['nroFactura'];
    $account_type   =$_GET['account_type'];
    $expiration_date=$_GET['ano'].'/'.$_GET['mes'];
    $clave          =cifrar($_GET['clave']);
    $cvv            =cifrar($_GET['cvv']);
    $evento         =$_GET['evento'];

    switch($evento){
        case 'inicio':
            $_SESSION['amount']     =$amount;
            $_SESSION['nroFactura'] =$nroFactura;       

            $boton='<button type="submit" name="evento" value="solicitarClave" class="btn btn-success">Continuar</button>';
            include('vista.php');
        break;
        case 'solicitarClave':

            $res=autenticar($card_number,$customer_id);
            $obj=json_decode($res['data']);
           // print_r($obj);
           // exit();
            if($res['success']==true){

                $_SESSION['card_number']=$card_number;
                $_SESSION['customer_id']=$customer_id;
                $_SESSION['cedula']=$cedula;
                $_SESSION['nacionalidad']=$nacionalidad;
                $disabled=true;
                $obj=json_decode($res['data']);
                $tipo_auth=descifrar($obj->authentication_info->twofactor_type);

               // echo "Codigo de autentificación: ".$tipo_auth."<br><br>Procesando pago...<br>";
            
                switch($tipo_auth){
                    case 'clavetelefonica':
                        $titulo="Ingrese su clave telefónica";
                        $clave=$claveTelefonica;
                    break;
        
                    case 'claveinternet':
                        $titulo="Ingrese su clave de internet";
                        $clave=$claveInternet;
                    break;
        
                    case 'otp':
                        $titulo="Ingrese su clave OTP";
                        $clave=$claveOtp;
                    break;
                }
                $htmlPasoB='

                <div class="row">
                <div class="col-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Código CVV:</label>
                    <input autofocus value="" name="cvv" title="Nro. CVV que se encuentra en la parte trasera de su carrito" pattern="^\D*\d{3}$" type="text" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                </div>
                <div class="col-8">
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Fecha de expiración:</label><br>
                Mes: <select name="mes">
                    '.selectFecha(1,12).'
                    </select>
                Año: <select name="ano">
                        '.selectFecha(date('Y'),date('Y', strtotime('+20 years'))).'
                </select><br></div>
                </div>
              </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">Tipo de cuenta:</label>
                    <select name="account_type" required class="form-control">
                        <option value="CC">Corriente</option>
                        <option value="CA">Ahorros</option>
                    </select>
                </div>    
                
                <div class="form-group">
                    <label for="exampleInputEmail1">'.$titulo.':</label>
                    <input value="" name="clave" type="text" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>             


                ';
                $boton='<a href="?evento=inicio&amount='.$_SESSION['amount'].'&nroFactura='.$_SESSION['nroFactura'].'" class="btn btn-secondary">Regresar</a> ';
                $boton.='<button type="submit" name="evento" value="procesarPago" class="btn btn-success">Procesar pago</button>';
            }else{
                $htmlPasoB=$res['data'];
               
            }

                
            
            include('vista.php');
        break;
        case 'procesarPago':
           //echo salidaBuena(2332,218,20.44)."s";
            //exit();
           //exit($_SESSION['card_number']." ".$_SESSION['customer_id']." ".$_SESSION['nroFactura']." ".$account_type." ".$clave." ".$expiration_date." ".$cvv." ".$_SESSION['amount']);
           $res=procesarPago($_SESSION['card_number'],$_SESSION['customer_id'],$_SESSION['nroFactura'],$account_type,$clave,$expiration_date,$cvv,$_SESSION['amount']);
           //echo $res;
            //exit();
           if($res['success']==true){
                $boton='';
                $obj=json_decode($res['data']);

               // echo "A: ".$obj->status->error_code."<br>";
                if(isset($obj->status->error_code)){
                    if($obj->status->error_code>0){
                        $htmlFinal='<div style="text-align: center;">Transacción <b><span style="color:red">RECHAZADA</span></b><br>'.$obj->status->description.'</div>';
                    
                        $boton='<a href="?evento=inicio&amount='.$_SESSION['amount'].'&nroFactura='.$_SESSION['nroFactura'].'" class="btn btn-secondary">Intentar nuevamente</a> ';
                        $html_correo=voucherMalo($obj->status->error_code,substr($_SESSION['card_number'], 13),$_SESSION['nroFactura'],$obj->status->description);

                        $sql="SELECT u.email FROM orders o INNER JOIN users u ON u.id=o.users_id WHERE o.id='".$_SESSION['nroFactura']."'";
                        $arr=q($sql);
                        if(is_array($arr)){
                            $users_email=$arr[0]['email'];
                            enviarCorreo($users_email,'Voucher de pago',$html_correo);
                        }                    
                    }

                }else{
                    if(isset($obj->error_list[0]->error_code) and $obj->error_list[0]->error_code!='0000'){
                        $htmlFinal='<div style="text-align: center;">Transacción <b><span style="color:red">RECHAZADA</span></b><br> '.$obj->error_list[0]->description.'</div>';
                        
                        $boton='<a href="?evento=inicio&amount='.$_SESSION['amount'].'&nroFactura='.$_SESSION['nroFactura'].'" class="btn btn-secondary">Intentar nuevamente</a> ';
                        $html_correo=voucherMalo($obj->error_list[0]->error_code,substr($_SESSION['card_number'], 13),$_SESSION['nroFactura'],$obj->error_list[0]->description);


                        $sql="SELECT u.id,u.purchase_quantity,u.email FROM orders o INNER JOIN users u ON u.id=o.users_id WHERE o.id='".$_SESSION['nroFactura']."'";
                        $arr=q($sql);
                        if(is_array($arr)){
                        $users_email=$arr[0]['email'];
                        enviarCorreo($users_email,'Voucher de pago',$html_correo);
                        }





                        
                    }elseif(isset($obj->transaction_response)){

                    // $htmlFinal=$obj->transaction_response->trx_status;
                    $htmlFinal=salidaBuena($obj->transaction_response->payment_reference,$obj->transaction_response->invoice_number,$obj->transaction_response->amount);
                    //$htmlFinal=salidaBuena(2332,218,20.44);
                    $_SESSION['amount']=null;
                    $_SESSION['nroFactura']=null;
                    }else{
                        $htmlFinal="<div style='text-align: center;'>Disculpe, intente mas tarde.</div>";
                        $boton='<a href="?evento=inicio&amount='.$_SESSION['amount'].'&nroFactura='.$_SESSION['nroFactura'].'" class="btn btn-secondary">Intentar nuevamente</a> ';
                    }
                }
                //$boton.='<button type="submit" onclick="window.close()" class="btn btn-success">Salir</button>';
        
            }else{
                $htmlFinal=$res['data'];
                $boton='<a href="?evento=inicio&amount='.$_SESSION['amount'].'&nroFactura='.$_SESSION['nroFactura'].'" class="btn btn-secondary">Intente nuevamente</a> ';
                //$boton.='<button type="submit" onclick="window.close()" class="btn btn-success">Salir</button>';
            }
            include('vista.php');
        break;


    }
exit();
function selectFecha($inicio,$fin){
    $option='';
  
    while($inicio<=$fin){
        
        $option.='<option>'.str_pad($inicio, 2, "0", STR_PAD_LEFT).'</option>';
        $inicio++;
    }
   return $option;
    
}


function autenticar($card_number,$customer_id){
    $body='
    {
        "merchant_identify": {
            "integratorId": 31,
            "merchantId": 220003,
            "terminalId": "abcde"
        },
        "client_identify": {
            "ipaddress": "10.0.0.1",
            "browser_agent": "Chrome 18.1.3",
            "mobile": {
                "manufacturer": "Samsung",
                "model": "S9",
                "os_version": "Oreo 9.1",
                "location": {
                    "lat": 37.4224764,
                    "lng": -122.0842499
                }
            }
        },
        "transaction_authInfo" : {
            "trx_type": "solaut",
            "payment_method": "tdd",
            "card_number": "'.$card_number.'",
            "customer_id": "'.$customer_id.'"
        }
    }
    ';
    #$res= send_url('https://apimbu.mercantilbanco.com:9443/mercantil-banco/desarrollo/v1/payment/getauth',$body);
    $res= send_url('https://apimbu.mercantilbanco.com/mercantil-banco/prod/v1/payment/getauth',$body);
    return $res;

}

function procesarPago($card_number,$customer_id,$nroFactura,$account_type,$clave,$expiration_date,$cvv,$amount){
$body='
{
	"merchant_identify": {
		"integratorId": 31,
		"merchantId": 220003,
		"terminalId": "abcde"
	},
	"client_identify": {
		"ipaddress": "10.0.0.1",
		"browser_agent": "Chrome 18.1.3", 
		"mobile": {
			"manufacturer": "Samsung"
		}
	},
	"transaction": {
		"trx_type": "compra",
		"payment_method": "tdd",
		"card_number": "'.$card_number.'",
		"customer_id": "'.$customer_id.'",
		"invoice_number": "'.$nroFactura.'",
		"account_type":"'.$account_type.'",
		"twofactor_auth":"'.$clave.'",
		"expiration_date": "'.$expiration_date.'",
		"cvv": "'.$cvv.'",
		"currency": "ves",
		"amount": '.$amount.'
	}
}';


//echo $body;
//exit();

#$res= send_url('https://apimbu.mercantilbanco.com:9443/mercantil-banco/desarrollo/v1/payment/pay',$body);
$res= send_url('https://apimbu.mercantilbanco.com/mercantil-banco/prod/v1/payment/pay',$body);

return $res;


}

















function send_url($url,$body){
	
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'X-IBM-Client-Id: af60d48c-427f-4db1-b5a3-e726f342dab4'
        //'Environment: test',
        //'ApiKey:mbu1'
    ));
    $server_output = curl_exec($ch);
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }
    curl_close($ch);
    
    if (isset($error_msg)) {
        $res['success']=false;
        $res['data']=$error_msg;
        return $res;
    }else{
        
            $res['success']=true;
            $res['data']=$server_output;
            return $res;
    }
    
    //if ($server_output == "OK") {return true;} else {return false;}
}


function cifrar($dato){

# CVV a Encripta
$cvv  = mb_convert_encoding($dato, "UTF-8");

# Clave secreta enviada por el Banco
$keybank = mb_convert_encoding("A10222430541120200617AA30", "UTF-8");

# Generacion del hash a partir de la clave secreta del banco
$keyhash = AesCipher::createKeyhash($keybank);

# Encripta el CVV
$cvvencrypt = AesCipher::encrypt($keyhash,$cvv);

# Des-Encripta
$decrypted = AesCipher::decrypt($keyhash,$cvvencrypt);

return $cvvencrypt;

}
function descifrar($dato){


    # Clave secreta enviada por el Banco
    $keybank = mb_convert_encoding("A10222430541120200617AA30", "UTF-8");
    
    # Generacion del hash a partir de la clave secreta del banco
    $keyhash = AesCipher::createKeyhash($keybank);
 
    # Des-Encripta
    $decrypted = AesCipher::decrypt($keyhash,$dato);
    
    return $decrypted;
    
}


function seguro($varb){
    if(isset($varb)){
        foreach($varb as $id=>$var){
            $_GET[$id]= pg_escape_string(htmlspecialchars(filter_var(trim($var),FILTER_SANITIZE_STRING)));
        }
    }
    return $_GET;
}


function salidaMala($xml){
    echo '
    <div style="text-align: center; "><img src="../logo.png" width="200" /></div>
<p>&nbsp;</p>
<div style="text-align: center;">Transacción <b><span style="color:red">RECHAZADA</span></b><br> <b>Cod. '.$xml->getCodigo().' '.$xml->getDescripcion().'</b><br><br> <a href="http://199.188.204.152/mega/PreRegistro.php?nro_orden='.$xml->getFactura().'&total='.$xml->getMonto().'">haga clic aquí para intentar nuevamente.</a><br /><br /><hr />https://eosdelivery.com.ar/</div>     
    ';

/*
    $orders_id=$xml->getFactura();
    $sql="SELECT u.id,u.purchase_quantity,u.email FROM orders o INNER JOIN users u ON u.id=o.users_id WHERE o.id='$orders_id'";
    $arr=q($sql);
    if(is_array($arr)){
     $users_email=$arr[0]['email'];
    }
    enviarCorreo($users_email,'VOUCHER DE PAGO RECHAZADO',formatear($xml->getVoucher()));
    exit();
    */
}
function salidaBuena($ref,$nroFactura,$amount){


 
    //$amount=set_formato_moneda($xml->getMonto());
   // exit("monto: ".$amount." origen: ".$xml->getMonto()." otros ".$xml->getVoucher());
    $orders_id=$nroFactura;
    $bank_datas_id=6;
   // $ref=$ref;
    $description="TDD mercantil ";
    $coins_id=2;
    $status='aprobado';

    //PARA ARREGLAR PROBLEMA DE DIFERENCIAS EN DECIMALES CAMBIARIAS
    $diferencia_aceptable=0;
    $sumar_sql='';
    /*
    if($coins_id==1){ //dolares
        $diferencia_aceptable=convertir_a_bs($coins_id,0.01);
        $sumar_sql="+$diferencia_aceptable";
       
    }

    */
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

        //enviarCorreo($users_email,'VOUCHER DE PAGO',formatear($xml->getVoucher()));
   }else{
        // salidaNueva(null,"Disculpe, intente de nuevo",false);
   } 
   $html_voucher=voucher('APROBADO',substr($_SESSION['card_number'], 13),$nroFactura,$ref);
   enviarCorreo($users_email,'Voucher de pago',$html_voucher);
   return '
   <div style="text-align: center;">Transacción <b><span style="color:green">APROBADA</span></b><br />
   
   Orden Nro. '.$nroFactura.'<br>
   Referencia. '.$ref.'<br>
   <br /><hr /></div>     
       ';

}

function voucherMalo($codigo,$nroTarjeta,$nroOrden,$detalles){
    $fecha=date('d/m/Y h:i:s A');
    return "
    <table cellspacing='0' width='100%''>
    <tr>
        <td></td>
        <td width='300' style=' font-family: \"Courier New\", Courier, monospace; padding:20px; border:1px solid #000; border-radius: 15px; border-style: dashed; width:300px; margin:0 auto; background:#F2F2F2'>
        <div >
<div style='text-align:center;background:#203876; color:white; margin-bottom:10px' >VOUCHER<BR>ELECTRÓNICO<BR></div>
Alimentos FM, C.A.<br>
RIF: J-31721968-6<br>
<br>
<div style='text-align:center'>BANCO MERCANTIL</div>
<br>
Fecha: $fecha
<br>
Transacción:<b><span style='color:red'> RECHAZADA</span></b>
<BR>
Tipo: Tarjeta de Débito Mercantil
<br>
Nro. XXXXXXXXXXXXX$nroTarjeta
<br>

Orden Nro. $nroOrden
<br>
Detalles: $detalles
<br>
Código del error: $codigo
<br>


</div><hr><div style='text-align:center'><br>Para más información, visita la sección contáctanos de https://eosdelivery.com.ar/<br><span style=''><b>¡INSPIRADOS EN SERVIR!</b><span></div>

        </td>
        <td></td>
     </tr>
</table>";
}
function voucher($status,$nroTarjeta,$nroOrden,$nroReferencia){
    $fecha=date('d/m/Y h:i:s A');
    return "
    <table cellspacing='0' width='100%''>
    <tr>
        <td></td>
        <td width='300' style=' font-family: \"Courier New\", Courier, monospace; padding:20px; border:1px solid #000; border-radius: 15px; border-style: dashed; width:300px; margin:0 auto; background:#F2F2F2'>
        <div >
<div style='text-align:center;background:#203876; color:white; margin-bottom:10px' >VOUCHER<BR>ELECTRÓNICO<BR></div>
Alimentos FM, C.A.<br>
RIF: J-31721968-6<br>
<br>
<div style='text-align:center'>BANCO MERCANTIL</div>
<br>
Fecha: $fecha
<br>
Transacción:<b><span style='color:green'> APROBADA</span></b>
<BR>
Tipo: Tarjeta de Débito Mercantil
<br>
Nro. XXXXXXXXXXXXX$nroTarjeta
<br>

Orden Nro. $nroOrden
<br>
Nro. de Referencia: $nroReferencia
<br>


</div><hr><div style='text-align:center'><br>Para más información, visita la sección contáctanos de https://eosdelivery.com.ar/<br><span style=''><b>¡INSPIRADOS EN SERVIR!</b><span></div>

        </td>
        <td></td>
     </tr>
</table>";
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
function formato_numero($numero){
	return number_format($numero, 2, ",", ".");
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
    function salida($row,$msj_general="",$bueno=true){
        $rowa['success']=$bueno;
        if(!$bueno) header('HTTP/1.1 409 Conflict');
        $rowa['msj_general']=$msj_general;
        $rowa['data']=$row;
        echo json_encode($rowa);
        exit();
    }
    function enviarCorreo($email,$titulo,$body){

        require __DIR__.'/../../vendor/autoload.php';
       // echo is_file(__DIR__.'/../vendor/autoload.php');
    
    
        $mail = new PHPMailer(true);
        $mail_data=q("SELECT * FROM ad_service_email");
        $m_username = $mail_data[0]['email_sender'];
        $m_pass = $mail_data[0]['password'];

        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $m_username;
            $mail->Password   = $m_pass; // !!! COLOCAR LA CONTRASEÑA AQUÍ
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->SMTPDebug = 0;
            $mail->CharSet = 'UTF-8';
            //Recipients
            $mail->setFrom($m_username, 'EOS Delivery');
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
?>