<?php
cabecera('On');

use App\Http\Resources\Favorite;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use App\AdServiceEmail;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


$a=extraer_datos_db();
$con=conectar_db($a['host'],$a['database'],$a['user'],$a['password'],$a['port']);
$datos=run();
session_start();
date_default_timezone_set('America/Manaus');
$json = isset($_GET['json']) ? $_GET['json'] : null;
$_GET=seguro($_GET);
$_POST=seguro($_POST);

//best_sql_listarFavoritos(true);
if($_GET['evento']=='' && $_POST['evento']!=''){
    $evento=$_POST['evento'];
}else{
    $evento=$_GET['evento'];
}
switch($evento) {
    case 'contactweb':

        $message = array("name"=>$_POST['name'],"email"=>$_POST['email'],"message"=>$_POST['message']);
        // SE VA A ENVIAR EL CORREO A LA COMPAñIA
        enviarCorreo("hectopiarsinr@gmail.com",$_POST['subject'],plantillaContacto($message));
        break;
    case 'web_no_login':
        $row['data']['listarPublicidadToda']=listarPublicidadToda(true);
        $row['data']['productosb']=reformularIdProductosCompleto(listarProductosWeb());
        $row['data']['productos']=listarProductosWeb();
        $row['data']['listar_categorias_movil']=listar_categorias_movil(true);
        $row['data']['cities']=getCitiesAll(true);
        $row['data']['regions']=getRegionsAll(true);
        $row['data']['states']=getStates(true);
        $row['data']['payment_methods']=listarMetodoDePago(true);
        $row['data']['envio']=recargoEnvio(true);
        $row['data']['bank_datas']=listarBancosdelMetododePagoAll(true);
        $row['data']['listarCombos']=listarCombos(true);
        //$row['data']['pro_ia']=listarProductosIA(true,true); LOGIN
        $row['success']=true;
        $row['msj_general']=true;
        echo e($row);
    break;
    case 'login':
        $row['data']['usuario']=loginMovil(true);
        if($row['data']['usuario']['success']==true){
            $row['data']['perfil']=getPerfil(true);
            $row['data']['address']=getAdreess(true);   
            $row['data']['addressHabitacion']=getAdreess(true,'habitacion');   
            $row['data']['favoritos']=best_sql_listarFavoritos(true);
            $row['data']['productos_mayor']=productosMayorEdad(true);
            $row['success']=true;
            $row['msj_general']="Bienvenido";
            echo e($row);
        }else{
                echo e($row['data']['usuario']);
        }

    break;
    case 'prueba':
        $row['data']['citiesAll']=getCitiesAll(true,true);
        
        
    break;
    case 'theBest':
        $row['data']['usuario']=loginMovil(true);
        if($row['data']['usuario']['success']==true){
            $row['data']['perfil']=getPerfil(true);
            $row['data']['categories']=listar_categorias_movil(true);
            $row['data']['cities']=getCitiesAll(true);
            $row['data']['regions']=getRegionsAll(true);
            $row['data']['states']=getStates(true);
            $row['data']['address']=getAdreess(true);   
            $row['data']['addressHabitacion']=getAdreess(true,'habitacion'); 
            $row['data']['citiesAll']=getCitiesAll(true,true);
            $row['data']['regionsAll']=getRegionsAll(true,true);
            $row['data']['statesAll']=getStates(true,true);
            $row['data']['payment_methods']=listarMetodoDePago(true);
            $row['data']['envio']=recargoEnvio(true);
            $row['data']['bank_datas']=listarBancosdelMetododePagoAll(true);
            $row['data']['favoritos']=best_sql_listarFavoritos(true);
            $row['data']['productos_mayor']=productosMayorEdad(true);
            $row['success']=true;
            $row['msj_general']="Bienvenido";

           if($_GET['web']==1){
            echo e($row);
           }else{
            echo d($row);
           }
        }else{
            if($_GET['web']==1){
                echo e($row['data']['usuario']);
               }else{
                echo json_encode($row['data']['usuario']);
               }
            
        }
    break;
    case 'verificarSesion':
        if($_SESSION['sesion_iniciada']==false or !isset($_SESSION['sesion_iniciada'])){
            salidaNueva(null,'',true);
        }
    break;
    case 'obtenerTodo':
        obtenerTodo();
    break;
    case 'verifyPassword':
        verifyPassword();
    break;
    case 'changePassword':
        changePassword();
    break;
    case 'obtenerDireccion':
        obtenerDireccion();
    break;
    case 'login':
        login();
    break;
    case 'loginMovil':
        loginMovil(false);
    break;
    case 'actualizarFotoPerfil':
        actualizarFotoPerfil();
    break;
    case 'listar_categorias_movil':
        listar_categorias_movil(false);
    break;
    case 'registrarUsuario':
        registrarUsuario();
    break;
    case 'confirmarCorreo':
        confirmarCorreo();
    break;
    case 'enviarCodRecuperacion':
        enviarCodRecuperacion();
    break;
    case 'confirmarCodRecuperacion':
        confirmarCodRecuperacion();
    break;
    case 'cambiarClavePublico':
        cambiarClavePublico();
    break;
    case 'logout':
        logout();
    break;
    case 'cambiarClave':
        echo cambiarClave();
    break;
    case 'getCities':
        echo getCities(false);
    break;
    case 'getRegions':
        echo getRegions(false);
    break;
    case 'getStates':
        echo getStates(false);
    break;
    case 'guardarDireccionHabitacion':
        echo guardarDireccion('habitacion');
    break;
    case 'guardarDireccion':
        echo guardarDireccion();
    break;
    case 'getAdreess':
        echo getAdreess(false);
    break;
    case 'eliminarDireccion':
        echo eliminarDireccion();
    break;
    case 'listarFavoritos':
       listarFavoritos();
    break;
    case 'listarProductosAll':
        listarProductosAll();
        break;
        case 'listarProductosArray':
            listarProductosArray();
            break;
    case 'saldo':
        saldo();
    break;
    case 'listarProductosFiltrados':
        listarProductosFiltrados();
    break;
    case 'listarProductosPorCategoria':
        listarProductosPorCategoria();
    break;
    case 'mayorDeEdad':
        mayorDeEdad(false);
    break;
    case 'getPage':
        getPage();
    break;
    case 'listarProductos':
        $sql=getSqlListarProductos();
        $sql=filtroProductos($sql);
        listarProductos($sql);
    break;
    case 'guardarFavorito':
        guardarFavorito();
    break;
    case 'consultarFavorito':
        consultarFavorito();
    break;
    case 'listarProductosIA':
        listarProductosIA();
    break;
    case 'guardarCalificacion':
        guardarCalificacion();
    break;
    case 'guardarOpinion':
        guardarOpinion();
    break;
    case 'listarCombos':
        listarCombos(false);
    break;
    case 'guardarOpinionOrden':
        guardarOpinionOrden();
    break;
    case 'guardarVisitaProducto':
        guardarVisitaProducto();
    break;
    case 'buscarProducto':
        buscarProducto();
    break;
    case 'listarProductosPorBusqueda':
        listarProductosPorBusqueda(true);
    break;
    case 'listarProductosPorBusquedaAlvarado':
        listarProductosPorBusqueda(false);
    break;
    case 'listarProductosCarrito':
        listarProductosCarrito($json);
    break;
    case 'listarMetodosDePago':
        listarMetodoDePago(false);
    break;
    case 'listarOrdenes':
        listarOrdenes();
    break;
    case 'crearOrden':
        crearOrden($json);
    break;
    case 'consultarOrden':
        consultarOrden();
    break;
    case 'recargoEnvio':
        recargoEnvio(false);
    break;
    case 'horasDisponiblesEntrega':
        horasDisponiblesEntrega();
    break;
    case 'listarTracking':
        listarTracking();
    break;
    case 'enviar_correo_masivo':
        $texto=pg_escape_string(base64_decode($_POST['texto']));
        q("INSERT INTO servicios (text,tipo) VALUES ('$texto','correo_masivo')");
        q("UPDATE subscriptions SET enviado=0");
        horasDisponiblesEntrega();

    break;
    case 'ultimo_correo_masivo':
        $a=q("SELECT * FROM servicios ORDER BY id DESC LIMIT 1");
        if(is_array($a)){
            salidaNueva($a,"datos del ultimo correo",true);
        }else{
            salidaNueva(null,"Sin datos",false);
        }
    break;
    case 'getPerfil':
        getPerfil(false);
    break;
    case 'actualizarPerfil':
        actualizarPerfil();
        
    break;
    case 'totalPagar':
        totalPagar();
    break;
    case 'cancelarOrden':
        cancelarOrden();
    break;
    case 'guardarPago':
        guardarPago();
    break;
    case 'listarBancosdelMetododePago':
        listarBancosdelMetododePago(false);
    break;
    case 'listarPublicidad':
        listarPublicidad(false);
    break;
    case 'devolucion':
        $email=$_SESSION['usuario']['email'];
        $name=$_SESSION['usuario']['name'];
        $phone=$_SESSION['usuario']['phone'];
        $orders_id=$_GET['orders_id']; //EL NRO DE ORDEN NO FUNCIONA AGREGAR EN UN FUTURO
        enviarCorreo('hectopiarsinr@gmail.com',"Solicitud de Devolución","El cliente $email, $name, $phone esta solicitando una devolución.");
        salidaNueva(null,"Su solicitud ha sido procesada. Nos comunicaremos con usted.");
    break;
    case 'reporte_ingresos':
        $fecha_inicio=$_GET['fecha_inicio'];
        $fecha_fin=$_GET['fecha_fin'];
        //exit("SELECT SUM(amount),created_at::date FECHA FROM det_bank_orders  where created_at between '$fecha_inicio' and '$fecha_fin' GROUP BY created_at ORDER BY created_at");
        $arr=q("SELECT SUM(amount) ingreso,fecha FROM (SELECT amount,created_at::date AS fecha   FROM det_bank_orders where (created_at between '$fecha_inicio' and '$fecha_fin') AND (status='aprobado')) t GROUP BY fecha ORDER BY fecha");   

    break;
    case 'callName':
        callName();
    default:
    
    salidaNueva(null,"Intente de nuevo.",false);
    // salida($row,"Disculpe debe enviar un evento".$_POST['evento']."-".$_GET['evento'],false);
}


