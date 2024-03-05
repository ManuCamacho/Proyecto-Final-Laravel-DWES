<!-- resources/views/invoices.blade.php -->

<x-app-layout>
    <main class="my-8">
        <div class="container px-6 mx-auto">
            <div class="flex justify-center my-6">
                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    <h3 class="text-3xl font-bold">Mis Facturas</h3><br>
                    @if ($invoices->isEmpty())
                        <p>No tienes facturas</p>
                    @else
                        @foreach ($invoices as $invoice)
                            <div class="mb-8">
                                <p class="text-lg font-bold">Número de Factura: {{ $invoice->id }}</p>
                                <p class="text-sm">Fecha: {{ $invoice->date }}</p>
                                <p class="text-sm">Total: {{ $invoice->total }}€</p>

                                <table class="min-w-full mt-4 divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre del Producto</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($invoice->lines as $line)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $line->product->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $line->amount }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $line->product->price }}€</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $line->product->price * $line->amount }}€</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
