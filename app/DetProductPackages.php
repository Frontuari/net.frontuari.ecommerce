<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetProductPackages extends Model
{
    protected $table = 'det_product_packages';
    protected $fillable = ['cant', 'packages_id', 'products_id'];
    public $timestamps = false;



    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    
}
