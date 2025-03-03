<?php

namespace App\Http\Controllers\Idempiere;

use Illuminate\Http\Request;
use App\Services\IdempiereQuery;
use App\Services\IdempiereService;
use App\Http\Controllers\Controller; 

class ProductControllerIdempiere extends Controller
{
    protected $IdempiereQuery;
    protected $idempiereService;

    public function __construct(IdempiereQuery $IdempiereQuery, IdempiereService $idempiereService)
    {
        $this->IdempiereQuery = $IdempiereQuery;
        $this->idempiereService = $idempiereService;
    }

    // Insertar productos en la base de datos
    public function store(Request $request)
    {
        $productsData = $request->all();
    
        if (empty($productsData)) {
            return response()->json(['error' => 'No hay productos para insertar'], 400);
        }
    
        // Insertar los productos en la base de datos
        $this->IdempiereQuery->insertProducts($productsData);
    
        // Opcional: Retornar confirmación o simplemente terminar la ejecución
        return response()->json(['message' => 'Productos insertados correctamente']);
    }


}