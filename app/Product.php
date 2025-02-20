<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Filters\Filterable;
use App\Orders;

class Product extends Model
{

    use Filterable;

    public function orden()
    {
        
        return $this->belongsTo(Orders::class);

    }

    protected $table = 'products';
    protected $fillable = ['id', 'EAN', 'brands_id', 'description', 'description_short','discount','keyword','name','price','sub_categories_id','promote','qty_avaliable','qty_sold','qty_view','qty_max','qty_min','record','status','stores_id','photo'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->perPage = request()->input('show') ?? 50;
    }
    public function subcategories() {
        return $this->belongsTo('App\SubCategories', 'sub_categories_id')->select('name');
    }
    

    public function stores() {
        return $this->belongsTo('App\Store');
    }
    
    public function brands()
    {
		return $this->belongsTo('App\Brand');
	}

    public function taxes()
    {
        return $this->hasMany('App\ProductTax');
    }

    public function packages()
    {
        return $this->belongsToMany(Packages::class, 'DetProductPackages', 'products_id', 'packages_id')
                    ->withPivot('cant'); // Incluye la cantidad en la relación
    }
}
