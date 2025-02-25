<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxes';

      public function products()
    {
        return $this->belongsToMany(Product::class, 'det_product_taxes', 'taxes_id', 'products_id');
    }
}
