<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetProducTaxes extends Model
{
    protected $table = 'det_product_taxes'; // Nombre exacto de la tabla en la BD
    public $timestamps = false; // Si la tabla no tiene created_at y updated_at

    protected $fillable = ['products_id', 'taxes_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'taxes_id');
    }
}