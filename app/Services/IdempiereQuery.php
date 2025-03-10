<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class IdempiereQuery
{
    public function insertProducts(array $productsData)
    {
        $insertData = [];
    
        foreach ($productsData as $product) {
            $insertData[] = [
                'id'          => $product['m_product_id'],
                'name'          => $product['name'],
                'description_short'   => $product['name'], // Ajustar si es necesario
                'description'   => $product['name'], // Ajustar si es necesario
                'price'         => $product['price'],
                'm_product_id'  => $product['m_product_id'],
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }
    
        // Usar upsert para insertar o actualizar si el m_product_id ya existe
        DB::table('products')->upsert(
            $insertData,
            ['id'],  // Clave única para evitar duplicados
            ['name', 'description', 'price', 'updated_at'] // Columnas a actualizar si ya existe
        );
    
        return ['message' => 'Productos insertados o actualizados correctamente'];
    }

    public function insertTax(array $taxData)
    {
       
        $insertData = [];
    
        foreach ($taxData as $datas) {
            $insertData[] = [
                'id'          => $datas['c_tax_id'],
                'name'          => $datas['name'],
                'short_name'   =>$datas['name'],
                'value'         => $datas['rate'],
                'c_tax_category_id'  => $datas['c_tax_category_id'],
                'created_at'    => now(),
                'updated_at'    => now(),
                'iswithholding'  => $datas['iswithholding'],
                'status' => 'A',
                'tax_indicator'  => $datas['tax_indicator']
                
            ];
        }
    
        // Usar upsert para insertar o actualizar si el m_product_id ya existe
        DB::table('taxes')->upsert(
            $insertData,
            ['id'],  // Clave única para evitar duplicados
            ['name', 'short_name', 'tax_indicator','value', 'updated_at','c_tax_category_id','iswithholding'] // Columnas a actualizar si ya existe
        );
    
        return ['message' => 'Taxes insertados o actualizados correctamente'];
    }

    public function insertCoin(array $coinData)
    {
        $insertData = [];

    
        foreach ($coinData as $datas) {
            $insertData[] = [
                'id' =>  $datas['C_Currency_ID_To'],
                'name'  => $datas['name'],
                'symbol'  => $datas['symbol'],
                'rate'  => $datas['rate'],
                'created_at'    => now(),
                'updated_at'    => now(),
                'status' => 'A',
            
                
            ];
        }
    
        // Usar upsert para insertar o actualizar si el m_product_id ya existe
        DB::table('coins')->upsert(
            $insertData,
            ['id'],  // Clave única para evitar duplicados
            ['name' ,'symbol', 'rate', 'updated_at'] // Columnas a actualizar si ya existe
        );
    
        return ['message' => 'Coin insertados o actualizados correctamente'];
    }

    public function insertCategorie(array $insertCategorie)
    {
        $insertData = [];

    
        foreach ($insertCategorie as $datas) {
            $insertData[] = [
                'id' =>  $datas['idCategory'],
                'name'  => $datas['name'],
                'created_at'    => now(),
                'updated_at'    => now(),
                'status' => $datas['status'],
                'adulto' => 'N',
            ];
            //Adulto es Y
        }
    
        // Usar upsert para insertar o actualizar si el m_product_id ya existe
        DB::table('categories')->upsert(
            $insertData,
            ['id'],  // Clave única para evitar duplicados
            ['name' , 'updated_at','status','adulto'] // Columnas a actualizar si ya existe
        );
    
        return ['message' => 'Category insertados o actualizados correctamente'];
    }

    public function insertSubCategorie(array $insertSubCategorie)
    {
        $insertData = [];
    
        foreach ($insertSubCategorie as $datas) {
            $insertData[] = [
                'id' =>  $datas['ID_SubCategory'],
                'name'  => $datas['name'],
                'created_at'    => now(),
                'updated_at'    => now(),
                'status' => $datas['status'],
                'categories_id'=> $datas['ID_Category']
            ];
            //Adulto es Y
        }
    
        // Usar upsert para insertar o actualizar si  ya existe
        DB::table('sub_categories')->upsert(
            $insertData,
            ['id'],  // Clave única para evitar duplicados
            ['name' , 'updated_at','status','categories_id'] // Columnas a actualizar si ya existe
        );
    
        return ['message' => 'SubCategory insertados o actualizados correctamente'];
    }

    public function insertStore(array $insertStore)
    {
        $insertData = [];

        foreach ($insertStore as $datas) {
            $insertData[] = [
                'id' =>  $datas['ID_Store'],
                'name'  => $datas['name'],
                'nro_tienda'  => $datas['ID_Store'],
                'logo'  => $datas['logo'],
                'created_at'    => now(),
                'updated_at'    => now(),
                'status' => $datas['status'],
                'is_principal'=> true
            ];
            //Adulto es Y
        }
    
        // Usar upsert para insertar o actualizar si  ya existe
        DB::table('stores')->upsert(
            $insertData,
            ['id'],  // Clave única para evitar duplicados
            ['name' , 'updated_at','status','logo','nro_tienda','is_principal'] // Columnas a actualizar si ya existe
        );
    
        return ['message' => 'Stores insertados o actualizados correctamente'];
    }




}

