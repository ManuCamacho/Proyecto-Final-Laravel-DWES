<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"><br><br>
                <img src="{{ asset('images/logo.jpg') }}" alt="Admin" class="w-50 h-50 mx-auto rounded-full">

                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-center mb-6">
                        <h3 class="text-5xl font-bold text-gray-900">Bienvenido, Administrador</h3>
                    </div>
                    <p class="text-lg text-gray-700 mb-6 text-center">En esta sección, puedes acceder a varias funciones de administración:</p>
                    <ul class="list-disc list-inside text-lg text-gray-700 mb-6 text-center">
                        <li>Administrar productos</li>
                        <li>Crear eventos en el Calendario</li>
                        <li>Administrar categorías</li>
                        <li>Gestionar los usuarios</li>
                    </ul>
                    <p class="text-lg text-gray-700 text-center">¡Explora las opciones disponibles en el menú de navegación!</p>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
