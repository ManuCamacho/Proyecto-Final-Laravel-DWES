<x-app-layout>
    <main class="my-8">
        <div class="container px-6 mx-auto">
            <div class="flex justify-center my-6">
                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    <!-- Aquí puedes mostrar la información del usuario -->
                    <h3 class="text-3xl font-bold">Detalles del Usuario</h3>
                    <p>Nombre: {{ $user->name }}</p>
                    <p>Apellido: {{ $user->surname }}</p>
                    <p>Dirección: {{ $user->address }}</p>
                    <p>Teléfono: {{ $user->phone }}</p>
                    <p>Email: {{ $user->email }}</p>

                    <!-- Mostrar los detalles del carrito -->
                    <h3 class="text-3xl font-bold mt-6">Detalles del Carrito</h3>
                    <table class="w-full text-sm lg:text-base mt-2">
                        <thead>
                            <tr>
                                <th>Nombre del Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Precio total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <th>{{ $item->name }}</th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>{{ $item->price }}€</th>
                                    <th>{{ $item->price * $item->quantity}}€</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Mostrar el total del carrito -->
                    <div class="mt-4 text-xl font-bold">Total del Carrito: {{ $total }}€</div>

                    <!-- Agregar esto al final de la vista checkout.blade.php -->
                    <form action="{{ route('checkout.placeOrder') }}" method="POST">
                        @csrf
                        <button onclick="return confirm('¿Estás seguro de querer realizar el pedido?')" type="submit" class="px-6 py-2 mt-4 text-sm rounded shadow text-red-100 bg-blue-800">Realizar Pedido</button>
                    </form>


                </div>
            </div>
        </div>
    </main>
</x-app-layout>
