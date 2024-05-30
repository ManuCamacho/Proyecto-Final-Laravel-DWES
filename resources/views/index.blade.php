<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
         
<html>
  <head>
    <title></title>
    <meta content="">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Exo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body{
      font-family: 'Exo', sans-serif;
    }
    .header-col{
      background: #E3E9E5;
      color:#536170;
      text-align: center;
      font-size: 20px;
      font-weight: bold;
    }
    .header-calendar{
      background: #1a365d;color:white;
    }
    .box-day{
      border:1px solid #E3E9E5;
      height:150px;
    }
    .box-dayoff{
      border:1px solid #E3E9E5;
      height:150px;
      background-color: #ccd1ce;
    }
    </style>

  </head>
  <body>

    <div class="container">
      <p class="lead">
        <h1>Calendario de Productos</h1>
        @unless(Auth::user() && Auth::user()->usertype === 'user')
        <a class="btn btn-default" style="background-color: #55aed7; color: white;" href="{{ asset('/Evento/form') }}">Crear un evento</a>
        @endunless


      <hr>

      <div class="row header-calendar"  >

        <div class="col" style="display: flex; justify-content: space-between; padding: 10px;">
          <a  href="{{ asset('/Evento/index/') }}/<?= $data['last']; ?>" style="margin:10px;">
            <i class="fas fa-chevron-circle-left" style="font-size:30px;color:white;"></i>
          </a>
          <h2 style="font-weight:bold;margin:10px;"><?= $mespanish; ?> <small><?= $data['year']; ?></small></h2>
          <a  href="{{ asset('/Evento/index/') }}/<?= $data['next']; ?>" style="margin:10px;">
            <i class="fas fa-chevron-circle-right" style="font-size:30px;color:white;"></i>
          </a>
        </div>

      </div>
      <div class="row">
        <div class="col header-col">Lunes</div>
        <div class="col header-col">Martes</div>
        <div class="col header-col">Miercoles</div>
        <div class="col header-col">Jueves</div>
        <div class="col header-col">Viernes</div>
        <div class="col header-col">Sabado</div>
        <div class="col header-col">Domingo</div>
      </div>
      <!-- inicio de semana -->
      @foreach ($data['calendar'] as $weekdata)
      <div class="row">
          <!-- Ciclo de días por semana -->
          @foreach ($weekdata['datos'] as $dayweek)
              @if ($dayweek['mes'] == $mes)
                  <div class="col box-day">
                      {{ $dayweek['dia'] }}
                      <!-- Evento -->
                      @isset($dayweek['evento'])
                          @foreach ($dayweek['evento'] as $event)
                              <a class="badge badge-primary" href="{{ asset('/Evento/details/') }}/{{ $event->id }}">
                                  {{ $event->titulo }}
                              </a>
                          @endforeach
                      @endisset
                  </div>
              @else
                  <div class="col box-dayoff">
                  </div>
              @endif
          @endforeach
      </div>
  @endforeach
  

    </div> <!-- /container -->

    <!-- Footer -->
<footer class="page-footer font-small blue pt-4">

  <!-- Copyright -->

</footer>
<!-- Footer -->

  </body>
</html>
</div>
</div>
</div>
</div>
</x-app-layout>
