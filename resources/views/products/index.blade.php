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
                        <a href="{{ route('products.create') }}" class="btn btn-success">Crear Producto</a>
                        <table id="dataTable" class="table table-hover dataTable no-footer" role="grid">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción Corta</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Sub Categoria</th> <!-- Nueva columna para las acciones -->

                                    <th>Acciones</th> <!-- Nueva columna para las acciones -->
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
                                    <td>{{ $product->subcategories}}</td> <!-- Cambia esto para mostrar el nombre de la subcategoría -->

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
