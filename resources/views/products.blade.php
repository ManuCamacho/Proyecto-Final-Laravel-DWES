<x-app-layout>
    <div class="container px-12 py-8 mx-auto">
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
        </form>
        
        
        
        <h3 class="text-2xl font-bold text-gray-900">Productos</h3>

        
        <div class="h-1 bg-gray-800 w-48"></div>
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
            <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-md shadow-md">
                <img src="{{ url($product->image) }}" alt="" class="w-full max-h-60">
                <div class="flex items-end justify-end w-full bg-cover">
                    
                </div>
                <div class="px-5 py-3 border border-gray-300 rounded-lg shadow-md">
                    <div class="mb-5">
                        <h3 class="text-gray-700 uppercase text-xl font-bold">{{ $product->name }}</h3>
                        <span class="text-gray-500 font-semibold">Stock: {{ $product->stock }}</span><br>
                        <span class="text-gray-500 font-semibold">Precio: {{ $product->price }}€</span><br>
                        <span class="text-gray-500 font-semibold">Descripción: {{ $product->description }}</span>
                    </div>
                    <div>
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->price }}" name="price">
                            <input type="hidden" value="{{ $product->image }}"  name="image">
                            <input type="hidden" value="1" name="quantity">
                            <button class="px-4 py-2 text-white text-sm bg-blue-900 rounded hover:bg-blue-800 transition duration-300">Añadir al Carrito</button>
                        </form>
                    </div>
                </div>
                
                
                
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>