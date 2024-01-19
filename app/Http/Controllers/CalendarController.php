<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    function index()
    {
        $shifts = Shift::all();

        $events = array();
        foreach ($shifts as $shift) {
            $area = '';
            $allDay = false;
            $end = $shift->date;
            $color = '#273746';

            // validar el rol o area del evento
            if ($shift->area) {
                $area = $shift->area->name;
            }

            // si hay salto de dia aumenta un dia en la fecha del final del turno.
            if ($shift->schedule->skip == '1') {
                $end = date("Y-m-d",strtotime($shift->date."+ 1 days"));
            }

            $rest = trim(strtolower($shift->schedule->period->name)); 
            if ($rest == 'libre') {
                $allDay = true;
                $color = "#A93226";
            }

            // horario normal
            $events[] = [
                'title' => $shift->employee->name . ' ' . $shift->employee->lastname,
                'start' => $shift->date." " . $shift->schedule->start,
                'end' => $end ." " . $shift->schedule->end,
                'rol' => $area,
                'color' => $color,
                'allDay' => $allDay
            ];

            // horario de descanso
            if ($shift->recess) {
                $color = '#239B56';
                $events[] = [
                    'title' => 'Descanso ' . $shift->employee->name . ' ' . $shift->employee->lastname,
                    'start' => $shift->date." " . $shift->recess->start,
                    'end' => $shift->date." " . $shift->recess->end,
                    'rol' => $area,
                    'color' => $color
                ];
            }
        }

        return view('calendar.index', ['events' => $events]);
    }
}
