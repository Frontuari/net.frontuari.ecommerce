@extends('voyager::master')

@section('content')
<div class="container-fluid">
    <h1 class="page-title">
        <i class="voyager-basket"></i> Productos
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Listado de Productos</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <!-- Formulario de búsqueda -->
                    
                        

                      
                        <form method="GET" action="{{ route('voyager.products.index') }}">
                         
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="text" name="search" class="form-control" placeholder="Nombre" value="{{ request()->input('search') }}">
                                </div>
                                <div class="col-md-6">
                                 
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Crear Producto</a>
                                </div>
                            </div>
                        </form>
                        <table id="dataTable" class="table table-hover dataTable no-footer" role="grid">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción Corta</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Sub Categoría</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description_short }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->subcategories }}</td>

                                    <td>
                                        <a href="{{ route('products.detalle', $product->id) }}" class="btn btn-sm btn-primary">Ver</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Paginación -->
                        <div class="d-flex justify-content-center">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection