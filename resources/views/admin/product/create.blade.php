<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="mb-0">Añadir Producto</h1>
                    <hr />
                    @if (session()->has('error'))
                    <div>
                        {{session('error')}}
                    </div>
                    @endif

                    <p><a href="{{ route('admin.products.index') }}" class="btn btn-primary">Volver</a></p>
 
                    <form action="{{ route('admin.products.save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Nombre">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="price" class="form-control" placeholder="Precio">
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="description" class="form-control" placeholder="Descripción">
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="image" class="form-control" placeholder="URL de la imagen o subir desde el PC">
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
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="stock" class="form-control" placeholder="Stock">
                                @error('stock')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Seleccionar Categoría</label>
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-primary">Añadir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleImageField() {
            var fileUpload = document.getElementById('fileUpload');
            var imageUrl = document.querySelector('input[name="image"]');
            if (fileUpload.style.display === 'none') {
                fileUpload.style.display = 'block';
                imageUrl.style.display = 'none';
            } else {
                fileUpload.style.display = 'none';
                imageUrl.style.display = 'block';
            }
        }
    </script>
</x-app-layout>
