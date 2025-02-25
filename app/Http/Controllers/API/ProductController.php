<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Product;
use App\Filters\ProductFilters;
use Validator;
use App\Http\Resources\Product as ProductResource;
use Illuminate\Support\Facades\DB;
use App\Stores;
use App\SubCategories;
use App\Favorites;
use App\UserVisitProducts;
use App\Tax;


class ProductController extends BaseController
{

   


    public function index(Request $request,ProductFilters $filters)
    {
        $data = $request->all();
        $limit = ($data["limit"] ?? 10);
        
        $Products = Product::filter($filters)
        ->select("products.*",DB::raw("(case when products.mark_keyword is not null then concat (products.name, ' <span class=\"oferta\">',products.mark_keyword,'</span>') end) as name_insuperable"),DB::raw("taxes.value as impuesto"),DB::raw("( (products.price * taxes.value / 100) + products.price) as calculado, ((products.qty_avaliable * products.porc_stock) / 100) as qty_avaliable"))
        ->leftJoin("det_product_taxes","det_product_taxes.products_id","=","products.id")
        ->leftJoin("taxes","taxes.id","=","det_product_taxes.taxes_id")
        ->where('products.status','A')
        ->where(DB::raw("((products.qty_avaliable * products.porc_stock) / 100)"),">",0)
        ->groupBy("products.id","taxes.value")
        ->paginate($limit);

        // dd($Products->toSql());

        return $this->sendResponse($Products, 'Product retrieved successfully.');
    }

    public function show($id)
    {
        $Product = Product::find($id);

        if (is_null($Product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($Product), 'Product retrieved successfully.');
    }

    public function search($name)
    {
        $texto=mb_strtolower($name);
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

        $Product =  DB::table('products')
        ->select("products.*")
        ->leftJoin("det_product_taxes","det_product_taxes.products_id","=","products.id")
        ->leftJoin("taxes","taxes.id","=","det_product_taxes.taxes_id")
        ->where("products.status","A")
        ->where("products.qty_avaliable",">",0)
        ->whereRaw("( ( to_tsvector(products.name) @@ to_tsquery('$otro') OR to_tsvector(products.keyword) @@ to_tsquery('$otro') ) OR (products.keyword ilike '%$otro%' OR products.name ilike '%$otro%') )")
        ->groupBy("products.id")
        ->orderBy("products.name")
        ->take(10)
        ->get();

        // dd($Product->toSql());

        if (is_null($Product)) {
            return $this->sendError('Product not found.');
        }
        return $this->sendResponse($Product, 'Product retrieved successfully.');
    }

    public function most_recent()
    {
        $Products = Product::where('status','A')->orderBy('created_at','desc')->take(10)->get();
        return $this->sendResponse(ProductResource::collection($Products), 'Product retrieved successfully.');
    }
    public function most_viewed()
    {
        $Products = Product::where('status','A')->orderBy('qty_view','desc')->take(10)->get();
        return $this->sendResponse(ProductResource::collection($Products), 'Product retrieved successfully.');
    }

    public function most_sold()
    {
        $Products = Product::where('status','A')->orderBy('qty_sold','desc')->take(10)->get();
        return $this->sendResponse(ProductResource::collection($Products), 'Product retrieved successfully.');
    }

    public function best_price()
    {
        $Products = Product::where('status','A')->orderBy('price','asc')->take(10)->get();
        return $this->sendResponse(ProductResource::collection($Products), 'Product retrieved successfully.');
    }

    public function getTags() {
        $data = Product::select(DB::raw("DISTINCT trim(keyword) as key"))->where('status','A')->whereNotNull('keyword')->take(10)->get();
        $keywords = [];
        foreach($data as $i => $d) {
            $tmp = explode(" ", $d->key);
            foreach($tmp as $j => $t) {
                array_push($keywords, trim($t));
            }
        }
        $keywords = array_values(array_unique($keywords));
        return $this->sendResponse($keywords);
    }

    public function bysku($sku = null){
        
        $data = Product::where('sku','=',$sku)->get();

        return response()->json($data);
    }

            public function getProduct($id)
        {
            $product = Product::findOrFail($id);
            $stores = Stores::all();
            $subCategories = SubCategories::all();
            return view('products.detalle', compact('product','stores','subCategories'));
        }

        public function edit($id)
        {
            // Buscar el producto por su ID
            $product = Product::findOrFail($id);
    
            // Obtener todas las tiendas y subcategorías para el formulario de edición
            $stores = Stores::all();
            $subCategories = SubCategories::all();
            $taxes = Tax::all(); 
    
            // Cargar la vista de edición con los datos del producto y las opciones de tiendas y subcategorías
            return view('products.edit', compact('product', 'stores', 'subCategories','taxes'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description_short' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'stores_id' => 'required|exists:stores,id',
                'sub_categories_id' => 'required|exists:sub_categories,id', 
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Regla de validación para la foto
                'taxes.*' => 'exists:taxes,id',
            ]);

          
        
            // Encontrar el producto a actualizar por su ID
            $product = Product::findOrFail($id);
        
            // Actualizar los campos del producto
            $product->name = $request->name;
            $product->description_short = $request->description_short;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->peso = $request->peso;
            $product->stores_id = $request->stores_id;
            $product->discount= $request->discount;
            $product->keyword=$request->keyword;
            $product->sub_categories_id = $request->sub_categories_id;
            $product->qty_avaliable = $request->qty_avaliable;
        
            // Actualizar la foto si se proporciona una nueva
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoPath = $photo->store('public/products');
                $photoUrl = \Illuminate\Support\Facades\Storage::url($photoPath);
                $product->photo = $photoUrl;
            }
        
            // Guardar los cambios en la base de datos
            $product->save();

            if ($request->has('taxes')) {
                
                $product->taxes()->sync($request->taxes);
            }
        
            // Redireccionar de vuelta con un mensaje de éxito
            return redirect()->back()->with('success', '¡Producto actualizado exitosamente!');
        }
        public function destroy(Product $product)
        {
            // Verificar si el producto está agregado a favoritos
            if ($this->isProductInFavorites($product->id)) {
                // Mostrar un mensaje indicando que el producto está agregado a favoritos
                return back()->with('error', 'Este producto está agregado a favoritos y no se puede eliminar');
            } else {
                // Intentar eliminar el producto
                try {

                    UserVisitProducts::where('user_visit_products.products_id', $product->id)->delete();

                    $product->delete();
                    
                } catch (\Throwable $th) {
                    
                    return back()->with('error', 'No se puede eliminar este producto porque está asociado a órdenes existentes.');


                }
                // Redirigir a alguna otra página o mostrar un mensaje de éxito
                return back()->with('success', 'Producto eliminado correctamente');
            }
        }
        
        private function isProductInFavorites($productId) {
            // Verificar si hay registros en la tabla de favoritos que hagan referencia al producto
            return Favorites::where('favorites.products_id', $productId)->exists();
        }
}
