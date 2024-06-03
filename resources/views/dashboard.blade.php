<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('¡Bienvenido a 4Games!') }}
        </h2>
    </x-slot>

    <div class="bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Sección de Bienvenida -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-4xl font-bold text-gray-800 mb-6">Descubre tus juegos favoritos</h1>
                    <p class="text-lg text-gray-600 mb-8">Explora nuestra amplia colección de videojuegos para todas las plataformas.</p>
                    <a href="/products" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-full inline-block transition duration-300">Explorar Catálogo</a>
                </div>
                <!-- Imagen Principal -->
                <div class="flex justify-center">
                    <img src="https://granadahoy.com/2023/01/03/vivir/tienda-actual-Master-Game_1753635435_173818408_1200x675.jpg" alt="Imagen Principal" class="w-full max-h-96 object-cover rounded-lg shadow-md">
                </div>
            </div><br>
            <img src="https://iili.io/JVfp4Lv.jpg" alt="Imagen Principal" class="w-full max-h-96 object-cover rounded-lg shadow-md"><br>

            <!-- Sección de Productos Destacados -->
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Productos Destacados Nintendo</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Producto 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://iili.io/JVxQKgV.webp" alt="Nintendo Switch" class="w-full h-56 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Nintendo Switch</h3>
                        <p class="text-gray-600 mb-2">La consola de nueva generación de Nintendo.</p>
                        <p class="text-gray-600 mb-2">Precio: 500€</p>
                    </div>
                </div>
                <!-- Producto 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://iili.io/JVxQQhg.png" alt="Nintendo Wii" class="w-full h-56 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Nintendo Wii</h3>
                        <p class="text-gray-600 mb-2">La consola mas divertida de Nintendo.</p>
                        <p class="text-gray-600 mb-2">Precio: 100€</p>
                    </div>
                </div>
                 <!-- Producto 3 -->
                 <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://iili.io/JVxLwxa.jpg" alt="Nintendo Gamecube" class="w-full h-56 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Nintendo Gamecube</h3>
                        <p class="text-gray-600 mb-2">La consola mas cuadrada de Nintendo.</p>
                        <p class="text-gray-600 mb-2">Precio: 300€</p>
                    </div>
                </div>
                 <!-- Producto 4 -->
                 <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="https://iili.io/JVxZscl.jpg" alt="Nintendo 64" class="w-full h-56 object-cover rounded-t-lg">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2">Nintendo 64</h3>
                        <p class="text-gray-600 mb-2">La consola mas nostálgica de Nintendo.</p>
                        <p class="text-gray-600 mb-2">Precio: 250€</p>
                    </div>
                </div>
            </div><br>
                  <!-- Insertar video en lugar de "aaaaa" -->
                  <video controls class="w-full h-156 object-cover rounded-t-lg">
                    <source src="{{ asset('videos/video.mp4') }}" type="video/mp4">
                    Tu navegador no soporta el elemento de video.
                </video><br>

            <img src="https://iili.io/JVfbPwJ.jpg" alt="Banner 1" class="w-full h-56 object-cover rounded-t-lg"><br>
             <!-- Sección de Productos Destacados -->
             <h2 class="text-3xl font-bold text-gray-800 mb-6">Productos Destacados Sony</h2>
             <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                 <!-- Producto 1 -->
                 <div class="bg-white rounded-lg shadow-md overflow-hidden">
                     <img src="https://cdn.idealo.com/folder/Product/202304/9/202304941/s11_produktbild_max/sony-playstation-5-ps5-2-dualsense-wireless-controller.jpg" alt="PlayStation 5" class="w-full h-56 object-cover rounded-t-lg">
                     <div class="p-4">
                         <h3 class="text-xl font-semibold mb-2">PlayStation 5</h3>
                         <p class="text-gray-600 mb-2">La consola de nueva generación de Sony.</p>
                         <p class="text-gray-600 mb-2">Precio: 500€</p>
                     </div>
                 </div>
                 <!-- Producto 2 -->
                 <div class="bg-white rounded-lg shadow-md overflow-hidden">
                     <img src="https://m.media-amazon.com/images/I/51czx+lS31L._AC_UF894,1000_QL80_.jpg" alt="PlayStation 4" class="w-full h-56 object-cover rounded-t-lg">
                     <div class="p-4">
                         <h3 class="text-xl font-semibold mb-2">PlayStation 4</h3>
                         <p class="text-gray-600 mb-2">La cuarta consola de la generación de Sony.</p>
                         <p class="text-gray-600 mb-2">Precio: 400€</p>
                     </div>
                 </div>
                  <!-- Producto 3 -->
                  <div class="bg-white rounded-lg shadow-md overflow-hidden">
                     <img src="https://i0.wp.com/hitechgamez.in/wp-content/uploads/2023/04/PS3-2.jpg?fit=1000%2C1000&ssl=1" alt="PlayStation 3" class="w-full h-56 object-cover rounded-t-lg">
                     <div class="p-4">
                         <h3 class="text-xl font-semibold mb-2">PlayStation 3</h3>
                         <p class="text-gray-600 mb-2">La tercera consola de la generación de Sony.</p>
                         <p class="text-gray-600 mb-2">Precio: 300€</p>
                     </div>
                 </div>
                  <!-- Producto 4 -->
                  <div class="bg-white rounded-lg shadow-md overflow-hidden">
                     <img src="https://m.media-amazon.com/images/I/712J5AHfS0L._AC_UF894,1000_QL80_.jpg" alt="PlayStation 2" class="w-full h-56 object-cover rounded-t-lg">
                     <div class="p-4">
                         <h3 class="text-xl font-semibold mb-2">PlayStation 2</h3>
                         <p class="text-gray-600 mb-2">La consola mas popular de Sony.</p>
                         <p class="text-gray-600 mb-2">Precio: 150€</p>
                     </div>
                 </div>
             </div><br>
              <!-- Sección de Productos Destacados -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
           
                 <!-- Producto 4 -->
                 <img src="https://iili.io/JVqf6Al.jpg" alt="Banner 2">
                 <img src="https://iili.io/JVqfitS.jpg" alt="Banner 3">
                 <img src="https://iili.io/JVqfLo7.jpg" alt="Banner 4">
                <img src="https://iili.io/JVqJzGf.jpg" alt="Banner 5">
                </div>
            </div>
        </div>
        
    </div>
</x-app-layout>
