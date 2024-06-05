<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <!-- Mensajes de error y éxito -->
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="mb-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-auto object-cover object-center rounded-lg">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                    <p class="text-gray-900 text-3xl font-bold mb-4">{{ $product->price }}€</p>

                    <!-- Botón de Añadir al Carrito -->
                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <input type="hidden" value="{{ $product->name }}" name="name">
                        <input type="hidden" value="{{ $product->price }}" name="price">
                        <input type="hidden" value="{{ $product->image }}" name="image">
                        <input type="hidden" value="1" name="quantity">
                        <button class="px-4 py-2 text-white text-sm bg-blue-900 rounded hover:bg-blue-800 transition duration-300">
                            Añadir al Carrito
                        </button>
                    </form>

                    <!-- Formulario de valoración -->
                    <form id="reviewForm" action="{{ route('product.review', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex items-center mb-4">
                            <label class="block text-gray-700 text-sm font-bold mr-2" for="rating">Calificación:</label>
                            <div class="rating-stars flex">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star text-gray-400 cursor-pointer" data-rating="{{ $i }}"></i>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating" value="0" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold" for="comment">Comentario:</label>
                            <textarea name="comment" id="comment" class="resize-none border border-gray-300 rounded-md w-full px-3 py-2 focus:outline-none focus:border-blue-500" required></textarea>
                        </div>
                        <div id="ratingError" class="text-red-500 mb-4" style="display: none;">Por favor, selecciona una calificación.</div>
                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white py-2 rounded transition duration-300">Enviar Valoración</button>
                    </form>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Resumen del Producto:</h2>
                <ul class="list-disc list-inside text-gray-700">
                    <li><strong>Descripción del Producto:</strong> {{ $product->description }}</li><br>
                    <li><strong>Stock Disponible:</strong> {{ $product->stock }}</li><br>
                    <li><strong>Categoría:</strong> {{ $product->category ? $product->category->name : 'Sin categoría' }}</li>
                </ul>
            </div>
            
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Reseñas de Clientes:</h2>
                @foreach($product->reviews as $review)
                    <div class="border border-gray-300 rounded-md p-4 mb-4">
                        <p><strong>Usuario:</strong> {{ $review->user ? $review->user->name : 'Anónimo' }}</p>
                        <p><strong>Calificación:</strong> 
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star{{ $i <= $review->rating ? ' text-yellow-400' : ' text-gray-300' }}"></i>
                            @endfor
                        </p>
                        <p><strong>Comentario:</strong> {{ $review->comment }}</p>
                        <p><strong>Fecha:</strong> {{ $review->created_at->format('d/m/Y') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Elemento de audio -->
    <audio id="successSound" src="{{ asset('sounds/valoracion.mp3') }}" preload="auto"></audio>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.rating-stars .fa-star');
            const ratingInput = document.getElementById('rating');
            const ratingError = document.getElementById('ratingError');
            const reviewForm = document.getElementById('reviewForm');
            const successSound = document.getElementById('successSound');

            stars.forEach(star => {
                star.addEventListener('click', function () {
                    const rating = this.getAttribute('data-rating');
                    ratingInput.value = rating;

                    stars.forEach(s => {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-400');
                    });

                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('text-yellow-400');
                        stars[i].classList.remove('text-gray-400');
                    }

                    ratingError.style.display = 'none';
                });
            });

            reviewForm.addEventListener('submit', function (event) {
                if (ratingInput.value === '0') {
                    ratingError.style.display = 'block';
                    event.preventDefault();
                }
            });

            @if(Session::has('success'))
                successSound.play();
            @endif
            
        });
    </script>
</x-app-layout>
