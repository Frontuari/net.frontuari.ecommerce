<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\IdempiereConection;

class IdempiereService
{
    private $connection;

    public function __construct()
    {
        $this->connection = IdempiereConection::first();
    }

    public function fetchDataFromIdempiere($serviceType, $limit = 10)
    {
        return [
            "ModelCRUDRequest" => [
                "ModelCRUD" => [
                    "serviceType" => $serviceType,
                
                ],
                "ADLoginRequest" => [
                    "user" => $this->connection->user,
                    "pass" => $this->connection->password,
                    "lang" => "es_VE",
                    "ClientID" => $this->connection->client_id,
                    "RoleID" => $this->connection->role_id,
                    "OrgID" => $this->connection->org_id,
                    "WarehouseID" => $this->connection->warehouse_id,
                    "stage" => 9
                ]
            ]
        ];
    }

    public function getMultipleData()
    {
        // Definir las consultas que se ejecutarán simultáneamente
        $endpoints = [
            'products' => 'getProductAPP'
        ];

        $requests = [];
        foreach ($endpoints as $key => $serviceType) {
            dd($endpoints);
            $requests[$key] = Http::async()->withHeaders([

               
                'Content-Type' => 'application/json'
            ])->post($this->connection->url . 'ADInterface/services/rest/model_adservice/query_data', 
                $this->fetchDataFromIdempiere($serviceType)
            );
      
        }



        // Ejecutar todas las solicitudes en paralelo
        $responses = Http::pool(fn ($pool) => collect($requests)->map(fn ($req) => $pool->add($req)));

        // Retornar respuestas
        return [
            'products' => $responses['products']->json(),

        ];
    }
}
