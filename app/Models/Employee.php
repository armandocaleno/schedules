<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = ['position', 'setting'];

    //Relación uno a muchos inversa
    function position()
    {
        return $this->belongsTo(Position::class);
    }

    //Relacion uno a muchos
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    function setting()
    {
        return $this->belongsTo(Setting::class);
    }

    /**
     *
     * Devuelve @var false si ha completado los turnos nocturnos.
     *
     * @var date
     */
    function canWorkNight($date)
    {
        $response = true;

        if ($this->night_shift_days == 0) {
            $response = false;
        } elseif ($this->night_shift_days <= $this->getWorkNightDaysInMonth($date)) {
            $response = false;
        }

        return $response;
    }

    /**
     *
     * Devuelve @var int los cantidad de días de descanso en la semana.
     *
     * @var date
     */
    function getRecessDaysInWeek($date)
    {
        $current_date = CarbonImmutable::parse($date)->locale('es_Ec');
        $first_day = $current_date->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $last_day = $current_date->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $recess_days = 0;
        $shifts = Shift::whereEmployeeId($this->id)->whereBetween('date', [$first_day, $last_day])->get();

        if ($shifts->count()) {
            foreach ($shifts as $shift) {
                $period = trim(strtolower($shift->schedule->period->name));
                if ($period == 'libre') {
                    $recess_days++;
                }
            }
        }

        return $recess_days;
    }

    /**
     *
     * Devuelve @var int la cantidad de días laborados en la semana.
     *
     * @var date
     */
    function getWorkDaysInWeek($date)
    {
        $current_date = CarbonImmutable::parse($date)->locale('es_Ec');
        $first_day = $current_date->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $last_day = $current_date->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $work_days = 0;
        $shifts = Shift::whereEmployeeId($this->id)->whereBetween('date', [$first_day, $last_day])->get();

        if ($shifts->count()) {
            foreach ($shifts as $shift) {
                $period = trim(strtolower($shift->schedule->period->name));
                if ($period != 'libre') {
                    $work_days++;
                }
            }
        }

        return $work_days;
    }

    /**
     *
     * Devuelve @var int la cantidad de turnos nocturnos laborados en el mes.
     *
     * @var date
     */
    function getWorkNightDaysInMonth($date)
    {
        $current_date = CarbonImmutable::parse($date)->locale('es_Ec');
        $first_day = $current_date->startOfMonth()->format('Y-m-d');
        $last_day = $current_date->endOfMonth()->format('Y-m-d');
        $work_days = 0;
        $shifts = Shift::whereEmployeeId($this->id)->whereBetween('date', [$first_day, $last_day])->get();

        if ($shifts->count()) {
            foreach ($shifts as $shift) {
                $period = trim(strtolower($shift->schedule->period->name));
                if ($period == 'noche') {
                    $work_days++;
                }
            }
        }

        return $work_days;
    }

    /**
     *
     * Devuelve @var true si ha completado los días de descanso en la semana.
     *
     * @var date
     */
    function hasCompletedTotalRecessDays($date)
    {
        $response = false;

        if ($this->getRecessDaysInWeek($date) >= $this->setting->total_days_recess_week) {
            $response = true;
        }

        return $response;
    }

    /**
     *
     * Devuelve @var true si ha completado los días laborados en la semana.
     *
     * @var date
     */
    function hasCompletedTotalWorkDays($date)
    {
        $response = false;

        if ($this->getWorkDaysInWeek($date) >= $this->setting->total_days_week) {
            $response = true;
        }

        return $response;
    }

    /**
     *
     * Devuelve @var int la cantidad de turnos del día.
     *
     * @var date
     */
    function getShiftToDate($date)
    {
        $shifts = Shift::whereEmployeeId($this->id)->where('date', $date)->count();

        return $shifts;
    }

    /**
     *
     * Devuelve @var true si ya tiene asignado un turno en el día.
     *
     * @var date
     */
    function hasAssignedShiftToday($date)
    {
        $response = false;

        if ($this->getShiftToDate($date) > 0) {
            $response = true;
        }

        return $response;
    }

    /**
     *
     * Devuelve @var true si puede agregar un dia libre en la fecha indicada.
     * Validando que si ya tiene un día libre se añada uno consecutivo.
     * @var date
     */
    function consecutiveRecess($date)
    {
        $response = false;

        if (!$this->hasCompletedTotalRecessDays($date)) {
            if ($this->getRecessDaysInWeek($date) >= 1) {
                $current_date = CarbonImmutable::parse($date)->locale('es_Ec');
                $first_day = $current_date->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
                $last_day = $current_date->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

                $shifts = Shift::whereEmployeeId($this->id)->whereBetween('date', [$first_day, $last_day])->get();

                foreach ($shifts as $shift) {
                    $period = trim(strtolower($shift->schedule->period->name));
                    if ($period == 'libre') {
                        $recess_day = CarbonImmutable::parse($shift->date)->locale('es_Ec');

                        $next = $recess_day->addDay();
                        $previus = $recess_day->subDay();
                        if ($current_date == $next) {
                            $response = true;
                        } elseif ($current_date == $previus) {
                            $response = true;
                        }
                    }
                }
            }else {
                $response = true;
            }
        }

        return $response;
    }

    function maxRestEmployeesInDayComplete($date) {
        $response = false;
        $shifts = Shift::where('date', $date)->get();
        $maxRestEmployess = GlobalSettings::first()->max_rest_employees_in_day;
        $rest_employees = 0;
        if ($shifts->count()) {
            foreach ($shifts as $shift) {
                $period = trim(strtolower($shift->schedule->period->name));
                if ($period == 'libre') {
                    $rest_employees++;
                }
            }
        }

        if ($rest_employees >= $maxRestEmployess) {
            $response = true;
        }

        return $response;
    }
}
