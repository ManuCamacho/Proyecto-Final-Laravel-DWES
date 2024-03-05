<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Listado de Productos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl mb-8 text-center">Lista de Productos</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($productos as $producto)
                            <div class="border rounded-lg overflow-hidden shadow-lg bg-gray-50 transition duration-500 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                                @if ($producto->name == 'ps5')
                                <img class="w-full h-40 object-cover object-center" src="{{ asset('images/ps5.jpg') }}" alt="{{ $producto->name }}">
                                @elseif ($producto->name == 'Ps4')
                                <img class="w-full h-40 object-cover object-center" src="{{ asset('images/ps4.jpg') }}" alt="{{ $producto->name }}">
                                @else
                                    <img class="w-full h-40 object-cover object-center" src="{{ asset($producto->image) }}" alt="{{ $producto->name }}">
                                @endif
                                
                                <div class="p-6">
                                    <h2 class="text-lg font-semibold mb-2">{{ $producto->name }}</h2>
                                    <p class="text-gray-700 mb-2">Precio: {{ $producto->price }}€</p>
                                    <p class="text-gray-700 mb-2">Descripción: {{ $producto->description }}</p>
                                    <p class="text-gray-700 mb-4">Stock: {{ $producto->stock }}</p>
                                    <form action="{{ route('agregar.carrito', $producto->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">Comprar</button>
                                    </form>
                                    
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
