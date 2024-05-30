<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container mx-auto">
                        <h1 class="mb-0">Enviar Email de Publicidad</h1><br>

                        @if(session('success'))
                            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('marketing.send') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 font-bold mb-2">Título:</label>
                                <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                            <div class="mb-4">
                                <label for="subject" class="block text-gray-700 font-bold mb-2">Asunto:</label>
                                <input type="text" name="subject" id="subject" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                            </div>
                          
                            <div class="mb-4">
                                <label for="content" class="block text-gray-700 font-bold mb-2">Contenido:</label>
                                <textarea name="content" id="content" rows="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                                Enviar Email
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

