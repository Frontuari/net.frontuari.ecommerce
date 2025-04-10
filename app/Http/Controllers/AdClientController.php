<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdClientId;

class AdClientController extends Controller
{
    function index() {
        $AdC = AdClientId::where("id",1)->first();

        return view("cart",[
            $adClient = AdClientId::where("id", 1)->first()
            ]);
    }
}
