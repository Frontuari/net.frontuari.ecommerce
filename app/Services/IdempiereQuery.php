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
                'name'          => $product['name'],
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
            ['m_product_id'],  // Clave única para evitar duplicados
            ['name', 'description', 'price', 'updated_at'] // Columnas a actualizar si ya existe
        );
    
        return ['message' => 'Productos insertados o actualizados correctamente'];
    }
}