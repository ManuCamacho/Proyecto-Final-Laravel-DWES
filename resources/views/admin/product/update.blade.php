<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Editar Producto</h1>
                    <hr />
                    <form action="{{ route('admin/products/update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$product->name}}">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Precio</label>
                                <input type="text" name="price" class="form-control" placeholder="Precio" value="{{$product->price}}">
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Descripcion</label>
                                <input type="text" name="description" class="form-control" placeholder="Descripcion" value="{{$product->description}}">
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="image" id="imageUrl" class="form-control" placeholder="URL de la imagen o subir desde el PC" value="{{ old('image', $product->image) }}">
                                <img id="imagePreview" src="{{$product->image}}" alt="Preview" class="mt-2" style="max-width: 100px;">
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-secondary" onclick="toggleImageField()">Cambiar</button>
                            </div>
                        </div>
                        <div class="row mb-3" id="fileUpload" style="display: none;">
                            <div class="col">
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Stock</label>
                                <input type="text" name="stock" class="form-control" placeholder="Stock" value="{{$product->stock}}">
                                @error('stock')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Seleccionar Categoría</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($product->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-warning">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>

</x-app-layout>
