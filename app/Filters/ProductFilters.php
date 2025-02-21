<?php

namespace App\Filters;

use App\Product;
use Illuminate\Http\Request;

class ProductFilters extends QueryFilters
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        parent::__construct($request);
    }

    public function id($id) {
        if(isset($id) && !empty($id) && $id > 0)
            return $this->builder->where("products.id",$id);
    }

    public function cat($id) {
        if(isset($id) && !empty($id) && $id > 0) {
            return $this->builder->join("sub_categories","sub_categories.id","=","products.sub_categories_id")->where('sub_categories.categories_id','=',$id)->groupBy("products.id");
        }
    }

    public function search($term) {
        if(isset($term) && !empty($term)){

            $texto=mb_strtolower($term);
            $arr=explode(' ',$texto);
            $otro='';
            if(count($arr)>1){
                foreach($arr as $s){
                    $otro.="$s&";
                }
                $otro=rtrim($otro,'&');
            }else{
                $otro=$texto;
            }

            return $this->builder->whereRaw("( (to_tsvector(products.keyword) @@ to_tsquery('$otro') OR to_tsvector(products.name) @@ to_tsquery('$otro')) OR (products.keyword ilike '%$otro%' OR products.name ilike '%$otro%'))");
        }
    }

    public function tags($term) {
        if(isset($term) && !empty($term)){

            $texto=mb_strtolower($term);
            $arr=explode(' ',$texto);
            $otro='';
            if(count($arr)>1){
                foreach($arr as $s){
                    $otro.="#$s|";
                }
                $otro=rtrim($otro,'|');
            }else{
                $otro="#".$texto;
            }

            return $this->builder->whereRaw("to_tsvector(products.keyword) @@ to_tsquery('$otro')");
        }
    }

    public function precio($precio) {
        $arr = explode(",",$precio);
        $min = $arr[0];
        $max = $arr[1];
        return $this->builder->whereRaw('(price / (select rate from coins where id = ?)) > ? and (price / (select rate from coins where id = ?)) < ?',[1,$min,1,$max]);
    }
  
    public function order($type) {
        if($type == "AZasc" || $type=="ZAdesc") {
            return $this->builder->orderBy('products.name', (!$type || $type == 'ZAdesc') ? 'desc' : 'asc');
        }else if ($type == "Pasc" || $type=="Pdesc"){
            return $this->builder->orderBy('products.price', (!$type || $type == 'Pdesc') ? 'desc' : 'asc');
        }
    }

    public function mr($term = null) {
        return $this->builder->orderBy('products.created_at','desc');
    }

    public function mb($term = null) {
        return $this->builder->orderBy('products.qty_view','desc');
    }

    public function mv($term = null) {
        return $this->builder->orderBy('products.qty_sold','desc');
    }

    public function mj($term = null) {
        return $this->builder->orderBy('products.price','asc');
    }

}