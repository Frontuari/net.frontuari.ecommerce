<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiRapidaController extends Controller
{
    public function callName()
    {
        $client_id = DB::select("SELECT * FROM ad_client_id");

        return response()->json($client_id);
    }
}