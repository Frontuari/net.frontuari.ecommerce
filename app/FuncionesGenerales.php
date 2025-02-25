<?php
namespace App;

class FuncionesGenerales{

    public function get_formato_moneda($value){
        return number_format($value, 4, ',', '.');
    }
    public function set_formato_moneda($value){
        $listo=null;
        $patróna = '/[\s]/';
        $patrón = '/[,\.]/';
        $va=preg_replace($patróna,"",trim($value));
        $va=preg_replace($patrón," ",$va);
        $arr=explode(" ",$va);
        $total=count($arr);
        if($total>1){
            $arr[$total-1]=".".$arr[$total-1];
            foreach($arr as $valor) $listo.=$valor;
        }else{

            $listo=$va;
        }
       
        return $listo;
    }


}

?>