function actualizarFotoPerfil(){
    $users_id=$_SESSION['usuario']['id'];
    //wh_log("CARGANDO IMAGEN");
    //wh_log(print_r($_POST,true));
    $image = $_POST['image'];
    $name = md5($users_id.rand(0,9999999)).".png";
    $avatar='users/'.$name;
    q("UPDATE users SET avatar='$avatar' WHERE id=$users_id");
    $realImage = base64_decode($image);

    if($_GET["from"]=="web"){
        file_put_contents($avatar, file_get_contents($image));
        obtenerTodo();
    }else{
        file_put_contents($avatar, $realImage);
        getPerfil(false);
    }
    //salidaNueva($data['data'],"Perfil actualizado correctamente");
}
function listarProductosWeb(){
    $sql=getSqlListarProductos('','','','',false);
    $sql=filtroProductos($sql);
    return listarProductos($sql,false,true,false);
}
function listarPublicidadToda($tipo_salida){
    $arr=q("select image,type from advs");
    if(is_array($arr)){
     return salidaNueva($arr,'Listar publicidad',true,$tipo_salida);
    }else{
     return salidaNueva(null,'No tiene publicidad',false,$tipo_salida);
    }
}
function listarPublicidad($tipo_salida){
    $tipo=$_GET['tipo'];
    $arr=q("select image from advs where type='$tipo' AND status='A'");
    if(is_array($arr)){
     return salidaNueva($arr,'Listar publicidad',true,$tipo_salida);
    }else{
     return salidaNueva(null,'No tiene publicidad',false,$tipo_salida);
    }
}
function listarCombos($tipo_salida=false){
    $sql="SELECT todo.*,todo.total_precio/rate.rate as total_precio_dolar FROM (SELECT json_agg(
        json_build_object(
			'products_id',p.id,
    'name', initcap(p.name),
    'price',(p.price*coalesce(t.value,0.00)*0.01)+p.price,
    'cant',dpp.cant,
    'stock',p.qty_avaliable
) 
) json,pa.name as name,pa.id,pa.type,pa.image,SUM(((p.price*coalesce(t.value,0.00)*0.01)+p.price)*dpp.cant) total_precio FROM packages pa INNER JOIN det_product_packages dpp ON dpp.packages_id=pa.id INNER JOIN products p ON p.id=dpp.products_id LEFT JOIN det_product_taxes dpt ON dpt.products_id=p.id LEFT JOIN taxes t ON t.id=dpt.taxes_id  WHERE pa.status='A' AND p.qty_avaliable>0 AND p.status='A' GROUP BY pa.id) todo, (SELECT * FROM coins c WHERE c.id=1) rate ORDER BY type ASC";
    $arr=q($sql);
    if(is_array($arr)){
        $arr=recortar_imagen_combo($arr);
        return salidaNueva($arr,'Listado combos',true,$tipo_salida);
    }else{
        return salidaNueva(null,'No encontramos Compras fáciles',false,$tipo_salida);
    }
}

function callName() {
    $client_id = q("SELECT * FROM ad_client_id");
   
    if (is_array($client_id)) {
        header('Content-Type: application/json');
        echo json_encode($client_id);
        //? exit;
    }
}

function best_sql_listarFavoritos($tipo_salida){
    $users_id=$_SESSION['usuario']['id'];
   $arr=q("SELECT products_id FROM favorites f WHERE f.users_id='$users_id'");
   if(is_array($arr)){
    $arrb=reformularId($arr);
    return salidaNueva($arrb,'Favoritos',true,$tipo_salida);
   }else{
    return salidaNueva(null,'No tiene favoritos',false,$tipo_salida);
   }

}
function reformularId($arr){
    foreach($arr as $obj){
        $row[$obj['products_id']]=true;
    }
    return $row;
}
function reformularIdProductos($arr){
    foreach($arr['data'] as $obj){
        $row[$obj['id']]=1;
    }
    return $row;
}
function reformularIdProductosCompleto($arr){
    foreach($arr['data'] as $obj){
        $row[$obj['id']]=$obj;
    }
    return $row;
}
function best_sql_perfil(){
    $users_id=$_SESSION['usuario']['id'];
    return "SELECT date_part('year',age(p.birthdate)) as edad,users.email, split_part(p.rif, '-', 1) as nacionalidad,split_part(p.rif, '-', 2) as nro_rif,p.rif,p.sex,p.name,p.birthdate FROM users INNER JOIN peoples p ON p.id=users.peoples_id
    WHERE users.id='$users_id'";
}
function best_sql_ListarProductos($tipo_salida){
    $users_id=$_SESSION['usuario']['id'];
    $sql="SELECT json_agg(
        json_build_object(
    's', sc.id,
    'c',c.id,
    'm',c.adulto
) 
) json_subcategories,
json_agg(
json_build_object('f',f.id)) as json_favorite,p.description_short,p.qty_avaliable,p.qty_max,coalesce(SUM(t.value),0.000000) total_impuesto,coalesce(((p.price*SUM(t.value)/100)+p.price),p.price) total_precio, p.name,p.photo as image, p.id, p.price,(SELECT rating FROM rating_products WHERE users_id='$users_id' AND products_id=p.id) as calificado_por_mi, ROUND(p.user_rating) as rating,coalesce(((p.price*SUM(t.value)/100)+p.price),p.price)/(SELECT rate FROM coins WHERE id=1) as total_precio_dolar FROM products p LEFT JOIN favorites f ON (p.id=f.products_id AND f.users_id='$users_id') INNER JOIN det_sub_categories dsc ON p.id=dsc.products_id INNER JOIN sub_categories sc ON sc.id=dsc.sub_categories_id INNER JOIN categories c ON c.id=sc.categories_id LEFT JOIN det_product_taxes dpt ON dpt.products_id=p.id  LEFT JOIN taxes t ON t.id=dpt.taxes_id and t.status='A' WHERE (p.status='A' AND p.qty_avaliable>0) GROUP BY p.id";
    $arr=q($sql);
    if(is_array($arr)){
        return salidaNueva($arr,'Productos',true,$tipo_salida);
    }else{
        return salidaNueva(null,'No encontramos productos',false,$tipo_salida);
    }
}
function d($row){
    return gzcompress(json_encode($row), 9);
}

function e($row){
    return base64_encode(gzcompress(rawurlencode(json_encode($row)),9));
}

function obtenerTodo(){
    // Configuración de la conexión a la base de datos (reemplaza con tus propios valores)
    $dsn = 'pgsql:host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');


     $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        // Establecer conexión PDO
        $pdo = new PDO($dsn, $username, $password, $options);

        // Consulta para obtener los datos del usuario
        $query_usuario = "SELECT p.rif, s.avatar as avatar, split_part(p.rif, '-', 1) as nacionalidad, split_part(p.rif, '-', 2) as nro_rif, s.id, s.email, p.name, s.peoples_id, p.sex, p.birthdate, c.id as city_id, c.name as ciudad, p.phone, p.phone_home
            FROM users s
            INNER JOIN peoples p ON p.id = s.peoples_id
            INNER JOIN cities c ON c.id = p.cities_id
            WHERE s.email = :email";

        // Preparar y ejecutar la consulta de usuario
        $stmt_usuario = $pdo->prepare($query_usuario);
        $stmt_usuario->execute(['email' => $_SESSION['usuario']['email']]);
        $row_usuario = $stmt_usuario->fetch();

        // Consulta para obtener las direcciones habituales
        $query_habDirection = "SELECT o.*, c.id as city_id, c.name as parroquia, re.id as region_id, re.name as municipio, st.id as state_id, st.name as estado
            FROM order_address as o
            INNER JOIN cities c ON c.id = o.cities_id 
            INNER JOIN regions re ON re.id = c.regions_id 
            INNER JOIN states st ON st.id = re.states_id
            WHERE o.users_id = :user_id AND o.status = 'A' AND o.type <> 'delivery'";

        // Preparar y ejecutar la consulta de direcciones habituales
        $stmt_habDirection = $pdo->prepare($query_habDirection);
        $stmt_habDirection->execute(['user_id' => $_SESSION['usuario']['id']]);
        $habDirection = $stmt_habDirection->fetchAll();

        // Consulta para obtener las direcciones de entrega
        $query_direccions = "SELECT o.*, c.id as city_id, c.name as parroquia, re.id as region_id, re.name as municipio, st.id as state_id, st.name as estado
            FROM order_address as o
            INNER JOIN cities c ON c.id = o.cities_id
            INNER JOIN regions re ON re.id = c.regions_id 
            INNER JOIN states st ON st.id = re.states_id
            WHERE o.users_id = :user_id AND o.status = 'A' AND o.type = 'delivery'";

        // Preparar y ejecutar la consulta de direcciones de entrega
        $stmt_direccions = $pdo->prepare($query_direccions);
        $stmt_direccions->execute(['user_id' => $_SESSION['usuario']['id']]);
        $row_direccions = $stmt_direccions->fetchAll();

        // Asignar los resultados a las variables de sesión
        $_SESSION["usuario"] = $row_usuario;
        $_SESSION["usuario"]["directions"] = $row_direccions;
        $_SESSION["usuario"]["habDirection"] = $habDirection;

        salida($_SESSION["usuario"], "Datos actualizados", true);
    } catch (PDOException $e) {
         salida(null, "Error al conectar a la base de datos: " . $e->getMessage(), false);
    }
}

function verifyPassword(){
    $dsn = 'pgsql:host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');

     $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        // Establecer conexión PDO
        $pdo = new PDO($dsn, $username, $password, $options);

        // Consulta para obtener los datos del usuario
        $query = "SELECT password FROM users WHERE email = :email";

        // Preparar y ejecutar la consulta de usuario
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $_SESSION['usuario']['email']]);
        $user = $stmt->fetch();
        
        if ($user) {
            // Verifica que la contraseña actual sea igual a la registrada
            if (password_verify(trim($_POST['password']), trim($user['password']))) {
                echo json_encode(['isValid' => true]);
            } 
            else {
                echo json_encode(['isValid' => false]);
            }
        } 
        else {
            echo json_encode(['isValid' => false]);
        }
    } 
    catch (PDOException $e) {
        echo json_encode(['error' => 'Error al conectar a la base de datos: ' . $e->getMessage()]);  
    }
}

function changePassword(){
    $dsn = 'pgsql:host=' . env('DB_HOST') . ';port=' . env('DB_PORT') . ';dbname=' . env('DB_DATABASE');
    $username = env('DB_USERNAME');
    $password = env('DB_PASSWORD');

     $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Establecer conexión PDO
    $pdo = new PDO($dsn, $username, $password, $options);

    //Obtener datos del formulario
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

    // Preparar la consulta
    $query = "UPDATE users SET password = :password WHERE email = :email";
    $stmt = $pdo->prepare($query);

    // Ejecutar la consulta con los parámetros
    if ($stmt->execute([':password' => $password, ':email' => $email])) {
        salida(null, "BIEN", true);
    } 
    else{
        salida(null, "MAL", false);
    }
}


