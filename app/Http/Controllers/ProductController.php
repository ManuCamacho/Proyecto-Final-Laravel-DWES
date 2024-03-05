<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList(Request $request)
    {
        // Consulta todos los productos con stock mayor que 0
        $products = Product::where('stock', '>', 0);
        // Filtrar por nombre si se proporciona un valor de búsqueda
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $products->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Ordenar los productos
        if ($request->has('orderBy')) {
            $orderBy = $request->input('orderBy');
            if ($orderBy === 'asc' || $orderBy === 'desc') {
                // Ordenar por nombre
                $products->orderBy('name', $orderBy);
            } elseif ($orderBy === 'price_asc' || $orderBy === 'price_desc') {
                // Ordenar por precio
                $direction = $orderBy === 'price_asc' ? 'asc' : 'desc';
                $products->orderBy('price', $direction);
            } elseif ($orderBy === 'stock_asc' || $orderBy === 'stock_desc') {
                // Ordenar por stock
                $direction = $orderBy === 'stock_asc' ? 'asc' : 'desc';
                $products->orderBy('stock', $direction);
            }
        }
    
        

        // Obtener los productos
        $products = $products->get();

        // Verificar si no se encontraron resultados
        $noResults = $products->isEmpty();

        return view('products', compact('products', 'noResults'));
    }

    
}