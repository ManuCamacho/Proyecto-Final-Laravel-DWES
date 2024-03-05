<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Carrito de Compras</title>
                    
                    </head>
                    <body>
                        <h1>Carrito de Compras</h1>
                    
                        @if(Session::has('carrito') && count(Session::get('carrito')) > 0)
                            <ul>
                                @foreach(Session::get('carrito') as $producto)
                                    <li>{{ $producto->nombre }} - {{ $producto->precio }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No hay productos en el carrito.</p>
                        @endif
                        
                        <!-- Aquí puedes agregar otros elementos de tu interfaz de usuario, como un botón para realizar el pago -->
                    </body>
                    </html>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
