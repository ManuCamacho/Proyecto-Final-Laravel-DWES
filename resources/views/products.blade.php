<x-app-layout>
    <div class="container px-12 py-8 mx-auto">
        <!-- Formulario de búsqueda y filtrado -->
        <form method="GET" action="{{ route('products.list') }}" class="max-w-lg mx-auto">
            <div class="flex items-center border-b border-b-2 border-blue-500 py-2">
                <input type="text" name="search" id="search" placeholder="Buscar producto..."
                    class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
                <button type="submit"
                    class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 text-sm text-white py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                    Buscar
                </button>
            </div>
            <div class="flex justify-between mt-4">
                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="orderBy">
                    Ordenar por:
                </label>
                <select name="orderBy" id="orderBy"
                    class="appearance-none bg-transparent border border-blue-500 text-gray-700 py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                    <option value="" disabled selected>Elija una opción</option>
                    <option value="asc">Nombre (A-Z)</option>
                    <option value="desc">Nombre (Z-A)</option>
                    <option value="price_asc">Precio (menor a mayor)</option>
                    <option value="price_desc">Precio (mayor a menor)</option>
                    <option value="stock_asc">Stock (menor a mayor)</option>
                    <option value="stock_desc">Stock (mayor a menor)</option>
                </select>
                <button type="submit"
                    class="flex-shrink-0 bg-blue-500 hover:bg-blue-700 text-sm text-white py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                    Ordenar
                </button>
            </div>

            <!-- Desplegable de selección de categorías -->
            <div class="mt-4">
                <label for="category" class="block text-sm font-medium text-gray-700">Categoría:</label>
                <select id="category" name="category"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Todas las categorías</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Botón de submit para filtrar -->
            <div class="mt-4">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Filtrar
                </button>
            </div>
        </form>

        <!-- Listado de productos -->
        <h3 class="text-2xl font-bold text-gray-900 mt-8">Productos</h3>
        <div class="h-1 bg-gray-800 w-48 my-4"></div>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
                <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-md shadow-md">
                    <a href="{{ route('products.show', $product->id) }}">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full max-h-60">
                    </a>
                    <div class="px-5 py-3 border border-gray-300 rounded-lg shadow-md">
                        <div class="mb-5">
                            <h3 class="text-gray-700 uppercase text-xl font-bold">
                                <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                            </h3>
                            <span class="text-gray-500 font-semibold">Precio: {{ $product->price }}€</span><br>
                            <span class="text-gray-500 font-semibold">Stock: {{ $product->stock }}</span><br>
                            <span class="text-gray-500 font-semibold">Categoría: {{ $product->category ? $product->category->name : 'Sin categoría' }}</span><br>

                        </div>
                        <div>
                            <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="id">
                                <input type="hidden" value="{{ $product->name }}" name="name">
                                <input type="hidden" value="{{ $product->price }}" name="price">
                                <input type="hidden" value="{{ $product->image }}" name="image">
                                <input type="hidden" value="1" name="quantity">
                                <button
                                    class="px-4 py-2 text-white text-sm bg-blue-900 rounded hover:bg-blue-800 transition duration-300">
                                    Añadir al Carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
