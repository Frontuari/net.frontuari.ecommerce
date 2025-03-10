<?php

namespace App\Http\Controllers\Idempiere;

use Illuminate\Http\Request;
use App\Services\IdempiereQuery;
use App\Services\IdempiereService;
use App\Http\Controllers\Controller; 

class StoresControllerIdempiere extends Controller
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
        $stores = $request->all();
    
        if (empty($stores)) {
            return response()->json(['error' => 'No hay productos para insertar'], 400);
        }
    
        // Insertar los productos en la base de datos
        $this->IdempiereQuery->insertStore($stores);
    
        // Opcional: Retornar confirmación o simplemente terminar la ejecución
        return response()->json(['message' => 'Stores insertados correctamente']);
    }


}