function obtenerDireccion(){
    $row = q("SELECT o.*,c.id as city_id,c.name as parroquia,re.id as region_id,re.name as municipio,st.id as state_id,st.name as estado
        FROM order_address as o
        INNER JOIN cities c on c.id = o.cities_id
        INNER JOIN regions re ON re.id=c.regions_id 
        INNER JOIN states st ON st.id=re.states_id
        WHERE o.users_id = ".$_SESSION['usuario']['id']." and o.status = 'A' and o.type = 'delivery'
    ");
    $_SESSION["usuario"]["directions"] = $row;
    salida($row,"Direcciones actualizadas",true);
}

function login(){
    $email=strtolower($_GET['email']);
    $clave=$_GET['password'];
    
    $row=q("SELECT p.rif,s.avatar as avatar ,split_part(p.rif, '-', 1) as nacionalidad,split_part(p.rif, '-', 2) as nro_rif, s.id,s.password,s.email,p.name,s.peoples_id,p.sex,p.birthdate,c.id as city_id,p.phone,p.phone_home,p.saldo
    FROM users s
    INNER JOIN peoples p on p.id = s.peoples_id
    INNER JOIN cities c on c.id = p.cities_id
    WHERE s.email='$email'")[0];

    $habDirection=q("SELECT o.*,c.id as city_id,c.name as parroquia,re.id as region_id,re.name as municipio,st.id as state_id,st.name as estado
        FROM order_address as o
        INNER JOIN cities c ON c.id=o.cities_id 
        INNER JOIN regions re ON re.id=c.regions_id 
        INNER JOIN states st ON st.id=re.states_id
        WHERE o.users_id = ".$row['id']." and o.status = 'A' and o.type <> 'delivery'
    ");

    $directions=q("SELECT o.*,c.id as city_id,c.name as parroquia,re.id as region_id,re.name as municipio,st.id as state_id,st.name as estado
    FROM order_address as o
        INNER JOIN cities c ON c.id=o.cities_id 
        INNER JOIN regions re ON re.id=c.regions_id 
        INNER JOIN states st ON st.id=re.states_id
        WHERE o.users_id = ".$row['id']." and o.status = 'A' and o.type = 'delivery'
    ");

   if($row['email']){
        if(password_verify($clave,$row['password'])){
            unset($row["password"]);
            $_SESSION["usuario"]=$row;
            $_SESSION["usuario"]["habDirection"]=$habDirection;
            $_SESSION["usuario"]["directions"]=$directions;
            $row['id_sesion']=session_id();
            salida($row,"Bienvenido",true);
        }else{
            $row=null;
            salida($row,"Contraseña no válida",false);
        }
   }else{
    salida($row,"Correo electrónico no valido",false);
}

}

function logout(){
    session_destroy();
    salida(null,"Hasta pronto",true);
}

function listarFavoritos(){
    $users_id=$_SESSION['usuario']['id'];
    $join="INNER JOIN  favorites f ON f.products_id=p.id";
    $where="AND f.users_id='$users_id'";
    $sql=getSqlListarProductos($join,$where);
    $sql=filtroProductos($sql);
    listarProductos($sql);
}
function saldo(){
    $users_id=$_SESSION['usuario']['id'];

    $arr=q("SELECT saldo FROM users WHERE id='$users_id'");
    if(is_array($arr)){
        salidaNueva($arr,'Consultando saldo',true);

    }else{
        salidaNueva(null,'Intente mas tarde',false);
    }
    
}
function listarProductosFiltrados($tipo_salida=false,$simple=false){
    $precioInicial=$_GET['precioInicial'];
    $precioFinal=$_GET['precioFinal'];
    $tipo=$_GET['tipo'];
   
    switch($tipo){
        case 'Mas vendidos':
            $order='ORDER BY qty_sold DESC';
            $sql=getSqlListarProductos('','',$order);
        break;
        case 'Mejores precios':
            $order='ORDER BY p.price ASC';
            $sql=getSqlListarProductos('','',$order);
        break;
        case 'Orden alfabético A-Z';
            $order='ORDER BY p.name ASC';
            $sql=getSqlListarProductos('','',$order);
        break;
        case 'Orden alfabético Z-A';
            $order='ORDER BY p.name DESC';
            $sql=getSqlListarProductos('','',$order);
        break;
        case 'Mas recientes':
            $order='ORDER BY id DESC';
            $sql=getSqlListarProductos('','',$order);
        break;
        default:
        
        $sql=getSqlListarProductos();
    }
    
    if($precioInicial and $precioFinal){
        $sql="SELECT * FROM ($sql) as consulta WHERE total_precio_dolar>'$precioInicial' AND total_precio_dolar<'$precioFinal'";
    }
    //exit($sql);
    return listarProductos($sql,false,$tipo_salida,true,true);
}
function filtroProductos($sql){
    $precioInicial=$_GET['precioInicial'];
    $precioFinal=$_GET['precioFinal'];
    $tipo=$_GET['tipo'];
    switch($tipo){
        case 'Mas vendidos':
            $order='ORDER BY qty_sold DESC';
        break;
        case 'Mejores precios':
            $order='ORDER BY price ASC';
        break;
        case 'Orden alfabético A-Z';
            $order='ORDER BY name ASC';
        break;
        case 'Orden alfabético Z-A';
            $order='ORDER BY name DESC';
        break;
        default://mas recientes
            $order='ORDER BY id DESC';
        break;
    }
    if($precioInicial>-1 and $precioFinal>0){
        $where="WHERE total_precio_dolar>'$precioInicial' AND total_precio_dolar<'$precioFinal'";
    }
    $sql="SELECT * FROM ($sql) as consulta $where $order";
    return $sql;
}
function listarProductosPorCategoria(){
            //saber si es mayor de edad
            $categories_id=$_GET['categories_id'];
            $users_id=$_SESSION['usuario']['id'];
           
            $arr=q("SELECT 1 FROM categories WHERE id='$categories_id' AND adulto='Y' AND (select date_part('year',age(p.birthdate)) FROM users INNER JOIN peoples p ON p.id=users.peoples_id WHERE users.id='$users_id')<18");
            if(is_array($arr)){
                salidaNueva(null,"Disculpe, debe ser mayor de edad (18+) para acceder a esta categoría.",false);
            }
    //se borro INNER JOIN det_sub_categories dsc ON dsc.products_id=p.id
            //$join="INNER JOIN sub_categories sc ON sc.id=dsc.sub_categories_id";
            $where="AND sc.categories_id='$categories_id'";
            $sql=getSqlListarProductos("",$where);
            $sql=filtroProductos($sql);
            listarProductos($sql);
}
function productosMayorEdad($tipo_salida){
    $users_id       =$_SESSION['usuario']['id'];
    $sql="SELECT p.id as products_id FROM det_sub_categories dsc
    INNER JOIN products p ON p.id=dsc.products_id
    INNER JOIN sub_categories sc ON sc.id=dsc.sub_categories_id
    INNER JOIN categories c ON c.id=sc.categories_id WHERE 
    ((c.adulto='Y' AND (select date_part('year',age(p.birthdate)) FROM users INNER JOIN peoples p ON p.id=users.peoples_id WHERE users.id='$users_id')<18))";
      $arr=q($sql);

      if(is_array($arr)){
        $arrb=reformularId($arr);
          return salidaNueva($arrb,"Disculpe, debe ser mayor de edad (18+) para comprar este producto.",true,$tipo_salida);
      }else{
          return salidaNueva(null,"El usuario es mayor de edad.",false,$tipo_salida);
      }  
}
function mayorDeEdad($tipo_salida){

    $products_id    =$_GET['products_id'];
    $users_id       =$_SESSION['usuario']['id'];


    $add="p.id=$products_id AND";
   

    $sql="SELECT 1 FROM det_sub_categories dsc
    INNER JOIN products p ON p.id=dsc.products_id
    INNER JOIN sub_categories sc ON sc.id=dsc.sub_categories_id
    INNER JOIN categories c ON c.id=sc.categories_id WHERE 
    $add
    (c.adulto='N' OR (c.adulto='Y' AND (select date_part('year',age(p.birthdate)) FROM users INNER JOIN peoples p ON p.id=users.peoples_id WHERE users.id='$users_id')>=18))";

    $arr=q($sql);

if(is_array($arr)){
    salidaNueva(null,"Acceso concedido.",true,$tipo_salida);
}else{
    salidaNueva(null,"Disculpe, debe ser mayor de edad (18+) para comprar este producto.",false);
}
}

function getPage(){
    $page_id=$_GET['page_id'];
    $arr=q("SELECT titulo,body FROM pages WHERE status='A' and id='$page_id'");
    if(is_array($arr)){
       echo $arr[0]['body'];
    }else{
        echo 'Disculpe, intente mas tarde.';
    }     
}

function consultarOrden(){
    $id=$_GET['id'];
    $arr=q("SELECT (SELECT json_agg(
        json_build_object(
        'id', op.products_id, 
        'cant', op.cant,
        'image',p.photo,
        'name',p.name,
        'price',op.price
    )
    
) FROM order_products op INNER JOIN products p ON p.id=op.products_id WHERE op.orders=o.id) productos,oa.address, p.name as nombre_usuario, o.*,TO_CHAR(o.created_at, 'dd/mm/yyyy HH12:MI AM') AS fecha,TO_CHAR(o.delivery_time_date, 'dd/mm/yyyy HH12:MI AM') AS fecha_entrega,os.name status_tracking,t.orders_status_id FROM (SELECT o.*,MAX(t.id) as t_id FROM orders o INNER JOIN trackings t ON t.orders_id=o.id GROUP BY o.id) o INNER JOIN trackings t ON t.id=o.t_id INNER JOIN orders_status os ON os.id=t.orders_status_id LEFT JOIN order_address oa ON oa.id=o.order_address_id INNER JOIN users ON o.users_id=users.id INNER JOIN peoples p ON p.id=users.peoples_id WHERE o.id='$id'");
    if(is_array($arr)){
        salidaNueva($arr,"Orden consultada");
    }else{
        salidaNueva(null,"Disculpe, intente de nuevo",false);
    }
}
function recargoEnvio($tipo_salida){
    $transports_id=2;
        $coins_id=1; // Esta es la moneda principal para los pagos. Esto se debe funcionar dinamicamente.
        //$sql="SELECT p.precio_b,(p.precio_b/(SELECT rate FROM coins WHERE id=$coins_id)) as precio_d FROM (SELECT (price*(SELECT SUM(value) FROM det_tax_transports dtt INNER JOIN taxes t ON t.id=dtt.taxes_id WHERE dtt.transports_id=$transports_id GROUP BY dtt.transports_id)/100+price) as precio_b FROM transports WHERE id=$transports_id) p";
        $sql="
        SELECT p.peso_max,p.precio_b,(p.precio_b/(SELECT rate FROM coins WHERE id=1)) as precio_d FROM (SELECT (price*
																							 (with sum_null as (SELECT SUM(value) as sum_n
FROM det_tax_transports dtt INNER JOIN taxes t ON t.id=dtt.taxes_id WHERE dtt.transports_id=2 GROUP BY
dtt.transports_id) select case
    when not exists (select 1 from sum_null) then 0
    else (select sum_n from sum_null) end) /100+price) as precio_b,t.peso_max FROM transports t WHERE id=2) p
        ";
  //exit($sql);
        $arr=q($sql);
       // exit($arr);
        return salidaNueva($arr,"Recargo envio",true,$tipo_salida);
}

function getPerfil($tipo_salida){
    $users_id=$_SESSION['usuario']['id'];
    $arr=q("SELECT p.phone, c.id as cities_id, r.id as regions_id, r.states_id, users.avatar,users.email, split_part(p.rif, '-', 1) as nacionalidad,split_part(p.rif, '-', 2) as nro_rif,p.rif,p.sex,p.name,p.birthdate FROM users INNER JOIN peoples p ON p.id=users.peoples_id LEFT JOIN cities c on c.id=p.cities_id LEFT JOIN regions r ON r.id=c.regions_id WHERE users.id='$users_id'");
    if(is_array($arr)){
        return salidaNueva($arr,"Perfil",true,$tipo_salida);
   }else{
    return salidaNueva(null,"Disculpe, intente de nuevo",false,$tipo_salida);
   }
}

function listarBancosdelMetododePago($tipo_salida){
    $payment_methods_id=$_GET['payment_methods_id'];
    
    echo"esto es payment $payment_methods_id";
    
    $sql="SELECT c.name c_name,b.name b_name,bd.titular,bd.description,bd.id,c.id coins_id,c.rate FROM bank_datas bd INNER JOIN banks b ON b.id=bd.banks_id INNER JOIN coins c ON c.id=bd.coins_id WHERE payment_methods_id=$payment_methods_id";
    
    $arr=q($sql);

    if(is_array($arr)){
        return salidaNueva($arr,"Listando datos bancarios",true,$tipo_salida);
   }else{
    return salidaNueva(null,"Disculpe, intente mas tarde",false,$tipo_salida);
   }
}
function listarBancosdelMetododePagoAll($tipo_salida){
    $sql="SELECT bd.id,payment_methods_id,c.name c_name,b.name b_name,bd.titular,bd.description,bd.id,c.id coins_id,c.rate FROM bank_datas bd INNER JOIN banks b ON b.id=bd.banks_id INNER JOIN coins c ON c.id=bd.coins_id";
    $arr=q($sql);
    if(is_array($arr)){
        return salidaNueva($arr,"Listando datos bancarios",true,$tipo_salida);
   }else{
    return salidaNueva(null,"Disculpe, intente de nuevo",false,$tipo_salida);
   }
}
function actualizarPerfil(){
    $rif=trim($_POST['rif']);
    $sex=trim($_POST['sex']);
    $name=trim($_POST['name']);
    $birthdate=trim($_POST['birthdate']);
    $phone=trim($_POST['phone']);
    //$cities_id=$_POST['cities_id'];
    $users_id=$_SESSION['usuario']['id'];
    $sql="UPDATE peoples SET birthdate='$birthdate',phone='$phone', rif='$rif',name='$name',sex='$sex' WHERE id=(SELECT peoples_id FROM users WHERE id='$users_id') RETURNING id";

  // salidaNueva(null,$sql,false);
   $arr=q($sql);
   if(is_array($arr)){
        $data=getPerfil(true);
        salidaNueva($data['data'],"Perfil actualizado correctamente");
   }else{
    salidaNueva(null,"Disculpe, intente de nuevo",false);
   }
}
function listarOrdenes(){
    $users_id=$_SESSION['usuario']['id'];
        $sql="SELECT o.*,TO_CHAR(o.created_at :: DATE, 'dd/mm/yyyy') AS fecha,os.name status_tracking,t.orders_status_id FROM (SELECT o.*,MAX(t.id) as t_id FROM orders o LEFT JOIN order_address oa ON oa.id=o.order_address_id INNER JOIN trackings t ON t.orders_id=o.id GROUP BY o.id) o INNER JOIN trackings t ON t.id=o.t_id INNER JOIN orders_status os ON os.id=t.orders_status_id WHERE o.users_id='$users_id' ORDER BY o.id DESC";
   // exit($sql);
        $arr=q($sql);
   
        if(is_array($arr)){
            salidaNueva($arr,"Listando ordenes");
        }else{
            salidaNueva(null,"Disculpe, intente de nuevo",false);
        }
}
function listarMetodoDePago($tipo_salida){
    $arr=q("SELECT id,name,description,image FROM payment_methods WHERE status='A'");
        if(is_array($arr)){
            return salidaNueva($arr,"Listando metodos de pago",true,$tipo_salida);
        }else{
            return salidaNueva(null,"Disculpe, intente de nuevo",false,$tipo_salida);
        }
}
function listarTracking(){
    $users_id=$_SESSION['usuario']['id'];
        $orders_id=$_GET['orders_id'];
        $arr=q("SELECT t.description,os.name,TO_CHAR(t.created_at, 'dd/mm/yyyy HH12:MI AM') AS fecha FROM trackings t INNER JOIN orders_status os ON os.id=t.orders_status_id INNER JOIN orders o ON o.id=t.orders_id WHERE o.users_id='$users_id' AND o.id='$orders_id' ORDER BY t.id DESC");
        if(is_array($arr)){
            salidaNueva($arr,"Listando Tracking");
       }else{
        salidaNueva(null,"No hay datos disponibles",false);
       }
}
function horasDisponiblesEntrega(){
    echo "<script>console.log(' Entre aqui ');</script>";
    $diassemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sábado","Domingo");
    $arr=q("SELECT * FROM calendars WHERE status='A'");
    $arr_json = json_encode($arr);
    
    echo "<script>console.log(" . $arr_json . ");</script>";

    $horasNoDisponibles=array(20,21,22,23,01,02,03,04,05,06,07);
    $iniciarDespuesDe=2; //Horas
    $timenow = time();
    $index=0;
    $maxApartado=12;
    $o=0;//hora apartada
    $i=2;//hora inicial
    $horas = [];
    while($o<$maxApartado){          

        $fechaComprobar = strtotime("+ $i hours",time());
        $horaComprobar=date('H:i',$fechaComprobar);
        $diaComprobar=date('N',$fechaComprobar);
        $diaActual=strftime('%d',$timenow);
        if(comprobarDia($diaComprobar,$horaComprobar,$arr)){
            $o++;
            $diaDisponible=strftime('%d',$fechaComprobar);
            //$horas[]['id']='A';
            $horas[$index]['id']=$index;
            $horas[$index]['time']=$fechaComprobar;
            $msjHora=date('h:iA',$fechaComprobar);
            if($diaActual==$diaDisponible){
                $msj="Hoy";
            }else{
                $msj=$diassemana[$diaComprobar-1];
            }
            $horas[$index]['name']=$msj." - ".$msjHora;
            $index++;
        }
        $i++;
        if($i==168){ //Para que no quede en un ciclo en caso de que esten cerrados los despachos
            break;
        }
    }

    $horas_json = json_encode($horas);

    // Imprimir en la consola del navegador
    echo "<script>console.log(" . $horas_json . ");</script>";

    salidaNueva($horas,"Listando horas disponible para entrega",true,false,false);
}
function loginMovil($tipo_salida){
    $email=mb_strtolower(trim($_GET['email']));
    $clave=trim($_GET['password']);
    
    $row=q("SELECT s.avatar,date_part('year',age(p.birthdate)) as edad,s.purchase_quantity, p.rif, split_part(p.rif, '-', 1) as nacionalidad,split_part(p.rif, '-', 2) as nro_rif, s.id,s.password,s.email,p.name,s.peoples_id,p.sex,p.birthdate,p.phone,p.phone_home
    FROM users s
    INNER JOIN peoples p on p.id = s.peoples_id
    WHERE lower(s.email)='$email'")[0];

   if($row['email']){
        if(password_verify($clave,$row['password'])){
            unset($row["password"]);
            $_SESSION["usuario"]=$row;
            $_SESSION['sesion_iniciada']=true;
            $row['id_sesion']=session_id();
            return salidaNueva($row,"Bienvenido",true,$tipo_salida);
        }else{
            $row=null;
            return salidaNueva($row,"Contraseña incorrecta",false,$tipo_salida);
        }
   }else{
   
    return salidaNueva($row,"Correo electrónico no valido",false,$tipo_salida);
    }
}
function guardarPago(){
    $amount=$_GET['amount'];
    $orders_id=$_GET['orders_id'];
    $bank_datas_id=$_GET['bank_datas_id'];
    $ref=trim($_GET['ref']);
    $coins_id=$_GET['coins_id'];
    $status='nuevo';

    if(isset($_GET['user_id']) and !empty($_GET['user_id'])){
        $users_id=$_GET['user_id'];
    }else{
        $users_id=$_SESSION['usuario']['id'];
    }
    

    $arr=q("SELECT payment_methods_id FROM bank_datas WHERE id='$bank_datas_id'");
    if(is_array($arr)){
        $payment_methods_id=$arr[0]['payment_methods_id'];
    }

    if($ref=='null' || $payment_methods_id==3){
       
        $ref="Efectivo $";
        if($payment_methods_id==5 || $payment_methods_id==12){
            $ref="-";
            $status='aprobado';
        }else{
            $status='efectivo';
        }
    }
    
    //PARA ARREGLAR PROBLEMA DE DIFERENCIAS EN DECIMALES CAMBIARIAS
    $diferencia_aceptable=0;
    if($coins_id==1){ //dolares
        $diferencia_aceptable=convertir_a_bs($coins_id,0.01);
        $sumar_sql="+$diferencia_aceptable";
       
    }
    //----------------------
    $users_id=$_SESSION['usuario']['id'];
   // $sql="SELECT id FROM orders WHERE id=$orders_id AND total_pay>=((SELECT SUM(amount) as amount FROM det_bank_orders dbo WHERE dbo.orders_id=$orders_id and (status='nuevo' OR status='aprobado') GROUP BY dbo.orders_id)+$amount)";
 





    q("BEGIN");
    //PARA BIOWALLET----------------   

    if($payment_methods_id==5){
        $sql="SELECT u.saldo FROM users u WHERE u.id='$users_id'";
        
        $arr=q($sql);

        if(is_array($arr)){
            $arrb=q("SELECT ROUND(('$amount'/rate),2) monto FROM coins WHERE id='1'");
            if(is_array($arrb)){
                $monto=$arrb[0]['monto'];
                
                $saldo=$arr[0]['saldo'];
     
                if($saldo<$monto){
                    
                    salidaNueva(null,"Su saldo es insuficiente",false);
                }
            }

        }
    }
//-------------------------------

    $sql="INSERT INTO det_bank_orders (coins_id,other_amount,status,ref,amount,orders_id,bank_datas_id,created_at,updated_at,users_id) VALUES('$coins_id','$diferencia_aceptable','$status','$ref',$amount,$orders_id,$bank_datas_id,NOW(),NOW(),$users_id) RETURNING id";
    //exit($sql);
   // exit($sql);
    $arr=q($sql);
    if(is_array($arr)) $pagoAbonado=true;

    //La variable $sumar_sql esta siendo mal usada dentro de la consulta. Por tal motivo, se comentó. Favor de dar razón de su uso.
    $sql="SELECT id FROM orders WHERE id=$orders_id AND total_pay<=((SELECT (SUM(amount)/*$sumar_sql*/) as amount FROM det_bank_orders dbo WHERE dbo.orders_id=$orders_id and (status='aprobado' OR status='efectivo') GROUP BY dbo.orders_id))"; 
    //exit($sql);
    $arr=q($sql);

    if(is_array($arr)){
        $order_status_id=4;
        $arr=q("INSERT INTO trackings (orders_id,orders_status_id,users_id,created_at,updated_at) VALUES ($orders_id,$order_status_id,$users_id,NOW(),NOW()) RETURNING id");
    
        // Verificar si la clave 'purchase_quantity' está definida en $_SESSION['usuario']
        if(isset($_SESSION['usuario']['purchase_quantity']) && $_SESSION['usuario']['purchase_quantity']==0){
            $_SESSION['usuario']['purchase_quantity']=1;
            enviarPaginaCorreo(4,$_SESSION['usuario']['email']);
        }
    }else{
        //La variable $sumar_sql esta siendo mal usada dentro de la consulta. Por tal motivo, se comentó. Favor de dar razón de su uso.
        $sql="SELECT id FROM orders WHERE id=$orders_id AND total_pay<=((SELECT (SUM(amount)/*$sumar_sql*/) as amount FROM det_bank_orders dbo WHERE dbo.orders_id=$orders_id and (status='nuevo' OR status='aprobado' OR status='efectivo') GROUP BY dbo.orders_id))";
    
        $arr=q($sql);
        if(is_array($arr)){
            $order_status_id=2;
            $arr=q("INSERT INTO trackings (orders_id,orders_status_id,users_id,created_at,updated_at) VALUES ($orders_id,$order_status_id,$users_id,NOW(),NOW()) RETURNING id");
    
            // Verificar si la clave 'purchase_quantity' está definida en $_SESSION['usuario']
            if(isset($_SESSION['usuario']['purchase_quantity']) && $_SESSION['usuario']['purchase_quantity']==0){
                $_SESSION['usuario']['purchase_quantity']=1;
                enviarPaginaCorreo(4,$_SESSION['usuario']['email']);
            }
        }
    }
   // exit();
    q("COMMIT");
    if($pagoAbonado){
        salidaNueva($arr,"Su pago ha sido abonado".$sql);
   }else{
         salidaNueva(null,"Disculpe, intente de nuevo",false);
   } 
}

function convertir_a_bs($coins_id,$value){
    $arr=q("SELECT rate FROM coins WHERE id='$coins_id'");
    if(is_array($arr)){
        return $arr[0]['rate']*$value;
    }else{
        return 0;
    }
}
function totalPagar(){
    $orders_id=$_GET['orders_id'];
    $users_id=$_SESSION['usuario']['id'];
    $sql="SELECT (SELECT COUNT(1) FROM det_bank_orders WHERE det_bank_orders.orders_id=$orders_id) as cant_pagos,(SELECT orders_status_id FROM trackings WHERE id=(SELECT MAX(t.id) FROM trackings t WHERE t.orders_id='$orders_id')) as order_status, total_pay,total_packaging,total_transport,rate_json, 
    (SELECT json_agg(
                json_build_object(
                'id', dbo.id, 
                'amount', dbo.amount,
                'status',dbo.status
            )
            
    ) FROM det_bank_orders dbo WHERE dbo.orders_id=$orders_id) pago_json
    
    FROM orders WHERE id=$orders_id AND users_id=$users_id";
   // exit($sql);
    $arr=q($sql);
    
    if(is_array($arr)){
        salidaNueva($arr,"Listando pagos");
   }else{
         salidaNueva(null,"Disculpe, intente de nuevo",false);
   }
}

function cancelarOrden(){
    $users_id=$_SESSION['usuario']['id'];
    $orders_id=$_GET['orders_id'];
    $orders_status_id=11;
   // salidaNueva(null,"SELECT 1 FROM orders WHERE orders_id=$orders_id AND users_id=$users_id",false);
   $sql="SELECT 1 FROM orders WHERE id=$orders_id AND users_id=$users_id AND ((SELECT orders_status_id FROM trackings WHERE id=(SELECT MAX(t.id) FROM trackings t WHERE t.orders_id='$orders_id'))=1)";
  
    $arr=q($sql);//SEGURIDAD
    if(is_array($arr)){
      
       // $arr=q("INSERT INTO trackings (orders_id,orders_status_id,users_id,created_at) VALUES ($orders_id,$orders_status_id,$users_id,NOW()) RETURNING id");
        $arr=q("UPDATE orders SET status='CU', observacion='Cancelado por el usuario',updated_at=NOW() WHERE id=$orders_id AND users_id='$users_id'  RETURNING id");
        if(is_array($arr)){
            salidaNueva($arr,"Orden cancelada exitosamente");
        }else{
                salidaNueva(null,"Disculpe, no podemos cancelar su orden",false);
        }  
    }else{
        salidaNueva(null,"Disculpe, no podemos cancelar su orden",false);
    }
}
function comprobarDia($diaComprobar,$horaComprobar,$arrs){
    foreach($arrs as $arr){
        if($arr['day']==$diaComprobar){
          //  exit($arr['hours_start']." - ".$arr['hours_end']." - ".$horaComprobar);
            if(compararHora($arr['hours_start'], $arr['hours_end'], $horaComprobar)){
                return true;
            }else{
                return false;
            }

        }
    }
}

function compararHora($from, $to, $input) {
    $dateFrom = DateTime::createFromFormat('!H:i', $from);
    $dateTo = DateTime::createFromFormat('!H:i', $to);
    $dateInput = DateTime::createFromFormat('!H:i', $input);
    if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
    return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
}
function crearOrden($json){
    
    //$json='{"estado":16,"productos":{"20":3,"21":4},"direccion":"3","hora_entrega":"1585872508"}';
    

    $orden=json_decode($json,true);
    
 
    $users_id   =$_SESSION['usuario']['id'];
    $order_address_id=$orden['direccion'] ?? "NULL";
    $delivery_type = $orden['delivery_type'];
    $delivery_type_text = "";
    $delivery_time_date=Date("Y-m-d H:i:s",$orden['hora_entrega']);
    $arrProductos=$orden['productos'];

    if($delivery_type == 0){
        $delivery_type_text = "Pick Up";
        $transports_id=1;
        $order_address_id="NULL";
    }else if ($delivery_type == 1){
        $delivery_type_text = "Delivery Express";
        $transports_id=2;
    }

    $coins_id=1;
    $packagings_id=1;
    $total_transport=0;
    $total_pay=0;
    $sub_total=0;
    $total_tax=0;
    $base_imponible=0.00;
    $exento=0.00;
    $rate_json=getRateJson();

    /*if($order_address_id!=null and $order_address_id!="null" and $order_address_id!="NULL" and $order_address_id!=0){
        $transports_id=2;
    }else{
        $transports_id=1;
        $order_address_id="NULL";
    }*/

    $where=armarWhereProductos($arrProductos);


    $sql="SELECT p.peso,p.qty_min, p.qty_max,p.qty_avaliable,p.name, ((coalesce(SUM(t.value),0.000000)*p.price)/100) total_impuesto,coalesce(((p.price*SUM(t.value)/100)+p.price),p.price) total_precio, p.id, p.price FROM products p LEFT JOIN det_product_taxes dpt ON dpt.products_id=p.id  LEFT JOIN taxes t ON t.id=dpt.taxes_id and t.status='A' WHERE p.status='A' $where GROUP BY p.id";


    $arrs=q($sql);



    //Validaciones
    if(!is_array($arrs)){
        salidaNueva(null,"Disculpe intente mas tarde.2",false);
    }

    $pesoTotal=0.00;
    foreach($arrs as $pro){
  
        $cant=$arrProductos[$pro['id']];
        $pesoTotal+=($pro['peso']*$cant);
        $impuesto=$pro['total_impuesto']*$cant;
        $total_tax+=$impuesto;
        $precio=$pro['price']*$cant;
        if($impuesto>0){
            $base_imponible+=$precio;
        }else{
            $exento+=$precio;
        }
        //$total_pay+=$pro['total_precio']*$cant;
        $sub_total+=$precio;
       
        //exit("PRODUCTO cant ".$cant);
        if($pro['qty_avaliable']<$cant){
            salidaNueva(null,"No hay cantidad suficiente para ".$pro['name'].", por favor chequee el Stock en su carrito de compras.",false);
        }    
        if($pro['qty_min']>$cant){
            salidaNueva(null,"El pedido min. de "+$pro['name']+" debe ser: ".$pro['qty_min'],false);
        }    
        if($pro['qty_max']<$cant and $pro['qty_max']!=0){
            salidaNueva(null,"No puede comprar mas de ".$pro['qty_max']." ".$pro['name'],false);
        }    
    }
   //TRANSPORTS
   $sql="SELECT peso_max,price,coalesce((price*(SELECT SUM(value) FROM det_tax_transports dtt INNER JOIN taxes t ON t.id=dtt.taxes_id WHERE dtt.transports_id=$transports_id GROUP BY dtt.transports_id)/100),0.000000) as impuesto FROM transports WHERE id=$transports_id";

    $arr=q($sql);
    // dd($arr); 

        // Parsear el arreglo a JSON


    if(is_array($arr)){

        //--------PESO-----
        $peso_max=$arr[0]['peso_max'];
        $peso_cargado=$peso_max;
        $multiplo_peso=1;

        while($pesoTotal>$peso_cargado) {
            $multiplo_peso++;
        
            $peso_cargado+=($peso_max+$peso_cargado);
        
        }
//--------------FIN PESO------------------- 

        // ! VALIDACION PARA EL MAX PRICE - COMENTADO GUARDAR PORFA PLS
        // if($arr[0]['price'] > 15){
        //     $total_transport=($arr[0]['price']*0);
        // }else{
        //     $total_transport=($arr[0]['price']*$multiplo_peso);
        // }
        // //dd($arr);

        $total_transport=($arr[0]['price']*$multiplo_peso);
        
        $impuesto=$arr[0]['impuesto'];
        //dd($impuesto);
        if($impuesto>0){
            $base_imponible+=$total_transport;
            $total_tax+=$impuesto;
        }else{
            $exento+=$total_transport;
        }
    }
    $total_pay=$sub_total+$total_tax+$total_transport;
    //GUARDAR
   
    $sql="INSERT INTO orders (users_id,delivery_time_date,transports_id,rate_json,order_address_id,created_at,updated_at,coins_id,packagings_id,total_transport,total_packaging,total_tax,sub_total,total_pay,bi,exento, delivery_type)  VALUES ('$users_id','$delivery_time_date','$transports_id','$rate_json',$order_address_id,NOW(),NOW(),$coins_id,$packagings_id,$total_transport,(SELECT value FROM packagings WHERE id=$packagings_id),$total_tax,$sub_total,$total_pay,$base_imponible,$exento,'$delivery_type_text') RETURNING id";
    
   

    //EXIT($sql);
q("BEGIN");
    $res=q($sql);
    $orders=$res[0]['id'];
    foreach($arrs as $pro){
        $cant=$arrProductos[$pro['id']];
        $price=$pro['price'];
        $total=$pro['total_precio'];
        $deduction=0;
        $products_id=$pro['id'];
        $sql="INSERT INTO order_products (cant,price,total,orders,deduction,cod_combo,products_id,created_at) VALUES ($cant,$price,$total,$orders,$deduction,NULL,$products_id,NOW()) RETURNING id";
        //EXIT($sql);
        $arr=q($sql);
    }
    //if($order_address_id=="NULL") $orders_status_id=5; else 
    
    // Imprimir el JSON resultante
  

    $orders_status_id=1;
    $sql="INSERT INTO trackings (orders_id,orders_status_id,users_id,created_at,tiempo_min) VALUES ($orders,$orders_status_id,$users_id,NOW(),0)";
    q($sql);
    q("COMMIT");

  salidaNueva($res,"Su orden ha sido procesada!");

}
function getRateJson(){
    $arr=q("SELECT id,name,symbol,rate FROM coins WHERE status='A'");
    return json_encode($arr);
}
function armarWhereProductos($arrProductos){
$where = '';
    
    foreach($arrProductos as $id => $cant){
        if($cant > 0){
            $where .= ' p.id=' . $id . ' OR';
        }
    }
    $where = 'AND (' . rtrim($where, ' OR') . ')';
    return trim($where);

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
function listarProductosCarrito($json){

    $productos=json_decode($json);
   
    foreach($productos as $id=>$cant){
        if($cant>0){
        $where.=' p.id='.$id.' OR';
        $arr[$id]=$cant;
        }
        
    }
    $where='AND ('.rtrim($where,' OR').')';
    $sql=getSqlListarProductos('',trim($where));
    listarProductos($sql,$arr);
}
function listarProductosPorBusqueda($tipo_salida=false){
    $texto=mb_strtolower($_GET['texto']);
    $arr=explode(' ',$texto);
    $otro='';
    if(count($arr)>1){
        foreach($arr as $s){
            $otro.="$s&";
        }
        $otro=rtrim($otro,'&');
    }else{
        $otro=$texto;
    }
    
    $where="AND ((to_tsvector(p.name) @@ to_tsquery('$otro')) OR (p.name iLIKE '%$texto%'))";

    $sql=getSqlListarProductos('',$where,'');
    $sql=filtroProductos($sql);

    listarProductos($sql,false,false,$tipo_salida);    
}
function buscarProducto(){//el autocompletado
  
    $texto=mb_strtolower($_GET['texto']);
    $arr=q("SELECT name,price,sku FROM products WHERE (LOWER(name) LIKE '%$texto%') AND status='A' AND qty_avaliable>0");
    if(is_array($arr)){
        salidaNueva($arr,"Coincidencia");
    }else{
        salidaNueva(null,"No se encuentran productos",false);
    }
}
function guardarVisitaProducto(){
    $users_id   =$_SESSION['usuario']['id'];
    $products_id=$_GET['products_id'];
    $arr=q("SELECT 1 FROM user_visit_products WHERE products_id='$products_id' AND users_id='$users_id'");
    if(is_array($arr)){
        q("UPDATE user_visit_products SET updated_at=NOW() WHERE products_id='$products_id' AND users_id='$users_id'");
    }else{
        q("INSERT INTO user_visit_products (products_id,users_id,created_at,updated_at) VALUES ('$products_id','$users_id',NOW(),NOW())");
    }
}
function guardarOpinion(){
    $users_id   =$_SESSION['usuario']['id'];
    $products_id=$_GET['products_id'];
    $opinion=$_GET['opinion'];
    $arr=q("UPDATE rating_products SET opinion='$opinion' WHERE users_id='$users_id' AND products_id='$products_id' RETURNING id");

    if(is_array($arr)){
    salidaNueva(null,"Gracias por su comentario.");
}
salidaNueva(null,"Disculpe, intente nuevamente.",false);
}
function guardarOpinionOrden() {
    // Obtener valores de $_SESSION y $_GET
    $users_id       = $_SESSION['usuario']['id'];
    $orders_id      = $_GET['orders_id'];
    $opinion= $_GET['opinion'];
    $user_rating = intval($_GET['user_rating']);

    try {   
        $dsn = "pgsql:host=" . env('DB_HOST') . ";port=" . env('DB_PORT') . ";dbname=" . env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        // Establecer conexión PDO
        $pdo = new PDO($dsn, $username, $password);
        
        // Comenzar transacción
        $pdo->beginTransaction();

        // Preparar y ejecutar la primera sentencia SQL
        $stmt = $pdo->prepare("UPDATE orders SET opinion = :opinion, user_rating = :user_rating WHERE users_id = :users_id AND id = :orders_id");
        $stmt->bindParam(':opinion', $opinion);
        $stmt->bindParam(':user_rating', $user_rating);
        $stmt->bindParam(':users_id', $users_id);
        $stmt->bindParam(':orders_id', $orders_id);
        $stmt->execute();

        // Obtener el número de filas afectadas por la operación UPDATE
        $num_rows_affected = $stmt->rowCount();

        // Confirmar la transacción
        $pdo->commit();
        
        if ($num_rows_affected > 0) {
            echo "Actualización exitosa. ID de orden actualizada: $orders_id";
            salidaNueva(null, "Gracias por su opinión.");
        } else {
            echo "No se pudo actualizar la orden.";
            salidaNueva(null, "Disculpe, intente nuevamente.", false);
        }
    } catch (PDOException $e) {
        // Revertir la transacción si ocurre un error
        $pdo->rollBack();
        echo "Error de PDO: " . $e->getMessage();
        salidaNueva(null, "Disculpe, intente nuevamente.", false);
    }

}


function guardarCalificacion(){
    $users_id   =$_SESSION['usuario']['id'];
    $products_id=$_GET['products_id'];
    $rating     =$_GET['rating'];
    $sql="DELETE FROM rating_products WHERE users_id='$users_id' AND products_id='$products_id'";
 
    q($sql);
    $arr=q("INSERT INTO rating_products (users_id,products_id,rating) VALUES('$users_id','$products_id','$rating') RETURNING id");
    
    if(is_array($arr)){
        salidaNueva(null,"Calificado exitosamente");
    }else{
        salidaNueva(null,"Ha fallado la calificación",false);
    }
}

function listarProductosAll(){
    try {
        // Realizar la consulta SQL para seleccionar todos los productos
        $sql = "SELECT * FROM products";
        $result = q($sql); // Ejecutar la consulta y obtener el resultado
    
        if (is_array($result) && !empty($result)) {
            // Crear un nuevo array donde cada elemento tenga como clave el ID del producto
            $formattedResult = [];
            foreach ($result as $product) {
                $formattedResult[$product['id']] = $product;
            }
    
            // Devolver el resultado formateado como JSON
            return salida($formattedResult, "Listando todos los productos", true);
        } else {
            // Si no se encontraron resultados, devolver un mensaje de error
            return salida(null, "No se encontraron productos.", false);
        }
    } catch (\Exception $e) {
        // Manejar cualquier excepción y devolver un mensaje de error
        return salida(null, "Disculpe, ocurrió un error al listar los productos. Por favor, intente nuevamente.", false);
    }
    
    
}


function listarProductosArray(){

    try {
        // Realizar la consulta SQL para seleccionar todos los productos
        $sql = "SELECT * FROM products";
        $result = q($sql); // Ejecutar la consulta y obtener el resultado
    
        // Devolver el resultado como JSON
        return salida($result, "listando productos", true);
    } catch (\Exception $e) {
        // Manejar cualquier excepción y devolver un mensaje de error
        return salida(null, "Disculpe, ocurrió un error al listar los productos. Por favor, intente nuevamente.", false);
    }
}


function listarProductosIA($tipo_salida=false,$simple=false){
    $users_id=$_SESSION['usuario']['id'];
    //$users_id=1;
        $cant_mostrar=20;
            //para no repetir las palabras
        $nameUnico=array();
        $description_short=array();
        $keyword=array();
        //
    try{
        $arr=q('SELECT p.name, p.description_short, initcap(p.keyword) keyword, products_id FROM user_visit_products uvp INNER JOIN products p ON p.id=uvp.products_id WHERE uvp.updated_at > NOW() - interval \'1 month\' AND uvp.users_id='.$users_id.' LIMIT 20');
        $string="";
        if(is_array($arr)){
            foreach ($arr as $obj){
               
                    $nameUnico=_filtro($obj['name'],$nameUnico);
                    $nameUnico=_filtro($obj['description_short'],$nameUnico);
                    $nameUnico=_filtro($obj['keyword'],$nameUnico);
            }
            foreach($nameUnico as $key => $valor){
                $string.=$key." ";
            }
        }else{
            $order='ORDER BY RANDOM()';
            $sql=getSqlListarProductos('','',$order);
           
            listarProductos($sql,false,$tipo_salida,true,$simple);
        }
    }
    catch(\Exception $e){
        salidaNueva(null,"disculpe, intente nuevamente");
    }

   $texto_formateado_para_buscar=str_replace(" "," | ",preg_replace('/\s+/', ' ', trim($string)));
   try{
       $sql="SELECT p.id, p.name, ts_rank_cd(to_tsvector(description_short), query) AS rank
       FROM products p, to_tsquery('$texto_formateado_para_buscar') query
       WHERE query @@ to_tsvector(description_short)
       ORDER BY rank DESC
       LIMIT $cant_mostrar";
       $order='ORDER BY RANDOM()';
      $join="INNER JOIN ($sql) as r ON r.id=p.id";
      $sql=getSqlListarProductos($join,'',$order);
    
      listarProductos($sql,false,$tipo_salida,true,$simple);
    }
    catch(\Exception $e){
        salidaNueva(null,"disculpe, intente nuevamente 2");
    }
}
function _filtro($obj,$nameUnico){
    if($obj){
        $u=explode(' ',$obj);
        
        if(count($u)>0){
            foreach($u as $a){
                //$a=trim($a);
                if(preg_match('/^[a-zA-ZñáéíóúÑÁÉÍÓÚ]/',$a) and strlen($a)>3){
                    $nameUnico[$a]=true;
                }
            }
        }
    }
    return $nameUnico;
}
function getSqlListarProductos($join='',$where='',$order='ORDER BY p.id DESC',$limit='',$is_limit = true){
    if($is_limit) $limit='LIMIT 100';

    $users_id=$_SESSION['usuario']['id'];
    if($users_id){
        
        $whereUsuario="(SELECT rating FROM rating_products WHERE users_id='$users_id' AND products_id=p.id) as calificado_por_mi,";
    }
  
  //  $sql="SELECT p.qty_sold,p.peso,p.qty_avaliable,p.qty_max,p.description_short,coalesce(SUM(t.value),0.000000) total_impuesto,coalesce(((p.price*SUM(t.value)/100)+p.price),p.price) total_precio, p.name,p.photo as image, p.id, p.price,$whereUsuario ROUND(p.user_rating) as rating,coalesce(((p.price*SUM(t.value)/100)+p.price),p.price)/(SELECT rate FROM coins WHERE id=1) as total_precio_dolar FROM products p LEFT JOIN det_product_taxes dpt ON dpt.products_id=p.id  LEFT JOIN taxes t ON t.id=dpt.taxes_id and t.status='A' $join  WHERE (p.status='A' AND p.qty_avaliable>0) $where GROUP BY p.id $order $limit";
    $sql="SELECT json_agg(
        json_build_object(
    's', sc.id,
    'c',c.id,
    'm',c.adulto
) 
) json_subcategories,
initcap(p.keyword) keyword,
p.qty_sold,p.peso,
p.qty_avaliable,
case when p.keyword ilike '%insuperable%' then 1 else 0 end as promocion,
p.qty_max,
p.description_short,
((p.qty_avaliable * p.porc_stock) / 100) as qty_avaliable,
coalesce((SELECT sum(t.value) FROM taxes t INNER JOIN det_product_taxes dpt ON dpt.products_id=p.id AND t.id=dpt.taxes_id GROUP BY p.id),0.000000) total_impuesto,
coalesce(((p.price*(SELECT sum(t.value) FROM taxes t INNER JOIN det_product_taxes dpt ON dpt.products_id=p.id AND t.id=dpt.taxes_id GROUP BY p.id)/100)+p.price),p.price) total_precio,
p.name,p.photo as image, p.id, p.price,$whereUsuario ROUND(p.user_rating) as rating,
coalesce(((p.price*(SELECT sum(t.value) FROM taxes t INNER JOIN det_product_taxes dpt ON dpt.products_id=p.id AND t.id=dpt.taxes_id GROUP BY p.id)/100)+p.price),p.price)/(SELECT rate FROM coins WHERE id=1) as total_precio_dolar
FROM products p INNER JOIN det_sub_categories dsc ON p.id=dsc.products_id
INNER JOIN sub_categories sc ON sc.id=dsc.sub_categories_id
INNER JOIN categories c ON c.id=sc.categories_id
$join  WHERE (p.status='A' AND ((p.qty_avaliable * p.porc_stock) / 100) > 0) $where GROUP BY p.id $order $limit";
 
    return $sql;
}
function listarProductos($sql,$agregarCantidad=false,$tipo_salida=false,$comprimido=true,$simple=false){
    if($simple){
        $sql="SELECT id FROM ($sql) as todo";
    }
    $row=q($sql);
    if(is_array($row)){
        if($simple==false){
        $row=recortar_imagen($row,$agregarCantidad);
        }

            
        
        return salidaNueva($row,"Listando productos",true,$tipo_salida,$comprimido);
    }else{
        return salidaNueva(null,"No encontramos productos que coincidan con tu búsqueda.",false,$tipo_salida,$comprimido);
    }
}

function consultarFavorito(){
    $users_id=$_SESSION['usuario']['id'];
    $products_id=$_GET['products_id'];
    $arr=q("SELECT id FROM favorites WHERE products_id='$products_id' AND users_id='$users_id'");
    if(is_array($arr)){
        salidaNueva($arr,"Consulta procesada");
    }else{
        salidaNueva(null,"No es su favorito",false);
    }   
}
function guardarFavorito(){
    $users_id=$_SESSION['usuario']['id'];
    $products_id=$_GET['products_id'];
    $arr=q("SELECT id FROM favorites WHERE products_id='$products_id' AND users_id='$users_id'");
    if(is_array($arr)){
        $id=$arr[0]['id'];
        $arr=q("DELETE FROM favorites WHERE id='$id' RETURNING id");
    }else{
        $arr=q("INSERT INTO favorites (users_id,products_id) VALUES ('$users_id','$products_id') RETURNING id");

    }

    

    if(is_array($arr)){
        $data=best_sql_listarFavoritos(true);
        salidaNueva($data['data'],"Modificado exitosamente");
    }else{
        salidaNueva(null,"Disculpe, intente mas tarde",false);
    }   
}
/*
function listarProductos(){
    //SELECT SUM(t.value) total_impuesto,((p.price*SUM(t.value)/100)+p.price) precio_impuesto, p.name,p.photo as image, p.id, p.price, ROUND(p.user_rating) as rating FROM products p LEFT JOIN det_product_taxes dpt ON dpt.products_id=p.id  LEFT JOIN taxes t ON t.id=dpt.taxes_id and t.status='A'  WHERE p.status='A' AND p.qty_avaliable>0 GROUP BY p.id
    //$row=q("SELECT name,photo as image,id,price,ROUND(user_rating) as rating FROM products WHERE status='A' AND qty_avaliable>0");
    $row=q("SELECT p.description_short,coalesce(SUM(t.value),0.000000) total_impuesto,coalesce(((p.price*SUM(t.value)/100)+p.price),p.price) total_precio, p.name,p.photo as image, p.id, p.price, ROUND(p.user_rating) as rating,coalesce(((p.price*SUM(t.value)/100)+p.price),p.price)/(SELECT rate FROM coins WHERE id=1) as total_precio_dolar FROM products p LEFT JOIN det_product_taxes dpt ON dpt.products_id=p.id  LEFT JOIN taxes t ON t.id=dpt.taxes_id and t.status='A'  WHERE p.status='A' AND p.qty_avaliable>0 GROUP BY p.id");
    $row=recortar_imagen($row);
    salida_movil($row);
}
*/
function listar_categorias_movil($tipo_salida){
    $row=q("SELECT c.name,c.image,c.image_b,c.id FROM categories c INNER JOIN sub_categories sc ON sc.categories_id=c.id INNER JOIN det_sub_categories dsc ON dsc.sub_categories_id=sc.id INNER JOIN products p ON p.id=dsc.products_id WHERE p.status='A' AND c.status='A' AND p.qty_avaliable>0 AND c.name<>'' GROUP BY c.id order by c.order");
    //$row=q("SELECT name,image,image_b,id FROM categories WHERE status='A'");
    $row=recortar_imagen($row);
    return salidaNueva($row,"Listado de categorias",true,$tipo_salida);
}
function eliminarDireccion(){
    $users_id=$_SESSION['usuario']['id'];
    $id=$_GET['id'];
    $arr=q("UPDATE order_address SET status='I' WHERE users_id='$users_id' AND id='$id'");
    salida(null,"Eliminado correctamente");
}
function getAdreess($tipo_salida,$type='delivery'){
    $users_id=$_SESSION['usuario']['id'];
    $arr=q("SELECT oa.*, st.id states_id, re.id regions_id, st.name st_name,ci.name ci_name,re.name re_name FROM order_address oa INNER JOIN cities ci ON ci.id=oa.cities_id INNER JOIN regions re ON re.id=ci.regions_id INNER JOIN states st ON st.id=re.states_id WHERE oa.users_id='$users_id' AND oa.status='A' AND oa.type='$type'");
    
    if(is_array($arr)){
        return salida($arr,'Listando direcciones',true,$tipo_salida);
    }else{
        return salida(null,"Disculpe no hay direcciones.",false,$tipo_salida);
    }
    
}
function guardarDireccion($type='delivery'){
    $users_id=$_SESSION['usuario']['id'];
    $cities_id=$_POST['cities_id'];
    $address=$_POST['address'];
    $zip_code=$_POST['zip_code'];
    $urb=$_POST['urb'];
    $sector=$_POST['sector'];
    $nro_home=$_POST['nro_home'];
    $reference_point=$_POST['reference_point'];
    $id=$_GET['id'];
    if($id){//Actualiza
        $arr=q("UPDATE order_address SET cities_id='$cities_id',address='$address',zip_code='$zip_code',urb='$urb',sector='$sector',nro_home='$nro_home',reference_point='$reference_point' WHERE users_id='$users_id' AND id='$id' RETURNING id");
    }else{//Registra
        $sql="INSERT INTO order_address (users_id,cities_id,address,zip_code,urb,sector,nro_home,reference_point,type) VALUES ('$users_id','$cities_id','$address','$zip_code','$urb','$sector','$nro_home','$reference_point','$type' ) RETURNING id";
        $arr=q($sql);
    }

    if(is_array($arr)){
        
        $data=getAdreess(true,$type);
        salidaNueva($data['data'],"Guardado exitosamente");
    }else{
        salidaNueva(null,"Disculpe, intente mas tarde",false);
    }

}
function getStates($tipo_salida,$all=false){
    if($all){
        $status="1=1";
    }else{
        $status="status='A'";
    }
    $arr=q("SELECT id,name FROM states WHERE $status ORDER BY name");
    if(is_array($arr)){
        return salidaNueva($arr,'Listando estados',true,$tipo_salida);
    }else{
        return salidaNueva(null,"No se cargaron los estados",false,$tipo_salida);
    }
}
function getCitiesAll($tipo_salida,$all=false){
    if($all){
        $status="1=1";
    }else{
        $status="status='A'";
    }
    $sql="SELECT id,name,regions_id FROM cities WHERE $status ORDER BY name";
    $arr=q($sql);
   
    if(is_array($arr)){
        return salidaNueva($arr,'parroquias',true,$tipo_salida);
    }else{
        return salidaNueva(null,"No se cargaron las parroquias",false,$tipo_salida);
    }
}
function getCities($tipo_salida){
    
    $regions_id=$_GET['regions_id'];
    $arr=q("SELECT id,name,regions_id FROM cities WHERE status='A' AND regions_id='$regions_id' ORDER BY name");
    if(is_array($arr)){
        return salidaNueva($arr,'Ciudades',true,$tipo_salida);
    }else{
        return salidaNueva(null,"No se cargaron las parroquias",false,$tipo_salida);
    }
}
function getRegions($tipo_salida){
    $states_id=$_GET['states_id'];
    
    $arr=q("SELECT id,name,states_id FROM regions WHERE status='A' AND states_id='$states_id' ORDER BY name");
    if(is_array($arr)){
        return salidaNueva($arr,'Listando regiones',true,$tipo_salida);
    }else{
        return salidaNueva(null,"No se cargaron los municipios",false,$tipo_salida);
    }
}
function getRegionsAll($tipo_salida, $all = false) {
    // Verificar si la clave 'states_id' está definida en $_GET
    if (isset($_GET['states_id'])) {
        $states_id = $_GET['states_id'];
    } else {
        // Manejar el caso cuando 'states_id' no está definida en $_GET
        // Puedes lanzar una excepción, devolver un valor predeterminado o realizar otra acción según tu lógica de negocio
        // Aquí solo se muestra un mensaje de advertencia
        return salidaNueva(null, "La clave 'states_id' no está definida en la solicitud", false, $tipo_salida);
    }

    if ($all) {
        $status = "1=1";
    } else {
        $status = "status='A'";
    }
    $arr = q("SELECT id,name,states_id FROM regions WHERE $status ORDER BY name");
    if (is_array($arr)) {
        return salidaNueva($arr, 'Listando municipios', true, $tipo_salida);
    } else {
        return salidaNueva(null, "No se cargaron los municipios", false, $tipo_salida);
    }
}

function cambiarClave(){
    $email  =$_SESSION['usuario']['email'];
    $passwordActual=$_POST['passwordActual']; 
    $password   =password_hash($_POST['password'],PASSWORD_BCRYPT);
    $res=q("SELECT password FROM users WHERE email='$email'");
    if(is_array($res)){
        if(password_verify($passwordActual,$res[0]['password'])){
            q("UPDATE users SET password='$password' WHERE email='$email'");
            salida(null,"Su contraseña ha sido cambiada.");
        }else{
            salida(null,"Contraseña actual invalida.",false);
        }
    }else{
        salida(null,"Por favor inicie de nuevo la sesión.",false);
    }
}
function cambiarClavePublico(){
    $email  =$_POST['email'];
    $codigoCorreo=$_POST['codigoCorreo']; 
    $password   =password_hash($_POST['password'],PASSWORD_BCRYPT);
    q("UPDATE users SET password='$password' WHERE email='$email' AND validateemail='$codigoCorreo'");
    salida(null,"Su cuenta ha sido recuperada.");
}
function confirmarCodRecuperacion(){
    $email  =$_POST['email'];
    $codigoCorreo=$_POST['codigoCorreo'];
    $res=q("SELECT 1 FROM users WHERE validateemail='$codigoCorreo' AND email='$email'");
    if(is_array($res)){
        salida(null,"Código Verificado correctamente.");
    }else{
        salida(null,"Código invalido, intente nuevamente.",false);
    }

}
function enviarCodRecuperacion(){
    $email  =$_GET['email'];
    $res=q("SELECT 1 FROM users WHERE email='$email'");
    $codigoCorreo=generateRandomString();
    if(is_array($res)){
        $res=enviarCorreo($email,'Código de verificación',plantillaCodigo($codigoCorreo));
if($res){
        q("UPDATE users SET validateemail='$codigoCorreo' WHERE email='$email'");
        
        //ENVIAR CORREO
        salida(null,"Verifique su correo electrónico.");
}else{
    salida(null,"Disculpe, intente mas tarde.",false);
}
    }else{
        salida(null,"El correo no existe, intente nuevamente.",false);
    }
}

function generateRandomString($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function confirmarCorreo(){
    $email  =$_POST['email'];
    $codigoCorreo=$_POST['codigoCorreo'];
    $res=q("SELECT 1 FROM users WHERE validateemail='$codigoCorreo' AND email='$email'");
    if(is_array($res)){
        q("UPDATE users SET email_verified_at=NOW() WHERE validateemail='$codigoCorreo' AND email='$email'");
        salida(null,"Código Verificado correctamente.");
    }else{
        salida(null,"Código invalido, intente nuevamente.",false);
    }

}
function registrarUsuario(){
   
    $name       =$_POST['name'];
    $rif        =$_POST['rif'];
    $email      =mb_strtolower(trim($_POST['email']));
    $password   =password_hash(trim($_POST['password']),PASSWORD_BCRYPT);
    $sex        =$_POST['sex'];
    $tlf        =$_POST['tlf'];
    $birthdate  =$_POST['birthdate'];
    $cities     =1;
    
    $codigoCorreo=generarCodigoVerificacion($email);
/*
$res=q("SELECT validateemail FROM users WHERE email='$email' and email_verified_at IS NULL");
if(is_array($res)){
    enviarCorreo($email,'Código de verificación',plantillaCodigo($codigoCorreo));
    $_SESSION['email']=$email;
    q("UPDATE users SET password='$password' WHERE email='$email' and email_verified_at IS NULL");
    salida(null,"Le hemos enviado nuevamente un email de confirmación.");
}
*/

q("BEGIN");
    $res=q("INSERT INTO peoples (name,rif,sex,cities_id,phone,birthdate) VALUES ('$name','$rif','$sex','$cities','$tlf','$birthdate') RETURNING id");
    if(is_array($res)){
        $peoples_id=$res[0]['id'];
        $res=q("INSERT INTO users (password,email,peoples_id,name,validateemail,email_verified_at) VALUES ('$password','$email','$peoples_id','$name','$codigoCorreo',NOW())");
        //$res=q("INSERT INTO users (password,email,peoples_id,name,validateemail) VALUES ('$password','$email','$peoples_id','$name','$codigoCorreo')");
        if($res){
            //enviarCorreo($email,'Código de verificación',plantillaCodigo($codigoCorreo));
            //salida(null,"Le hemos enviado un email de confirmación.");
            enviarPaginaCorreo(3,$email);
            q("COMMIT");
            salida(null,"Bienvenido.");
        }else{
            q("ROLLBACK");
            salida(null,"Intente de nuevo",false);
        }
    }else{
        q("ROLLBACK");
        salida(null,"Intente de nuevo",false);
    }
    
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

    require __DIR__.'/../vendor/autoload.php';
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
        echo "El mensaje no se pudo enviar! - {$mail->ErrorInfo}";
	    return false;
	}

}
function generarCodigoVerificacion($data){
//return "90000";
return hexdec( substr(sha1($data), 0, 5) );
}
function recortar_imagen_combo($row){
    foreach($row as $id=>$value){
        $arr=explode(".",$value['image']);
        $row[$id]['image']=cambiarBarra($arr[0].'-cropped.'.$arr[1]);
        $row[$id]['image_web']=cambiarBarra($arr[0].'-web.'.$arr[1]);
        $row[$id]['image_grande']=cambiarBarra($value['image']);
        
    }
     return $row;
    
}
function recortar_imagen($row, $cant=null) {
    foreach ($row as $id => $value) {
        $no_image[0] = 'imagenNoDisponible.png';

        if ($value['image'] == null or !file_exists('storage/'.json_decode($value['image'])[0])) {
            $value['image'] = json_encode($no_image);
        }

        if (isset($value['image_b'])) {
            $row[$id]['image_b'] = cambiarBarra($value['image_b']);
        }

        $img = json_decode($value['image']);
        if (is_array($img)) {
            $imgLista = $img[0];
        } else {
            $imgLista = $value['image'];
        }
        $arr = explode(".", $imgLista);

        $row[$id]['image'] = cambiarBarra($arr[0].'-cropped.'.$arr[1]);
        $row[$id]['image_grande'] = cambiarBarra($value['image']);
        $row[$id]['name'] = ucwords(mb_strtolower($value['name']));
        $row[$id]['description_short'] = ucfirst(mb_strtolower($value['description_short']));
        
        // Verificar si la clave 'calificado_por_mi' está definida en el array $value
        if (!isset($value['calificado_por_mi'])) {
            $row[$id]['calificado_por_mi'] = '0';
        }

        if (is_array($cant)) {
            $row[$id]['cant'] = $cant[$value['id']];
        }
        if ($value['rating'] == null) {
            $row[$id]['rating'] = '0';
        }
    }
    return $row;
}

function cambiarBarra($url){
    return str_replace("\\", "/", $url);
}
function salida($row,$msj_general="",$bueno=true){
    $row['success']=$bueno;
    if(!$bueno) header('HTTP/1.1 409 Conflict');
    $row['msj_general']=$msj_general;
    echo json_encode($row);
    exit();
}

function salidaNueva($row, $msj_general = "", $bueno = true, $tipo_salida = false, $comprimido = false) {
    $rowa['success'] = $bueno;


    if (!$bueno) {
        header('HTTP/1.1 409 Conflict');
    }
    $rowa['msj_general'] = $msj_general;
    $rowa['data'] = $row;
    
    // Verificar si la clave 'sesion_iniciada' está definida en $_SESSION
    if (isset($_SESSION['sesion_iniciada']) && $_SESSION['sesion_iniciada'] == true) {
        $rowa['login'] = true;
    }
    
    // Generar la salida si $tipo_salida es verdadero o $comprimido es verdadero
    if ($tipo_salida == true || $comprimido == true) {
        if ($comprimido == true) {
            echo d($rowa);

  
        } else {
           
            echo json_encode($rowa);
        }
    } else {
        // Si no se genera salida, simplemente devolver el arreglo $rowa
        $rowe = json_encode($rowa);

        echo "<script>console.log(" . $rowe . ");</script>";
    
        return $rowa;
    }
    exit();
}



function salida_movil($row,$msj_general="",$bueno=true){
    if(!$bueno) header('HTTP/1.1 409 Conflict');
    echo json_encode($row);
    exit();
}
function salida_list($row,$bueno=true){
    if(!$bueno) header('HTTP/1.1 409 Conflict');
    echo json_encode($row);
    exit();
}
function plantillaCodigo($codigo){
    return '
    <!--<div style="text-align:center; background-color: #203876;">
    <img width="200" src="https://i.imgur.com/bqhoBSp.png" titñe="Bio en Línea">
    
    </div>
    <br>-->
    <div style="text-align:center">
    Bienvenido a nuestra red Biomercados<br><br>Su codigo verificación es: <br>
    <b><span style="font-size:25px">'.$codigo.'</span></b>
    <br>
    Recuerde revisar tu bandeja <b>spam<b> o correos no deseados
    <br><hr><a href="#">linksitio.com</a> // TODO: Reemplazar por link del sitio web
    </div> 
    
 ';

}
function extraer_datos_db(){
    $gestor = @fopen("../.env", "r");
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
    // Verificar si la cadena contiene el carácter "=" antes de dividirla
    if (strpos($var, '=') !== false) {
        return trim(explode('=', $var)[1]);
    } else {
        // Si no contiene "=", devuelve la cadena original sin cambios
        return trim($var);
    }
}


function conectar_db() {
    // Cargar variables de entorno desde el archivo .env

    $host = $_ENV['DB_HOST'] ?? '127.0.0.1';
    $database = $_ENV['DB_DATABASE'] ?? 'postgres';
    $user = $_ENV['DB_USERNAME'] ?? 'postgres';
    $password = $_ENV['DB_PASSWORD'] ?? 'postgres';
    $port = $_ENV['DB_PORT'] ?? '5432';

    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$database";
        $pdo = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;

    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
        return null;
    }
}
function q($sql) {
    $arr = array();

    try {
        // Leer variables desde el .env
        $dsn = "pgsql:host=" . env('DB_HOST') . ";port=" . env('DB_PORT') . ";dbname=" . env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        // Crear conexión PDO
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        // Ejecutar consulta
        $stmt = $pdo->query($sql);
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return count($arr) > 0 ? $arr : true;
    } catch (PDOException $e) {
        salidaNueva(null, "Error de PDO: " . $e->getMessage(), false);

        switch ($e->getCode()) {
            case '23505':
                salidaNueva(null, "El registro ya existe.", false);
                break;
            case '22P02':
                salidaNueva(null, "Disculpe, intente más tarde.", false);
                break;
            default:
                salidaNueva(null, "Disculpe, intente más tarde...", false);
        }
    }

    salida_movil('', "Disculpe, intente de nuevo", false);
}

function wh_log($log_msg)
{
    $log_filename = "log";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
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
}
function run(){
    $postdata = file_get_contents("php://input");
    $input = json_decode($postdata);
    
    // Verificar si la clave 'id_sesion' está definida en $_GET
    if(isset($_GET['id_sesion'])) {
        session_id($_GET['id_sesion']);
    }
    
    return $input;
}

function seguro($varb){
    $sanitizedVars = array();
    foreach($varb as $id => $var) {
        // Sanitizar y escapar la variable antes de asignarla
        $sanitizedVar = htmlspecialchars(filter_var($var, FILTER_SANITIZE_STRING));

        // Agregar la variable sanitizada al array de salida
        $sanitizedVars[$id] = $sanitizedVar;
    }

    // Devolver el array de variables sanitizadas
    return $sanitizedVars;
}


function plantillaContacto($message){
    return '
    <div style="text-align:center; background-color: #203876;">
    <img width="200" src="https://i.imgur.com/bqhoBSp.png" titñe="Bio en Línea">
    
    </div>
    <br>
    <div style="text-align:center">
    Ha sido contactado mediante el portal de <a href="#">contacto</a> por: // TODO: Reemplazar por link del sitio web
    <br>
    <p><strong>Nombre y Apellido:</strong>&nbsp;'.$message['name'].'<br>
    <strong>Email:</strong>&nbsp;'.$message['email'].'<br>
    <strong>Mensaje:</strong>&nbsp;'.$message['message'].'<br>
    <br><hr><a href="#">linksitio.com</a> // TODO: Reemplazar por link del sitio web
    </div> 
    
 ';

}

function base64ToImage($base64_string, $output_file) {
    $file = fopen($output_file, "wb");
    $data = explode(',', $base64_string);
    fwrite($file, base64_decode($data[1]));
    fclose($file);
    chmod($output_file,"0777");

    return $output_file;
}

?>