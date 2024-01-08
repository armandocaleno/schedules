<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    function index()
    {
        $shifts = Employee::find(1);
        // dd($shifts->shifts);

        $events = array();
        // =============================== lunes =============================
        // horario 1
        $events[] = [
            'title' => 'José Serrano',
            'start' => '2024-01-08 07:00:00',
            'end' => '2024-01-08 16:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor',
        ];

        $events[] = [
            'title' => 'Descanso José Serrano',
            'start' => '2024-01-08 11:00:00',
            'end' => '2024-01-08 12:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario 2
        $events[] = [
            'title' => 'Fernando Pilco',
            'start' => '2024-01-08 08:00:00',
            'end' => '2024-01-08 17:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Fernando Pilco',
            'start' => '2024-01-08 12:00:00',
            'end' => '2024-01-08 13:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        $events[] = [
            'title' => 'Cristian Macas',
            'start' => '2024-01-08 08:00:00',
            'end' => '2024-01-08 17:00:00',
            'empleado_id' => '1',
            'rol' => 'Correos',
        ];

        $events[] = [
            'title' => 'Descanso Cristian Macas',
            'start' => '2024-01-08 13:00:00',
            'end' => '2024-01-08 14:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario noche
        $events[] = [
            'title' => 'Melanie Reyes',
            'start' => '2024-01-08 17:00:00',
            'end' => '2024-01-09 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Melanie Reyes',
            'start' => '2024-01-08 17:00:00',
            'end' => '2024-01-08 18:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        $events[] = [
            'title' => 'Luis Cuesta',
            'start' => '2024-01-08 17:00:00',
            'end' => '2024-01-09 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor/Correos',
        ];

        $events[] = [
            'title' => 'Descanso Luis Cuesta',
            'start' => '2024-01-08 18:00:00',
            'end' => '2024-01-08 19:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // libre
        $events[] = [
            'title' => 'Oscar Males',
            'empleado_id' => '1',
            'start' => '2024-01-08 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        $events[] = [
            'title' => 'Hugo Parada',
            'empleado_id' => '1',
            'start' => '2024-01-08 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        // =============================== martes =============================

        // horario 1
        $events[] = [
            'title' => 'José Serrano',
            'start' => '2024-01-09 07:00:00',
            'end' => '2024-01-09 16:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor',
        ];

        $events[] = [
            'title' => 'Descanso José Serrano',
            'start' => '2024-01-09 11:00:00',
            'end' => '2024-01-09 12:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario 2
        $events[] = [
            'title' => 'Fernando Pilco',
            'start' => '2024-01-09 08:00:00',
            'end' => '2024-01-09 17:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Fernando Pilco',
            'start' => '2024-01-09 12:00:00',
            'end' => '2024-01-09 13:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        $events[] = [
            'title' => 'Cristian Macas',
            'start' => '2024-01-09 08:00:00',
            'end' => '2024-01-09 17:00:00',
            'empleado_id' => '1',
            'rol' => 'Correos',
        ];

        $events[] = [
            'title' => 'Descanso Cristian Macas',
            'start' => '2024-01-09 13:00:00',
            'end' => '2024-01-09 14:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario noche
        $events[] = [
            'title' => 'Luis Cuesta',
            'start' => '2024-01-09 17:00:00',
            'end' => '2024-01-10 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor/Correos',
        ];

        $events[] = [
            'title' => 'Descanso Luis Cuesta',
            'start' => '2024-01-09 18:00:00',
            'end' => '2024-01-09 19:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        $events[] = [
            'title' => 'Melanie Reyes',
            'start' => '2024-01-09 17:00:00',
            'end' => '2024-01-10 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Melanie Reyes',
            'start' => '2024-01-09 17:00:00',
            'end' => '2024-01-09 18:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];


        // libre
        $events[] = [
            'title' => 'Oscar Males',
            'empleado_id' => '1',
            'start' => '2024-01-09 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        $events[] = [
            'title' => 'Hugo Parada',
            'empleado_id' => '1',
            'start' => '2024-01-09 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        // =============================== miercoles =============================
        // horario 1
        $events[] = [
            'title' => 'Oscar Males',
            'start' => '2024-01-10 07:00:00',
            'end' => '2024-01-10 16:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor',
        ];

        $events[] = [
            'title' => 'Descanso Oscar Males',
            'start' => '2024-01-10 11:00:00',
            'end' => '2024-01-10 12:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario 2
        $events[] = [
            'title' => 'Cristian Macas',
            'start' => '2024-01-10 08:00:00',
            'end' => '2024-01-10 17:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Cristian Macas',
            'start' => '2024-01-10 12:00:00',
            'end' => '2024-01-10 13:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        $events[] = [
            'title' => 'José Serrano',
            'start' => '2024-01-10 08:00:00',
            'end' => '2024-01-10 17:00:00',
            'empleado_id' => '1',
            'rol' => 'Correos',
        ];

        $events[] = [
            'title' => 'Descanso José Serrano',
            'start' => '2024-01-10 13:00:00',
            'end' => '2024-01-10 14:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario noche
        $events[] = [
            'title' => 'Luis Cuesta',
            'start' => '2024-01-10 17:00:00',
            'end' => '2024-01-11 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor/Correos',
        ];

        $events[] = [
            'title' => 'Descanso Luis Cuesta',
            'start' => '2024-01-10 18:00:00',
            'end' => '2024-01-10 19:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        $events[] = [
            'title' => 'Hugo Parada',
            'start' => '2024-01-10 17:00:00',
            'end' => '2024-01-11 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Hugo Parada',
            'start' => '2024-01-10 17:00:00',
            'end' => '2024-01-10 18:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];


        // libre
        $events[] = [
            'title' => 'Fernando Pilco',
            'empleado_id' => '1',
            'start' => '2024-01-10 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        $events[] = [
            'title' => 'Melanie Reyes',
            'empleado_id' => '1',
            'start' => '2024-01-10 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        // ========================================jueves =================================

        // horario 1
        $events[] = [
            'title' => 'Cristian Macas',
            'start' => '2024-01-11 07:00:00',
            'end' => '2024-01-11 16:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor',
        ];

        $events[] = [
            'title' => 'Descanso Cristian Macas',
            'start' => '2024-01-11 11:00:00',
            'end' => '2024-01-11 12:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario 2
        $events[] = [
            'title' => 'Oscar Males',
            'start' => '2024-01-11 08:00:00',
            'end' => '2024-01-11 17:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Oscar Males',
            'start' => '2024-01-11 12:00:00',
            'end' => '2024-01-11 13:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        // horario noche
        $events[] = [
            'title' => 'Luis Cuesta',
            'start' => '2024-01-11 17:00:00',
            'end' => '2024-01-12 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Supervisor/Correos',
        ];

        $events[] = [
            'title' => 'Descanso Luis Cuesta',
            'start' => '2024-01-11 18:00:00',
            'end' => '2024-01-11 19:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];

        $events[] = [
            'title' => 'Hugo Parada',
            'start' => '2024-01-11 17:00:00',
            'end' => '2024-01-12 02:00:00',
            'empleado_id' => '1',
            'rol' => 'Kioskos',
        ];

        $events[] = [
            'title' => 'Descanso Hugo Parada',
            'start' => '2024-01-11 17:00:00',
            'end' => '2024-01-11 18:00:00',
            'empleado_id' => '1',
            'color' => '#924ACE'
        ];


        // libre
        $events[] = [
            'title' => 'Fernando Pilco',
            'empleado_id' => '1',
            'start' => '2024-01-11 00:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        $events[] = [
            'title' => 'Melanie Reyes',
            'empleado_id' => '1',
            'start' => '2024-01-11 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        $events[] = [
            'title' => 'José Serrano',
            'empleado_id' => '1',
            'start' => '2024-01-10 07:00:00',
            'allDay' => true,
            'color' => '#CD5C5C'
        ];

        return view('calendar.index', ['events' => $events]);
    }
}
