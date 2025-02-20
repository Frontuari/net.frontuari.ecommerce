<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    protected $table = 'product_packages';
    protected $fillable = ['package_id', 'product_id', 'quantity'];

    public function package()
    {
        return $this->belongsTo(Packages::class, 'package_id', 'id');
    }
}