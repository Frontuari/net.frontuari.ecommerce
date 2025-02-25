<!-- resources/views/products/create.blade.php -->
@extends('voyager::master')

@section('content')
<div class="container-fluid">
    <div class="page-content">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h1 class="page-title">
                    <i class="voyager-basket"></i> Crear Nuevo Producto
                </h1>
            </div>
            <div class="panel-body">
              
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="description_short">Descripción Corta:</label>
                        <input type="text" name="description_short" class="form-control" placeholder="Ingrese la descripción corta del producto">
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea name="description" class="form-control" placeholder="Ingrese la descripción completa del producto"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="peso">Peso Kg:</label>
                        <input type="integer" name="peso" class="form-control" placeholder="Ingrese el peso del producto"  value="0.00">
                    </div>
                    <div class="form-group">
                        <label for="price">Precio $:</label>
                        <input type="integer" name="price" class="form-control" placeholder="Ingrese el precio del producto" value="0.00">
                    </div>
                    {{-- <div class="form-group">
                        <label for="discount">Descuento %</label>
                        <input type="integer" name="discount" class="form-control" placeholder="Ingrese el precio del producto" value="0">
                    </div> --}}
                    <div class="form-group">
                        <label for="stores_id">Tienda:</label>
                        <select name="stores_id" class="form-control select2">
                            @foreach($stores as $store)
                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keyword">Palabras Claves</label>
                        <input type="integer" name="keyword" class="form-control" placeholder="Ejemplo: salsa, liquido, rojo, vidrio" >
                    </div>
                    <div class="form-group">
                        <label for="sub_categories_id">Subcategoría:</label>
                        <select name="sub_categories_id" class="form-control select2">
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="taxes">Impuesto para Productos:</label>
                        <select name="taxes[]" class="form-control select2">
                                @foreach($taxes as $tax)
                                <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                            @endforeach
                        </select>
                    </div>
                 
                    <div class="form-group">
                        <label for="photo">Imagen:</label>
                        <input  type="file" id="photo" name="photo" class="form-control-file">
                        <div id="imagePreviewContainer" class="mt-2"></div>

                    </div>
              
                  
                    <div class="form-group">
                        <label for="qty_avaliable">Cantidad Disponible:</label>
                        <input type="number" name="qty_avaliable" class="form-control" placeholder="Ingrese la cantidad disponible">
                    </div>
                    
                    
                    <!-- Agrega los campos restantes según los requerimientos de tu aplicación -->

                    <button type="submit" class="btn btn-primary">Crear Producto</button>
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
<script>
    // Cerrar automáticamente el mensaje de éxito después de 3 segundos
    setTimeout(function() {
        document.querySelector('.alert').style.display = 'none';
    }, 3000);
</script>

@endsection
