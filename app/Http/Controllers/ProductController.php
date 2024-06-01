<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;



class ProductController extends Controller
{
        /**
     * Muestra una lista de productos según los filtros y el orden proporcionados.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */

     public function productList(Request $request)
     {
         // Consulta todos los productos con stock mayor que 0
         $products = Product::where('stock', '>', 0);
     
         // Filtrar por nombre si se proporciona un valor de búsqueda
         if ($request->has('search')) {
             $searchTerm = $request->input('search');
             $products->where('name', 'like', '%' . $searchTerm . '%');
         }
     
         // Filtrar por categoría si se selecciona una categoría
         if ($request->has('category')) {
             $categoryId = $request->input('category');
             if (!empty($categoryId)) {
                 $products->where('category_id', $categoryId);
             }
         }
     
         // Ordenar los productos
         if ($request->has('orderBy')) {
             $orderBy = $request->input('orderBy');
             if ($orderBy === 'asc' || $orderBy === 'desc') {
                 $products->orderBy('name', $orderBy);
             } elseif ($orderBy === 'price_asc' || $orderBy === 'price_desc') {
                 $direction = $orderBy === 'price_asc' ? 'asc' : 'desc';
                 $products->orderBy('price', $direction);
             } elseif ($orderBy === 'stock_asc' || $orderBy === 'stock_desc') {
                 $direction = $orderBy === 'stock_asc' ? 'asc' : 'desc';
                 $products->orderBy('stock', $direction);
             }
         }
     
         // Obtener los productos con paginación (12 productos por página)
         $products = $products->paginate(12);
     
         // Obtener todas las categorías
         $categories = Category::all();
     
         // Verificar si no se encontraron resultados
         $noResults = $products->isEmpty();
     
         // Pasar las variables a la vista
         return view('products', compact('products', 'noResults', 'categories'));
     }
     

    /**
     * Muestra la página principal del panel de administración de productos.
     *
     * @return \Illuminate\View\View
     */

    public function index(){
        $products = Product::all(); // Obtén todos los productos

        return view('admin.product.home', ['products' => $products]);
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     *
     * @return \Illuminate\View\View
     */

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }
    
    /**
     * Guarda un nuevo producto en la base de datos.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {

    // Validar los datos del formulario
    $validation = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric|min:1',
        'description' => 'required',
        'image' => 'required', // Requerir una imagen
        'stock' => 'required|integer|min:1',
        'category_id' => 'required|exists:categories,id', // Validar que la categoría seleccionada existe en la tabla de categorías

    ]);

    // Obtener la imagen (URL o archivo)
    $image = $request->input('image');
    $imageUrl = null;

    if ($request->hasFile('image')) {
        // Si se cargó una imagen desde el PC
        $imageFile = $request->file('image');
        $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
        // Guardar la imagen en storage/public/images
        $imagePath = $imageFile->storeAs('public/images', $imageName);
        // Obtener la URL de la imagen
        $imageUrl = asset('storage/' . str_replace('public/', '', $imagePath));
    }

    // Crear un nuevo producto con los datos validados
    $productData = [
        'name' => $validation['name'],
        'price' => $validation['price'],
        'description' => $validation['description'],
        'image' => $imageUrl ?? $image, // Usar la URL de la imagen o la URL proporcionada
        'stock' => $validation['stock'],
        'category_id' => $validation['category_id'], // Asignar el ID de la categoría

    ];

    try {
        $product = Product::create($productData);
    
        // Producto creado con éxito
        session()->flash('success', 'Producto añadido correctamente.');
        return redirect()->route('admin.products.index');
    } catch (\Exception $e) {
        // Capturar excepciones (por ejemplo, validación fallida)
        session()->flash('error', 'Failed to add product: ' . $e->getMessage());
        return redirect()->route('admin.products.create');
    }
}

    /**
     * Muestra el formulario de edición de un producto.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.update', compact('product', 'categories'));
    }


    /**
     * Actualiza la información de un producto.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, $id)
    {
    // Validar los datos del formulario
    $validation = $request->validate([
        'name' => 'required',
        'price' => 'required|numeric|min:1',
        'description' => 'required',
        'stock' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id', // Validar que la categoría seleccionada existe en la tabla de categorías
    ]);

    try {
        // Buscar el producto por su ID
        $product = Product::findOrFail($id);

        // Asociar el producto con la categoría seleccionada
        $product->category_id = $validation['category_id'];

        // Actualizar los datos del producto con los datos validados
        $product->name = $validation['name'];
        $product->price = $validation['price'];
        $product->description = $validation['description'];
        $product->stock = $validation['stock'];

        // Verificar si se proporciona una URL de imagen
        if ($request->filled('image')) {
            $product->image = $request->input('image');
        } elseif ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            // Guardar la imagen en storage/public/images
            $imagePath = $imageFile->storeAs('public/images', $imageName);
            // Actualizar la URL de la imagen en la base de datos
            $product->image = asset('storage/' . str_replace('public/', '', $imagePath));
        }

        // Guardar el producto actualizado
        $product->save();

        // Redirigir al listado de productos con mensaje de éxito
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    } catch (\Exception $e) {
        // Capturar excepciones (por ejemplo, validación fallida)
        return redirect()->route('admin.products.index')->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
    }
}

      /**
     * Elimina un producto de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function delete($id)
    {
        $products = Product::findOrFail($id)->delete();
        if ($products) {
            session()->flash('success', 'Producto Borrado Correctamente');
            return redirect(route('admin.products.index'));
        } else {
            session()->flash('error', 'Error al borrar el producto');
            return redirect(route('admin.products.index'));
        }
    }

        public function categories()
        {
            return $this->belongsToMany(Category::class);
        }
        public function show($id)
        {
            $product = Product::findOrFail($id);
            return view('show', compact('product'));
        }


        /**
         * Almacena una nueva reseña para un producto específico.
         *
         * Verifica si el usuario ya ha revisado el producto y guarda una nueva reseña si no lo ha hecho.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\Product  $product
         * @return \Illuminate\Http\RedirectResponse
         */
            
        public function storeReview(Request $request, Product $product)
        {
        // Verificar si el usuario ya ha revisado este producto
        $existingReview = Review::where('product_id', $product->id)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Ya has valorado este producto.');
        }

        // Si no hay una reseña existente, guardar la nueva reseña
        $review = new Review();
        $review->user_id = auth()->id();
        $review->product_id = $product->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->back()->with('success', '¡Gracias por tu valoración!');
        }

        /**
         * Almacena una nueva reseña para un producto específico mediante un identificador de producto.
         *
         * Valida los datos del formulario y crea una nueva reseña si la validación es exitosa y el usuario no ha revisado previamente el producto.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $productId
         * @return \Illuminate\Http\RedirectResponse
         */
        public function reviewProduct(Request $request, $productId)
        {
            // Validar los datos del formulario
            $validator = Validator::make($request->all(), [
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string',
            ]);

            // Comprobar si la validación falla
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Verificar si el usuario ya ha revisado este producto
            $existingReview = Review::where('product_id', $productId)
                                    ->where('user_id', auth()->id())
                                    ->first();

            if ($existingReview) {
                return redirect()->back()->with('error', 'Ya has valorado este producto.');
            }

            // Crear una nueva reseña
            $review = new Review();
            $review->user_id = auth()->id();
            $review->product_id = $productId;
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->save();

            return redirect()->back()->with('success', 'Reseña creada exitosamente.');
        }



    
}