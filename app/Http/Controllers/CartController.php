<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Controlador para la gestión del carrito de compras.
 */
class CartController extends Controller
{
    /**
     * Muestra la lista de productos en el carrito.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function cartList()
    {
        // Obtener los elementos del carrito usando la clase Cart
        $cartItems = \Cart::getContent();
        // Devolver la vista 'cart' con los elementos del carrito
        return view('cart', compact('cartItems'));
    }

    /**
     * Añade un producto al carrito.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        // Encontrar el producto basado en el ID proporcionado en la solicitud
        $product = Product::findOrFail($request->id);

        // Verificar si la cantidad solicitada es mayor que el stock disponible
        if ($request->quantity > $product->stock) {
            session()->flash('error', 'No hay suficiente stock disponible para este producto.');
            return redirect()->back();
        }
        
        // Añadir el producto al carrito usando la clase Cart
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Producto añadido correctamente');
        return redirect()->route('cart.list');
    }

    /**
     * Actualiza la cantidad de un producto en el carrito.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCart(Request $request)
    {
        // Obtener el elemento del carrito basado en el ID proporcionado en la solicitud
        $item = \Cart::get($request->id);

        // Verificar si la nueva cantidad es válida
        if ($request->quantity <= 0) {
            session()->flash('error', 'La cantidad debe ser mayor que 0.');
            return redirect()->back();
        }
        
        // Verificar si la nueva cantidad excede el stock disponible
        $product = Product::findOrFail($item->id);
        if ($request->quantity > $product->stock) {
            session()->flash('error', 'No hay suficiente stock disponible para este producto.');
            return redirect()->back();
        }

        // Actualizar la cantidad del producto en el carrito
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', 'Producto actualizado correctamente');
        return redirect()->route('cart.list');
    }

    /**
     * Elimina un producto del carrito.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCart(Request $request)
    {
        // Eliminar el producto del carrito basado en el ID proporcionado en la solicitud
        \Cart::remove($request->id);
        session()->flash('success', 'Producto eliminado correctamente');
        return redirect()->route('cart.list');
    }

    /**
     * Vacía completamente el carrito.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearAllCart()
    {
        // Limpiar todos los elementos del carrito
        \Cart::clear();
        session()->flash('success', 'Carrito vaciado con éxito');
        return redirect()->route('cart.list');
    }
}
