@extends('voyager::master')

@section('content')
    <div class="page-content container-fluid">
        <h1>Productos desde iDempiere</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach(json_decode(file_get_contents(url('/idempiere/products')))->ModelCRUDResponse->ModelCRUD->DataRow->field as $product)
                    <tr>
                        <td>{{ $product->ID }}</td>
                        <td>{{ $product->Name }}</td>
                        <td>{{ $product->Price }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
