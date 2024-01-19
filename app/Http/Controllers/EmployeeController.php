<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Shift;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public $employee;

    function show($id)
    {
        $this->employee = Employee::findOrFail($id);
        $shifts = Shift::whereEmployeeId($id)->get();

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
                $end = date("Y-m-d", strtotime($shift->date . "+ 1 days"));
            }

            $rest = trim(strtolower($shift->schedule->period->name));
            if ($rest == 'libre') {
                $allDay = true;
                $color = "#A93226";
            }

            // horario normal
            $events[] = [
                'title' => $shift->employee->name . ' ' . $shift->employee->lastname,
                'start' => $shift->date . " " . $shift->schedule->start,
                'end' => $end . " " . $shift->schedule->end,
                'rol' => $area,
                'color' => $color,
                'allDay' => $allDay
            ];

            // horario de descanso
            if ($shift->recess) {
                $color = '#239B56';
                $events[] = [
                    'title' => 'Descanso ' . $shift->employee->name . ' ' . $shift->employee->lastname,
                    'start' => $shift->date . " " . $shift->recess->start,
                    'end' => $shift->date . " " . $shift->recess->end,
                    'rol' => $area,
                    'color' => $color
                ];
            }
        }

        $shift_today =  $this->employee->getShiftToDate(Carbon::now()->format('Y-m-d'));

        return view('employees.show', ['employee' => $this->employee, 'events' => $events, 'shift_today' => $shift_today]);
    }

    function grafico1(Request $request)
    {
        $this->employee = Employee::findOrFail($request->id);

        $work_night_days = $this->employee->getWorkNightDaysInMonth(Carbon::now()->format('Y-m-d'));
        $work_month_days = $this->employee->getWorkDaysInMonth(Carbon::now()->format('Y-m-d'));
        $work_day_days = $this->employee->getWorkDayDaysInMonth(Carbon::now()->format('Y-m-d'));
        $recess_month_days = $this->employee->getRecessDaysInMonth(Carbon::now()->format('Y-m-d'));

        return response()->json(['work_night_days' => $work_night_days, 'work_month_days' => $work_month_days, 'work_day_days' => $work_day_days,'recess_month_days' => $recess_month_days]);
    }
}
