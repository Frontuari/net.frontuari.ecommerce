<?php

namespace App\Http\Controllers\Idempiere;

use Illuminate\Http\Request;
use App\Services\IdempiereQuery;
use App\Services\IdempiereService;
use App\Http\Controllers\Controller; 

//A nivel de codigo este es para el COIN en el Ecommerce


class rateControllerIdempiere extends Controller
{
    protected $IdempiereQuery;
    protected $idempiereService;

    public function __construct(IdempiereQuery $IdempiereQuery, IdempiereService $idempiereService)
    {
        $this->IdempiereQuery = $IdempiereQuery;
        $this->idempiereService = $idempiereService;
    }

    public function store(Request $request)
    {
        $coins = $request->all();

        if (empty($coins)) {
            return response()->json(['error' => 'No hay rate para insertar'], 400);
        }

        $this->IdempiereQuery->insertCoin($coins);

        return response()->json(['message' => 'rate Conversion insertados correctamente']);
    }
}