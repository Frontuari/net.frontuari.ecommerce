<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ProductService
{
    public function insertProducts(array $productsData)
    {
        $insertData = [];

        foreach ($productsData as $product) {
            $insertData[] = [
                'name'          => $product['name'],
                'description'   => $product['name'], // Ajustar si es necesario
                'price'         => $product['price'],
                'qty_available' => $product['quantity'],
                'qty_view'      => $product['quantity_sold'] ?? 0, // Si no existe, poner 0 por defecto
                'm_productId'   => $product['m_product_id'],
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }

        // Insertar todos los productos en la base de datos
        DB::table('products')->insert($insertData);

        return ['message' => 'Productos insertados correctamente'];
    }
}