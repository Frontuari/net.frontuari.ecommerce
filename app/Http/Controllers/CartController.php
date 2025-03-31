<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coin;
use App\Transporte;

class CartController extends Controller
{
    function index() {
        $Coin = Coin::where("id",1)->first();
        $Transporte = Transporte::where("id",2)->first();
        
        return view("cart",[
            "tasa_dolar"=>$Coin->rate,
            "peso"=>$Transporte["peso_max"],
            "delivery"=>$Transporte["price"],
            "delivery_max_price"=>$Transporte["delivery_max_price"]
            ]);
    }
}
