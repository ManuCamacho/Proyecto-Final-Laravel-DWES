<x-app-layout>
    <html>
        <head>
            <title>Detalles del Evento</title>
            <meta content="">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
            <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <style>
                body {
                    font-family: 'Exo', sans-serif;
                }
                .header-col {
                    background: #E3E9E5;
                    color:#536170;
                    text-align: center;
                    font-size: 24px;
                    font-weight: bold;
                }
                .header-calendar {
                    background: #EE192D;
                    color: white;
                }
                .box-day {
                    border:1px solid #E3E9E5;
                    height:150px;
                }
                .box-dayoff {
                    border:1px solid #E3E9E5;
                    height:150px;
                    background-color: #ccd1ce;
                }
                h1 {
                    font-size: 2.5rem;
                }
                h4 {
                    font-size: 1.5rem;
                }
                p {
                    font-size: 1.25rem;
                }
                #countdown {
                    font-size: 1.5rem;
                }
                .btn {
                    font-size: 1.25rem;
                }
            </style>
        </head>
        <body>
            <div class="container my-4">
                <div class="bg-white p-5 rounded-lg shadow-lg">
                    <h1 class="mb-4">Detalles del Evento</h1>
                    <a class="btn btn-default mb-3" style="background-color: gray; color: white;" href="{{ asset('/Evento/index') }}">Atrás</a>
                    <hr>
                    <form action="{{ route('Evento.destroy', ['id' => $event->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="titulo"><h4 style="color: #3B82F6;">Título:</h4></label>
                            <p>{{ $event->titulo }}</p>
                        </div>
                        <div class="form-group">
                            <label for="descripcion"><h4 style="color: #3B82F6;">Descripción del Evento:</h4></label>
                            <p>{{ $event->descripcion }}</p>
                        </div>
                        <div class="form-group">
                            <label for="fecha"><h4 style="color: #3B82F6;">Fecha:</h4></label>
                            <p>{{ $event->fecha }}</p>
                        </div><br>
                        <div id="countdown" class="mb-3"></div><br>
                        @unless(Auth::user() && Auth::user()->usertype === 'user')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?')">Eliminar Evento</button>
                        @endunless
                    </form>
                </div>
            </div>
            <script>
                // Obtener la fecha del evento
                const eventDate = new Date("{{ $event->fecha }}");
        
                // Función para actualizar la cuenta regresiva
                function updateCountdown() {
                    const now = new Date();
                    const timeRemaining = eventDate - now;
        
                    // Verificar si el evento ya ha pasado
                    if (timeRemaining <= 0) {
                        // Si ha pasado, ocultar el elemento que muestra la cuenta regresiva
                        document.getElementById('countdown').style.display = 'none';
                        return; // Salir de la función
                    }
        
                    // Convertir milisegundos a días, horas, minutos y segundos
                    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
        
                    // Actualizar la cuenta regresiva en el elemento HTML
                    document.getElementById('countdown').innerHTML = `Tiempo restante: ${days} días, ${hours} horas, ${minutes} minutos, ${seconds} segundos`;
        
                    // Guardar la cuenta regresiva en localStorage
                    localStorage.setItem('countdown', JSON.stringify({ days, hours, minutes, seconds }));
                }
        
                // Función para recuperar la cuenta regresiva almacenada en localStorage
                function restoreCountdown() {
                    const countdown = JSON.parse(localStorage.getItem('countdown'));
                    if (countdown) {
                        document.getElementById('countdown').innerHTML = `Tiempo restante: ${countdown.days} días, ${countdown.hours} horas, ${countdown.minutes} minutos, ${countdown.seconds} segundos`;
                    }
                }
        
                // Actualizar la cuenta regresiva cada segundo
                setInterval(updateCountdown, 1000);
        
                // Llamar a la función de actualización inicial
                updateCountdown();
        
                // Llamar a la función para restaurar la cuenta regresiva al cargar la página
                restoreCountdown();
            </script>
        </body>
    </html>
</x-app-layout>
