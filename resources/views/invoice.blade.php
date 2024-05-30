<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        /* Estilos CSS para la factura */
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .invoice-header img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px; /* Ajusta el tamaño del logo */
            height: 100px; /* Ajusta el tamaño del logo */
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 18px;
        }
        .invoice-total span {
            color: #007BFF;
        }
        .invoice-table th {
            background-color: #007BFF;
            color: #fff;
            font-weight: normal;
        }
        .invoice-header h1 {
            margin: 0;
            font-size: 24px;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <img src="https://iili.io/JPmKVWb.jpg" alt="Logo">
            <h1>Factura #{{ $invoice->id }}</h1>
            <p>Fecha: {{ $invoice->date }}</p>
        </div><br><br>
        <!-- Detalles del usuario -->
        <h3 class="text-3xl font-bold">Detalles del Usuario</h3>
        <p>Nombre: {{ $user->name }}</p>
        <p>Apellido: {{ $user->surname }}</p>
        <p>Dirección: {{ $user->address }}</p>
        <p>Teléfono: {{ $user->phone }}</p>
        <p>Email: {{ $user->email }}</p><br><br>

        <!-- Detalles de la compra -->
        <h3 class="text-3xl font-bold">Resumen de la compra</h3>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Nombre del Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Precio Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($invoice->lines as $line)
                <tr>
                    <td>{{ $line->product->name }}</td>
                    <td>{{ $line->amount }}</td>
                    <td>{{ $line->product->price }}€</td>
                    <td>{{ $line->product->price * $line->amount }}€</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="invoice-total">
            <p><span>Total:</span> {{ $invoice->total }}€</p>
        </div>
    </div>
</body>
</html>
