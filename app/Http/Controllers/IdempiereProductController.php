<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IdempiereConnection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Auth;


class IdempiereProductController extends Controller
{
    public function getProducts()
{
    // Verificar si el usuario está autenticado
    if (!Auth::check()) {
        return redirect()->route('voyager.login')->with('error', 'Debes iniciar sesión para acceder a esta sección.');
    }

    // Obtener la configuración de conexión desde la base de datos
    $conexion = IdempiereConnection::first();

    if (!$conexion) {
        return dd('No se encontró la configuración de conexión a IDempiere');
    }

    // Construir la URL


    $url = "{$conexion->url}ADInterface/services/rest/model_adservice/query_data?{$conexion->token}=";
   
    // Definir el cuerpo de la solicitud
    $body = [
        "ModelCRUDRequest" => [
            "ModelCRUD" => [
                "serviceType" => "getProductAPP",
            ],
            "ADLoginRequest" => [
                "user"        => $conexion->user,
                "pass"        => $conexion->password,
                "lang"        => $conexion->ad_language,
                "ClientID"    => $conexion->ftu_app_client_id,
                "RoleID"      => $conexion->ftu_app_role_id,
                "OrgID"       => $conexion->ftu_app_org_id,
                "WarehouseID" => $conexion->ftu_app_warehouse_id,
                "stage"       => 9
            ]
        ]
    ];  
  

    // Crear un cliente de Guzzle
    $client = new \GuzzleHttp\Client();

    try {
        // Realizar la solicitud HTTP
        $response = $client->post($url, [
            'json'    => $body,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'verify'  => false,  // Desactiva la verificación SSL (solo en desarrollo)
        ]);

        $responseBody = json_decode($response->getBody()->getContents());

        return response()->json($responseBody);

    } catch (RequestException $e) {
        return response()->json(['error' => 'Error en la solicitud: ' . $e->getMessage()], 500);
    }
}
}