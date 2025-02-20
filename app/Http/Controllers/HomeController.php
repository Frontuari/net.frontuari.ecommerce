<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coin;
use App\Advs;
use App\ProductCategory;
use App\Product;
use App\Packages;
use App\Pages;
use Illuminate\Support\Facades\DB;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    function cambiarBarra($data) {
        return str_replace("\\", "/", $data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Coin = Coin::where("id",1)->first();
        
        $Slider = Advs::where('status','A')->whereRaw('LOWER(type) LIKE ?', [trim(strtolower("top")).'%'])->orderBy('order','ASC')->get();

        $Medio_Bajo = [];
        $Med = Advs::where('status','A')->whereRaw('LOWER(type) LIKE ?', [trim(strtolower("medio_bajo")).'%'])->orderBy('order','ASC')->get();
        foreach ($Med as $i => $m) {
            $m["image"] = $this->cambiarBarra($m["image"]);
            array_push($Medio_Bajo, $m);
        }
        $Medio_Bajo = json_encode($Medio_Bajo);

        $footer = [];
        $foot = Advs::where('status','A')->whereRaw('LOWER(type) LIKE ?', [trim(strtolower("footer")).'%'])->orderBy('order','ASC')->get();
        foreach ($foot as $i => $f) {
            $f["image"] = $this->cambiarBarra($f["image"]);
            array_push($footer, $f);
        }
        $footer = json_encode($footer);

        $Categories = [];
        $Cat = ProductCategory::where('status','A')->orderBy("order","asc")->take(4)->get();
        foreach ($Cat as $i => $c) {
            $c["image"] = $this->cambiarBarra($c["image"]);
            array_push($Categories, $c);
        }
        $Categories = json_encode($Categories);

        $MostRecent = Product::where('products.status','A')
        ->where('is_combo',false)
        ->select("products.*",DB::raw("taxes.value as impuesto"),DB::raw("(case when products.mark_keyword is not null then concat (products.name, ' <span class=\"oferta\">',products.mark_keyword,'</span>') end) as name_insuperable"),DB::raw("( (products.price * taxes.value / 100) + products.price) as calculado, ((products.qty_avaliable * products.porc_stock) / 100) as qty_avaliable"))
        ->leftJoin("det_product_taxes","det_product_taxes.products_id","=","products.id")
        ->leftJoin("taxes","taxes.id","=","det_product_taxes.taxes_id")
        ->orderBy('created_at','desc')
        ->where(DB::raw("((products.qty_avaliable * products.porc_stock) / 100)"),">",0)
        ->take(12)
        ->get();

        $MostView = Product::where('products.status','A')
        ->where('is_combo',false)
        ->select("products.*",DB::raw("taxes.value as impuesto"),DB::raw("(case when products.mark_keyword is not null then concat (products.name, ' <span class=\"oferta\">',products.mark_keyword,'</span>') end) as name_insuperable"),DB::raw("( (products.price * taxes.value / 100) + products.price) as calculado, ((products.qty_avaliable * products.porc_stock) / 100) as qty_avaliable"))
        ->leftJoin("det_product_taxes","det_product_taxes.products_id","=","products.id")
        ->leftJoin("taxes","taxes.id","=","det_product_taxes.taxes_id")
        ->orderBy('qty_view','desc')
        ->where(DB::raw("((products.qty_avaliable * products.porc_stock) / 100)"),">",0)
        ->take(12)
        ->get();

        $MostSold = Product::where('products.status','A')
        ->where('is_combo',false)
        ->select("products.*",DB::raw("taxes.value as impuesto"),DB::raw("(case when products.mark_keyword is not null then concat (products.name, ' <span class=\"oferta\">',products.mark_keyword,'</span>') end) as name_insuperable"),DB::raw("( (products.price * taxes.value / 100) + products.price) as calculado, ((products.qty_avaliable * products.porc_stock) / 100) as qty_avaliable"))
        ->leftJoin("det_product_taxes","det_product_taxes.products_id","=","products.id")
        ->leftJoin("taxes","taxes.id","=","det_product_taxes.taxes_id")
        ->orderBy('qty_sold','desc')
        ->where(DB::raw("((products.qty_avaliable * products.porc_stock) / 100)"),">",0)
        ->take(12)
        ->get();

        $BestPrice = Product::where('products.status','A')
        ->where('is_combo',false)
        ->select("products.*",DB::raw("taxes.value as impuesto"),DB::raw("(case when products.mark_keyword is not null then concat (products.name, ' <span class=\"oferta\">',products.mark_keyword,'</span>') end) as name_insuperable"),DB::raw("( (products.price * taxes.value / 100) + products.price) as calculado, ((products.qty_avaliable * products.porc_stock) / 100) as qty_avaliable"))
        ->leftJoin("det_product_taxes","det_product_taxes.products_id","=","products.id")
        ->leftJoin("taxes","taxes.id","=","det_product_taxes.taxes_id")
        ->orderBy('price','asc')
        ->where(DB::raw("((products.qty_avaliable * products.porc_stock) / 100)"),">",0)
        ->take(12)
        ->get();

        $comboData = Packages::where('status','A')->take(8)->orderBy('type','asc')->get();
        $Combos = [];
        
        foreach($comboData as $i => $c) {
            $total = 0;
            $cantTotal = 0;
            /*$c["products"] = DB::table("det_product_packages")
            ->select("products.*","det_product_packages.cant as cant_combo",DB::raw("taxes.value as impuesto"),DB::raw("( (products.price * taxes.value / 100) + products.price) as calculado"))
            ->join("products","products.id","=","det_product_packages.products_id")
            ->leftJoin("det_product_taxes","det_product_taxes.products_id","=","products.id")
            ->leftJoin("taxes","taxes.id","=","det_product_taxes.taxes_id")
            ->where("det_product_packages.packages_id",$c["id"])
            ->get();*/

            $c["products"] = DB::select("select products.*, 
                                det_product_packages.cant as cant_combo, 
                                taxes.value as impuesto, 
                                ( (products.price * taxes.value / 100) + products.price) as calculado
                                , ((products.qty_avaliable * products.porc_stock) / 100) as qty_avaliable
                            from det_product_packages
                            inner join products on products.id = det_product_packages.products_id
                            left join det_product_taxes on det_product_taxes.products_id = products.id
                            left join taxes on taxes.id = det_product_taxes.taxes_id
                            where det_product_packages.packages_id = ".$c["id"]." and ((products.qty_avaliable * products.porc_stock) / 100) >= det_product_packages.cant and products.status = 'A'");
            

                           
            foreach($c["products"] as $j => $p) {
                $cantTotal += $p->cant_combo;
              
                if($p->qty_avaliable >= $p->cant_combo) {
                    if($p->calculado > 0){
                        $total += ($p->calculado * $p->cant_combo);
                    }else {
                        $total += ($p->price * $p->cant_combo);
                    }
                }

            }
            $c["combo_price"] = $total;
            $c["cantTotal"] = $cantTotal;
            array_push($Combos,$c);
        }
        
        $Combos = json_encode($Combos);

        return view("home",[
            "tasa_dolar"=>$Coin->rate,
            "sliders"=>$Slider,
            "categories"=>$Categories,
            "medio_bajo"=>$Medio_Bajo,
            "recent"=>$MostRecent,
            "viewed"=>$MostView,
            "sold"=>$MostSold,
            "bestprice"=>$BestPrice,
            "combos"=>$Combos,
            "footer"=>$footer
        ]);
    }

    public function join() {
        return view("register");
    }
    public function recover() {
        return view("recover");
    }

    public function terminos() {
        $data = Pages::where("id",1)->get();
        return view("terminos",[
            "terms" => $data
        ]);
    }

    public function faq() {
        $data = Pages::where("id",2)->get();
        return view("faq",[
            "faqs" => $data
        ]);
    }

    public function InternationalPaymentButton($nb, $ap, $ci, $nai, $mt, $em, $from = 'desktop'){

        //$post_url = "https://sandbox.123pago.net/msBotonDePago/index.jsp";
        $post_url = "https://totalpos.123pago.net/msBotonDePago/index.jsp";
        /*$post_values = array(
                "nbproveedor" => "BIOMERCADOS",
                "nb" => "$nb",
                "ap" => "$ap",
                "ci" => "$ci",
                "em" => "$em",
                "cs" => "9da3140b284ccb07b35ccfab53381563",
                "nai" => "$nai",
                "co" => "Compra en Tienda Biomercados",
                //"tl" => "02127400012",
                "mt" => "$mt",
                "ancho" => "250px"
            );*/

        $post_values = array(
                "nbproveedor" => "BIOMERCADOS",
                "nb" => "$nb",
                "ap" => "$ap",
                "ci" => "$ci",
                "em" => "$em",
                "cs" => "9da3140b284ccb07b35ccfab53381563",
                "nai" => "$nai",
                "co" => "Compra en Tienda Biomercados",
                //"tl" => "02127400012",
                "mt" => "$mt",
                "ancho" => "250px"
            );

        $post_string = "";

        foreach( $post_values as $key => $value ){ 
            $post_string .= "$key=" . urlencode( $value ) . "&";
        } 

        $post_string = rtrim( $post_string, "& " );

        $request = curl_init($post_url);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($request, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER,FALSE);

        $post_response = curl_exec($request);

        curl_close ($request);
        echo $post_response;
        if($from == 'desktop'){
            print "<script>";

            print "function callback_button(paymentData){
                parent.getPaymentData(paymentData);
            }";

            print 'function createPayment(){
                        parent.successPayment();
                    }';
            print "</script>";
        }else{
            print "<script>";
                print "localStorage.setItem('orderno','".$nai."')";
            print "</script>";
        }
    }

    public function url_despedida(Request $request){
        return view('thanks');
    }

    public function getdataresponse($orderno = null){
        $data = file_get_contents(url('/tmp_responses/'.$orderno.".txt"));
        return response()->json($data);
    }
}