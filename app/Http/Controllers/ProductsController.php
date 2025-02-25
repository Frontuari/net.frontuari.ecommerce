<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Stores;
use App\Favorites;
use App\SubCategories;
use App\UserVisitProducts;
use App\Tax;
use Illuminate\Support\Str;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



     public function create()
     {
        
        $stores = Stores::all(); // Obtener todas las tiendas
        $subCategories = SubCategories::all();
        $taxes = Tax::all(); 

        return view('products.create', compact('stores', 'subCategories','taxes'));
     }


     public function store(Request $request)
     {
         $request->validate([
             'name' => 'required|string|max:255',
             'description_short' => 'nullable|string|max:255',
             'description' => 'nullable|string',
             'price' => 'required|numeric',
             'stores_id' => 'required|exists:stores,id',
             'sub_categories_id' => 'required|exists:sub_categories,id', 
             'taxes.*' => 'exists:taxes,id',
             

             // Agrega las reglas de validación para los demás campos según sea necesario
         ]);

          $sku = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);

            // Validar que el SKU sea único en la tabla de productos
            while (Product::where('sku', $sku)->exists()) {
                // Generar un nuevo SKU si el actual ya existe en la base de datos
                $sku = str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
            }

                
     
    
     
         // Crear el producto en la base de datos y guardar la URL de la imagen
         $product = new Product();
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
         $product->sku = $sku; // Asignar el SKU generado al objeto del producto

         
                    if ($request->hasFile('photo')) {

                        $photo = $request->file('photo');
                        $photoPath = $photo->store('public/products');

                        // Obtener la URL completa del archivo almacenado
                        $photoUrl = \Illuminate\Support\Facades\Storage::url($photoPath);

                        // Guardar la URL completa en la columna 'photo' del modelo Product
                        $product->photo = $photoUrl;
                }

           


         $product->save();
         if ($request->has('taxes')) {
            // Sync de impuestos, asegura que los impuestos sean correctamente actualizados
            $product->taxes()->sync($request->taxes);
        }
     
         return back()->with('success', 'Product Created successfully');
         
        }
     

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return view('products.show', compact('product'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Product $product)
    // {
    //     $request->validate([
    //         // Agrega aquí las reglas de validación para los campos de Products
    //     ]);

    //     $product->update($request->all());

    //     return redirect()->route('products.index')
    //         ->with('success', 'Product updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $products
     * @return \Illuminate\Http\Response
     */
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
