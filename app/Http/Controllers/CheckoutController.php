<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Line;
use App\Models\Product;
use Cart;

class CheckoutController extends Controller
{
    public function show()
    {
        // Obtener la información del usuario de la sesión
        $user = auth()->user();

        // Obtener los detalles del carrito
        $cartItems = Cart::getContent();
        $total = Cart::getTotal();

        // Cargar la vista checkout.blade.php con los datos necesarios
        return view('checkout', compact('user', 'cartItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        // Obtener los datos del usuario de la sesión
        $user = auth()->user();

        // Crear una nueva factura
        $invoice = new Invoice();
        //$invoice->num_invoice = uniqid('INV-'); // Generar un número de factura único
        $invoice->date = now(); // Fecha actual
        $invoice->total = Cart::getTotal(); // Total del carrito
       // $invoice->total_amount = Cart::getTotalQuantity(); // Cantidad total de productos en el carrito
        $invoice->user_id = $user->id; // ID del usuario
        $invoice->save();

        // Guardar los detalles del carrito en la tabla lines
        foreach (Cart::getContent() as $item) {
            $line = new Line();
            $line->amount = $item->quantity;
            $line->id_invoice = $invoice->id;
            $line->id_product = $item->id;
            $line->save();

            // Actualizar el stock del producto
            $product = Product::find($item->id);
            $product->stock -= $item->quantity;
            $product->save();

        }

        // Vaciar el carrito después de realizar el pedido
        Cart::clear();

        // Redirigir a una página de confirmación o cualquier otra página que desees
        return view('confirmation', compact('invoice'));

    }

    public function confirmation($invoiceId)
    {
    // Obtener la factura basada en el ID proporcionado
    $invoice = Invoice::findOrFail($invoiceId);

    // Renderizar la vista de confirmación y pasar la factura
    return view('confirmation', compact('invoice'));
    }

}
