<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Encabezado */
        .header {
            background-color: #f3f3f3;
            padding: 20px;
            text-align: center;
        }

        /* Título */
        .title {
            margin-top: 0;
            color: #333;
        }

        /* Contenido */
        .content {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Enlaces */
        .content a {
            color: #007bff;
            text-decoration: none;
        }

        /* Pie de página */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">{{ $title }}</h1>
        </div>
        <div class="content">
            <p>{!! nl2br(e($content)) !!}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} 4Games. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
