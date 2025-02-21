<?php

namespace App\Http\Controllers;

use App\Packages;
use App\DetProductPackages;
use Illuminate\Http\Request;


class PackagesController extends VoyagerBreadController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

     //VALIDACION DE CREACION DE PAQUETES
     public function store(Request $request)
{
    // Verificar qué datos están llegando (depuración)
    // dd($request->all()); // Verificar que la imagen esté en la solicitud

    // Convertir el descuento a formato decimal correcto
    $discount = str_replace(',', '.', $request->input('discount'));

    // Asegúrate de que el descuento esté correctamente formateado
    if (is_numeric($discount)) {
        $discount = floatval($discount);
    } else {
        $discount = 0;  // Asigna 0 si el valor no es válido
    }

    // Preparar los datos para guardar
    $data = [
        'name' => $request->input('name'),
        'discount' => $discount,
        'type' => $request->input('type'),
        'status' => $request->input('status'),
    ];

 

    // Manejo de la imagen
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('packages/' . now()->format('FYm'), 'public');

        // Verificar si la imagen se guardó correctamente
        // dd($imagePath);  // Verificar que la ruta se ha generado correctamente
        if ($imagePath) {
            $data['image'] = $imagePath;  // Guardar la ruta de la imagen
        } else {
            dd('Error al guardar la imagen');
        }
    }

   

    // Insertar el paquete en la base de datos
    $package = Packages::create($data);

    // Verificar si la creación fue exitosa
    if ($package) {
        // Verificar si hay productos para insertar en `det_product_packages`
        if ($request->has('package_belongstomany_product_relationship')) {
            foreach ($request->package_belongstomany_product_relationship as $productId) {
                DetProductPackages::create([
                    'cant' => $request->cantidad[$productId] ?? 0, // Cantidad del producto
                    'packages_id' => $package->id, // ID del paquete recién creado
                    'products_id' => $productId, // ID del producto
                ]);
            }
        }

        return redirect()->route('voyager.packages.index')->with('success', 'Paquete creado con éxito');
    } else {
        return back()->with('error', 'No se pudo crear el paquete');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function show($table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function edit($table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Packages  $packages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Obtener el paquete a actualizar
        try {
            // Obtener el paquete a actualizar
            $package = Packages::findOrFail($id);
        
            // Si se proporciona una nueva imagen, guarda la imagen y actualiza la ruta en el paquete
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('packages/' . now()->format('FYm'), 'public'); // Guardar la imagen en el directorio publico con un nombre único
                $package->image = $imagePath; // Asigna la ruta de la imagen al atributo 'image' del paquete
            }
        
            // Actualizar los datos del paquete con los datos recibidos por la solicitud
            $package->name = $request->name;
            $package->stores_id = $request->stores_id;
            $package->discount = $request->discount;
            $package->type = $request->type;
            $package->status = $request->status;
            // Guardar los cambios en el paquete
            $package->save();
        
            // Informar que la actualización fue exitosa
            echo "Los datos del paquete se actualizaron correctamente.";
        } catch (\Exception $e) {
            // Manejar el error
            echo "Se produjo un error al actualizar los datos del paquete: " . $e->getMessage();
        }
        // var_dump($request->package_belongstomany_product_relationship);
    
        // Actualizar los datos en la tabla det_product_packages
        // Primero, eliminamos todos los registros existentes para este paquete
        DetProductPackages::where('packages_id', $package->id)->delete();
    
        // Luego, insertamos los nuevos registros
        if ($request->has('package_belongstomany_product_relationship')) {
            foreach ($request->package_belongstomany_product_relationship as $productId) {

                DetProductPackages::create([
                    'cant' => $request->cantidad[$productId] ?? 0,
                    'packages_id' => $id,
                    'products_id' => $productId,
                ]);
            }
        }
    
        // Redireccionar a la página de edición del paquete actualizado
        return redirect()->route('voyager.packages.edit', $package->getKey())->with('success', 'Package updated successfully');
    }
    

    /**0
     * Remove the specified resource from storage.
     *
     * @param  \App\Packages  $packages
     * @return \Illuminate\Http\Response
     */

     
    public function destroy( $table)
    {
        //
    }



}
