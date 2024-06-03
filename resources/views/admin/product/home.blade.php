<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="mb-0">Listado de Productos</h1>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Añadir Producto</a>
                    </div>
                    <hr />
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Descripcion</th>
                                <th>Stock</th>
                                <th>Categoría</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $product->name }}</td>
                                    <td class="align-middle">{{ $product->price }}</td>
                                    <td class="align-middle">{{ $product->description }}</td>
                                    <td class="align-middle stock-cell
                                        @if($product->stock == 0)
                                            bg-danger
                                        @elseif($product->stock >= 1 && $product->stock <= 9)
                                            bg-warning
                                        @elseif($product->stock >= 10 && $product->stock <= 19)
                                            bg-yellow
                                        @elseif($product->stock >= 20)
                                            bg-success
                                        @endif
                                    ">
                                        {{ $product->stock }}
                                    </td>
                                    <td class="align-middle">{{ $product->category ? $product->category->name : 'Sin Categoría' }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin/products/edit', ['id'=>$product->id]) }}" type="button" class="btn btn-secondary">Editar</a>
                                            <a href="{{ route('admin/products/delete', ['id'=>$product->id]) }}" type="button" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas borrar este producto?')">Borrar</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">Producto no encontrado</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
