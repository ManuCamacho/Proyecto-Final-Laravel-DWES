<!-- resources/views/confirmation.blade.php -->

<x-app-layout>
    <div class="container mx-auto">
        <div class="my-8">
            <h2 class="text-3xl font-bold mb-4">¡Gracias por tu compra!</h2>
            <p class="mb-4">Tu pedido con el ID de factura {{ $invoice->id }} se ha completado con éxito.</p>
            <a href="/dashboard" class="px-6 py-2 text-sm rounded shadow text-red-100 bg-blue-800">Volver a la página de inicio</a>
        </div>
    </div>
</x-app-layout>
