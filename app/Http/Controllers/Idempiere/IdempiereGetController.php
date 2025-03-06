<?php

namespace App\Http\Controllers\Idempiere;

use App\Http\Controllers\Controller; 
use App\IdempiereConnection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\Utils;
use Illuminate\Support\Facades\Auth;
use App\Services\IdempiereService;
use App\Services\IdempiereQuery;
use App\Http\Controllers\Idempiere\ProductControllerIdempiere; 
use App\Http\Controllers\Idempiere\TaxControllerIdempiere; 
use App\Http\Controllers\Idempiere\rateControllerIdempiere; 
use Illuminate\Http\Request;



class IdempiereGetController extends Controller
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
            return response()->json(['error' => 'No se encontró la configuración de conexión a IDempiere'], 500);
        }

        // Construir la URL base
        $url = "{$conexion->url}ADInterface/services/rest/model_adservice/query_data?{$conexion->token}=";

        // Definir los tipos de servicios que queremos consultar
        $serviceTypes = ['getProductAPP', 'getRegionsApp','getRateConversion','getWarehouseAPP','getRegionsApp','getTaxAPP'];

        // Crear un cliente de Guzzle
        $client = new Client();

        // Array para almacenar las promesas de las solicitudes
        $promises = [];

        foreach ($serviceTypes as $serviceType) {
            // Construir el cuerpo de la solicitud con el tipo de servicio actual
            $body = [
                "ModelCRUDRequest" => [
                    "ModelCRUD" => [
                        "serviceType" => $serviceType,
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

            // Agregar la promesa al array
            $promises[$serviceType] = $client->postAsync($url, [
                'json'    => $body,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ],
                'verify'  => false,  // Desactiva la verificación SSL (solo en desarrollo)
            ]);
        }

        // Esperar a que todas las promesas se completen
        $results = Utils::settle($promises)->wait();

        // Procesar las respuestas
        $responses = [];

        foreach ($results as $serviceType => $result) {
            if ($result['state'] === 'fulfilled') {
                $responses[$serviceType] = json_decode($result['value']->getBody()->getContents(), true);
            } else {
                $responses[$serviceType] = [
                    'error' => 'Error en la solicitud: ' . $result['reason']->getMessage()
                ];
            }
        }

        

        $idempiereService = new IdempiereService();
        //Se Descomponen los productos para preparar para la inserccion
        //El funcionamiento es igual al del app movil
        $productsData = $idempiereService->extractProductData($responses);
        $taxData = $idempiereService->extracTaxtData($responses);
        $wareHouseData = $idempiereService->extractWarehouse($responses);
        $coinsConversion = $idempiereService->extractConversion($responses);



        //INSERCCION DE PRODUCTOS
        $productController = new ProductControllerIdempiere(new IdempiereQuery(), $idempiereService); 
        $productController->store(new Request($productsData));  // Inserta automáticamente
        //INSERCCION  DE IMPUESTOS
        $taxController = new TaxControllerIdempiere(new IdempiereQuery(), $idempiereService); 
        $taxController->store(new Request($taxData));  // Inserta impuestos correctamente

        //Inserccion de Monedas
        $coinController = new rateControllerIdempiere(new IdempiereQuery(), $idempiereService); 
        $coinController->store(new Request($coinsConversion));  // Inserta Monedas correctamente



        return response()->json($coinsConversion);

        

        // return response()->json($responses);


 
    }
}