<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

/**
 * Controlador para la gestión de eventos.
 */
class ControllerEvent extends Controller
{
    /**
     * Muestra el formulario para crear un nuevo evento.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function form()
    {
        return view("Evento/form");
    }

    /**
     * Crea un nuevo evento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        // Validación de los campos del formulario
        $this->validate($request, [
            'titulo'     =>  'required',
            'descripcion'  =>  'required',
            'fecha' =>  'required'
        ]);

        // Creación del evento
        Event::insert([
            'titulo'       => $request->input("titulo"),
            'descripcion'  => $request->input("descripcion"),
            'fecha'        => $request->input("fecha")
        ]);

        // Redirección con mensaje de éxito
        return back()->with('success', 'Enviado exitosamente!');
    }

    /**
     * Elimina un evento específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        // Busca y elimina el evento
        $event = Event::find($id);
        if ($event) {
            $event->delete();
            return redirect()->route('Evento/index')->with('success', 'Evento eliminado correctamente.');
        }
        return redirect()->back()->with('error', 'No se pudo encontrar el evento especificado.');
    }

    /**
     * Destruye un evento específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Busca y elimina el evento
        $event = Event::find($id);
        
        if ($event) {
            $event->delete();
            return redirect()->route('Evento.index')->with('success', 'Evento eliminado correctamente.');
        }
        
        return redirect()->back()->with('error', 'No se pudo encontrar el evento especificado.');
    }

    /**
     * Muestra los detalles de un evento específico.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function details($id)
    {
        // Busca el evento por su ID y lo muestra
        $event = Event::find($id);

        return view("evento/evento",[
            "event" => $event
        ]);
    }

    /**
     * Muestra el calendario de eventos del mes actual.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Obtiene el mes actual y muestra el calendario
        $month = date("Y-m");
        $data = $this->calendar_month($month);
        $mes = $data['month'];
        // Obtiene el nombre del mes en español
        $mespanish = $this->spanish_month($mes);
        $mes = $data['month'];

        return view("evento/calendario",[
            'data' => $data,
            'mes' => $mes,
            'mespanish' => $mespanish
        ]);
    }

    /**
     * Muestra el calendario de eventos del mes especificado.
     *
     * @param  string  $month
     * @return \Illuminate\Contracts\View\View
     */
    public function index_month($month)
    {
        // Muestra el calendario del mes especificado
        $data = $this->calendar_month($month);
        $mes = $data['month'];
        // Obtiene el nombre del mes en español
        $mespanish = $this->spanish_month($mes);
        $mes = $data['month'];

        return view("evento/calendario",[
            'data' => $data,
            'mes' => $mes,
            'mespanish' => $mespanish
        ]);
    }

    /**
     * Genera un calendario de eventos para el mes dado.
     *
     * @param  string  $month
     * @return array
     */

public static function calendar_month($month){
  //$mes = date("Y-m");
  $mes = $month;
  //sacar el ultimo de dia del mes
  $daylast =  date("Y-m-d", strtotime("last day of ".$mes));
  //sacar el dia de dia del mes
  $fecha      =  date("Y-m-d", strtotime("first day of ".$mes));
  $daysmonth  =  date("d", strtotime($fecha));
  $montmonth  =  date("m", strtotime($fecha));
  $yearmonth  =  date("Y", strtotime($fecha));
  // sacar el lunes de la primera semana
  $nuevaFecha = mktime(0,0,0,$montmonth,$daysmonth,$yearmonth);
  $diaDeLaSemana = date("w", $nuevaFecha);
  $nuevaFecha = $nuevaFecha - ($diaDeLaSemana*24*3600); //Restar los segundos totales de los dias transcurridos de la semana
  $dateini = date ("Y-m-d",$nuevaFecha);
  //$dateini = date("Y-m-d",strtotime($dateini."+ 1 day"));
  // numero de primer semana del mes
  $semana1 = date("W",strtotime($fecha));
  // numero de ultima semana del mes
  $semana2 = date("W",strtotime($daylast));
  // semana todal del mes
  // en caso si es diciembre
  if (date("m", strtotime($mes))==12) {
      $semana = 5;
  }
  else {
    $semana = ($semana2-$semana1)+1;
  }
  // semana todal del mes
  $datafecha = $dateini;
  $calendario = array();
  $iweek = 0;
  while ($iweek < $semana):
      $iweek++;
      //echo "Semana $iweek <br>";
      //
      $weekdata = [];
      for ($iday=0; $iday < 7 ; $iday++){
        // code...
        $datafecha = date("Y-m-d",strtotime($datafecha."+ 1 day"));
        $datanew['mes'] = date("M", strtotime($datafecha));
        $datanew['dia'] = date("d", strtotime($datafecha));
        $datanew['fecha'] = $datafecha;
        //AGREGAR CONSULTAS EVENTO
        $datanew['evento'] = Event::where("fecha",$datafecha)->get();

        array_push($weekdata,$datanew);
      }
      $dataweek['semana'] = $iweek;
      $dataweek['datos'] = $weekdata;
      //$datafecha['horario'] = $datahorario;
      array_push($calendario,$dataweek);
  endwhile;
  $nextmonth = date("Y-M",strtotime($mes."+ 1 month"));
  $lastmonth = date("Y-M",strtotime($mes."- 1 month"));
  $month = date("M",strtotime($mes));
  $yearmonth = date("Y",strtotime($mes));
  //$month = date("M",strtotime("2019-03"));
  $data = array(
    'next' => $nextmonth,
    'month'=> $month,
    'year' => $yearmonth,
    'last' => $lastmonth,
    'calendar' => $calendario,
  );
  return $data;
}

public static function spanish_month($month)
    {

        $mes = $month;
        if ($month=="Jan") {
          $mes = "Enero";
        }
        elseif ($month=="Feb")  {
          $mes = "Febrero";
        }
        elseif ($month=="Mar")  {
          $mes = "Marzo";
        }
        elseif ($month=="Apr") {
          $mes = "Abril";
        }
        elseif ($month=="May") {
          $mes = "Mayo";
        }
        elseif ($month=="Jun") {
          $mes = "Junio";
        }
        elseif ($month=="Jul") {
          $mes = "Julio";
        }
        elseif ($month=="Aug") {
          $mes = "Agosto";
        }
        elseif ($month=="Sep") {
          $mes = "Septiembre";
        }
        elseif ($month=="Oct") {
          $mes = "Octubre";
        }
        elseif ($month=="Oct") {
          $mes = "December";
        }
        elseif ($month=="Dec") {
          $mes = "Diciembre";
        }
        else {
          $mes = $month;
        }
        return $mes;
    }
}