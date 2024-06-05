<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="mb-4">Crear Nueva Categoría</h1>
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre de la Categoría</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nombre de la categoría">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Categoría</button>
                    </form>

                    <hr>
                    <h1 class="mb-4">Actualizar Categoría</h1>

                    <form action="{{ route('categories.update', ['category' => 0]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <select name="id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="new_name" class="form-label">Nuevo Nombre</label>
                            <input type="text" name="name" class="form-control" id="new_name" placeholder="Nuevo Nombre">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>       
                    <hr>
                    <h1 class="mb-4 mt-4">Eliminar Categoría</h1>
                    <form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar la categoría seleccionada?');">
                        @csrf
                        @method('DELETE')
                        <div class="mb-3">
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
