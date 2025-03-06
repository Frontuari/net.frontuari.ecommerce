<?php

namespace App\Http\Controllers\Idempiere;

use Illuminate\Http\Request;
use App\Services\IdempiereQuery;
use App\Services\IdempiereService;
use App\Http\Controllers\Controller; 


class TaxControllerIdempiere extends Controller
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
        $taxData = $request->all();

        if (empty($taxData)) {
            return response()->json(['error' => 'No hay impuestos para insertar'], 400);
        }

        $this->IdempiereQuery->insertTax($taxData);

        return response()->json(['message' => 'Impuestos insertados correctamente']);
    }
}