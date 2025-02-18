<!-- resources/views/products/edit.blade.php -->
@extends('voyager::master')

@section('content')
<div class="container-fluid">
    <div class="page-content">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h1 class="page-title">
                    <i class="voyager-edit"></i> Editar Producto
                </h1>
            </div>
            <div class="panel-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" placeholder="Ingrese el nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="description_short">Descripción Corta:</label>
                        <input type="text" name="description_short" class="form-control" value="{{ $product->description_short }}" placeholder="Ingrese la descripción corta del producto">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea name="description" class="form-control" placeholder="Ingrese la descripción completa del producto">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="peso">Peso:</label>
                        <input type="integer" name="peso" class="form-control" value="{{ $product->peso }}" placeholder="Ingrese el peso del producto">
                    </div>

                    <div class="form-group">
                        <label for="price">Precio:</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}" placeholder="Ingrese el precio del producto">
                    </div>
                    <div class="form-group">
                        <label for="stores_id">Tienda:</label>
                        <select name="stores_id" class="form-control">
                            @foreach($stores as $store)
                            <option value="{{ $store->id }}" {{ $store->id == $product->stores_id ? 'selected' : '' }}>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_categories_id">Subcategoría:</label>
                        <select name="sub_categories_id" class="form-control">
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->sub_categories_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Imagen:</label>
                        <input type="file" id="photo" name="photo" class="form-control-file">
                        <div id="imagePreviewContainer" class="mt-2">
                            @if ($product->photo)
                            <img src="{{ $product->photo }}" alt="Producto Imagen" class="img-fluid" width="250px" height="250px">
                            @endif
                        </div>
                    </div>
              
                  
                    <div class="form-group">
                        <label for="qty_avaliable">Cantidad Disponible:</label>
                        <input type="number" name="qty_avaliable" class="form-control" value="{{ $product->qty_avaliable }}" placeholder="Ingrese la cantidad disponible">
                    </div>
                    
                    
                    <!-- Agrega los campos restantes según los requerimientos de tu aplicación -->

                    <button type="submit" class="btn btn-primary">Guardar Cambios?</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Variable global para almacenar la URL de la imagen
    let imageURL = '';

    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photo');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');

        photoInput.addEventListener('change', function() {
            // Limpiar cualquier imagen anterior en el contenedor de vista previa
            imagePreviewContainer.innerHTML = '';

            // Verificar si se seleccionó un archivo
            if (this.files && this.files[0]) {
                const file = this.files[0];

                // Crear un objeto URL para representar el archivo seleccionado como un enlace
                imageURL = URL.createObjectURL(file);

                // Crear una etiqueta img y establecer su atributo src con la URL del archivo
                const img = document.createElement('img');
                img.src = imageURL;
                img.classList.add('img-thumbnail');
                img.style.width = '350px';
                img.style.height = '250px';
                // Agregar la imagen al contenedor de vista previa
                imagePreviewContainer.appendChild(img);
            }
        });
    });

    // Función para utilizar la URL de la imagen
  
</script>



@endsection
