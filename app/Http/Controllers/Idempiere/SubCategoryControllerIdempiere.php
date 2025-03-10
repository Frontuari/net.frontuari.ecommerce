<?php

namespace App\Http\Controllers\Idempiere;

use Illuminate\Http\Request;
use App\Services\IdempiereQuery;
use App\Services\IdempiereService;
use App\Http\Controllers\Controller; 

class SubCategoryControllerIdempiere extends Controller
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
        $subCategories = $request->all();
    
        if (empty($subCategories)) {
            return response()->json(['error' => 'No hay productos para insertar'], 400);
        }
    
        // Insertar los productos en la base de datos
        $this->IdempiereQuery->insertSubCategorie($subCategories);
    
        // Opcional: Retornar confirmación o simplemente terminar la ejecución
        return response()->json(['message' => 'SubCategorias insertados correctamente']);
    }


}