@extends('voyager::master')

@section('content')
<div class="container-fluid">
    <div class="page-content">
        <div class="panel panel-bordered">
            <div class="panel-heading">
                <h1 class="page-title">
                    <i class="voyager-search"></i> Ver Producto
                </h1>
            </div>
            <div class="panel-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" readonly name="name" class="form-control" value="{{ $product->name }}" placeholder="Ingrese el nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="description_short">Descripción Corta:</label>
                        <input type="text" readonly name="description_short" class="form-control" value="{{ $product->description_short }}" placeholder="Ingrese la descripción corta del producto">
                    </div>

                    <div class="form-group">
                        <label for="description" >Descripción:</label>
                        <textarea name="description" readonly class="form-control" placeholder="Ingrese la descripción completa del producto">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Peso Kg:</label>
                        <input type="integer" readonly name="peso" class="form-control" value="{{ $product->peso }}" placeholder="Ingrese el precio del producto">
                    </div>

                    <div class="form-group">
                        <label for="price">Precio:</label>
                        <input type="number" readonly name="price" class="form-control" value="{{ $product->price }}" placeholder="Ingrese el precio del producto">
                    </div>
                    <div class="form-group">
                        <label for="stores_id">Tienda:</label>
                        <select disabled name="stores_id" class="form-control">
                            @foreach($stores as $store)
                            <option value="{{ $store->id }}" {{ $store->id == $product->stores_id ? 'selected' : '' }}>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sub_categories_id">Subcategoría:</label>
                        <select name="sub_categories_id" class="form-control" disabled>
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ $subCategory->id == $product->sub_categories_id ? 'selected' : '' }}>{{ $subCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Imagen:</label>
                        <div id="imagePreviewContainer" class="mt-2" >
                            @if ($product->photo)
                            <img src="{{ $product->photo }}" alt="Producto Imagen" class="img-fluid" width="250px" height="250px">
                            @endif
                        </div>
                    </div>
              
                  
                    <div class="form-group">
                        <label for="qty_avaliable">Cantidad Disponible:</label>
                        <input readonly type="number" name="qty_avaliable" class="form-control" value="{{ $product->qty_avaliable }}" placeholder="Ingrese la cantidad disponible">
                    </div>
                    <div class="form-group">
                        <span for="qty_sold" style="font-weight: bold;">Cantidad Vendida:</span>
                        <input readonly type="number" name="qty_sold" class="form-control" value="{{ $product->qty_sold }}" placeholder="Ingrese la cantidad vendida del producto">
                    </div>
                    
                    <!-- Botones de editar y eliminar -->
                    <div class="form-group">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Eliminar</button>
                    </div>
                    
                    <!-- Modal de confirmación de eliminación -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea eliminar este producto?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Agrega los campos restantes según los requerimientos de tu aplicación -->

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('photo');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');

        photoInput.addEventListener('change', function() {
            imagePreviewContainer.innerHTML = '';

            if (this.files && this.files[0]) {
                const file = this.files[0];

                imageURL = URL.createObjectURL(file);

                const img = document.createElement('img');
                img.src = imageURL;
                img.classList.add('img-thumbnail');
                img.style.width = '350px';
                img.style.height = '250px';
                
                imagePreviewContainer.appendChild(img);
            }
        });
    });
</script>


@endsection
