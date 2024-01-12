<?php

namespace App\Livewire\Shifts;

use Livewire\WithPagination;
use App\Models\Area;
use App\Models\Employee;
use App\Models\Period;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\Shift;
use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $shift, $openCreateModal, $confirmingDeletion, $per_page;
    public $date, $employee, $schedule, $recesses;

    protected $rules = [
        'shift.date' => 'required',
        'shift.employee_id' => 'required',
        'shift.schedule_id' => 'required',
        'shift.area_id' => 'nullable',
        'shift.recess_id' => 'nullable',
    ];

    public function mount(shift $shift)
    {
        $this->shift = $shift;
        $this->per_page = '5';
        $this->openCreateModal = false;
        $this->confirmingDeletion = false;
    }

    public function render()
    {
        $employees = Employee::all();
        $schedules = Schedule::all();
        $areas = Area::all();

        $shifts = Shift::join('employees', 'shifts.employee_id', 'employees.id')
            ->when($this->date, function ($query) {
                return $query->where('date', $this->date);
            })->when($this->employee, function ($query) {
                return $query->where('employees.name', 'like', '%' . $this->employee . '%')
                    ->orWhere('employees.lastname', 'like', '%' . $this->employee . '%');
            })
            ->when($this->schedule, function ($query) {
                return $query->where('schedule_id', $this->schedule);
            })->orderBy('shifts.date', 'desc')->select('shifts.*')->paginate($this->per_page);

        return view('livewire.shifts.index', compact('shifts', 'employees', 'schedules', 'areas'));
    }

    // reset de paginacion para encontrar valores en otras paginas ademas de la actual
    function updatedEmployee()
    {
        $this->resetPage();
    }

    function updatedDate()
    {
        $this->resetPage();
    }

    function updatedSchedule()
    {
        $this->resetPage();
    }

    function updatedShiftScheduleId($value)
    {
        $schedule = Schedule::find($value);
        $this->recesses = $schedule->recesses;
    }

    // crea una nueva instancia y abre modal para crear nuevo turno
    public function create()
    {
        $this->shift = new Shift();
        $this->shift->date = \Carbon\Carbon::now()->format('Y-m-d');

        $this->openCreateModal = true;
    }

    // abre modal para editar un turno
    public function edit(Shift $shift)
    {
        $this->shift = $shift;
        $this->openCreateModal = true;
    }

    public function save()
    {
        $rules = $this->rules;

        $this->validate($rules);

        // obtiene el empleado actual
        $employee = Employee::find($this->shift->employee_id);
        // dd($employee->maxRestEmployeesInDayComplete($this->shift->date));
        // obtiene el periodo del turno actual
        $period = Period::find($this->shift->schedule->period_id);

        // valida las configuracion de dias laborados, descansos y horarios nocturnos
        $p = trim(strtolower($period->name));
    
        if ($employee->hasAssignedShiftToday($this->shift->date)) {
            $this->info('Este empleado ya tiene asignado un turno en este día.');
            return;
        }

        if ($p == 'libre') {
            if ($employee->hasCompletedTotalRecessDays($this->shift->date)) {
                $this->info('Este empleado ha completado los días de descanso en esta semana.');
                return;
            }
            if ($employee->setting->recess_days_consecutive == Setting::CONSECUTIVE_RECESS_DAYS) {
                if (!$employee->consecutiveRecess($this->shift->date)) {
                    $this->info('Los días libre deben ser consecutivos. Este empleado ya tiene un día libre en esta semana.');
                    return;
                }
            }
            if ($employee->maxRestEmployeesInDayComplete($this->shift->date)) {
                $this->info('Se ha completado el número máximo de empleados con descanso en este día.');
                return;
            }
        } elseif ($p == 'noche') {
            if (!$employee->canWorkNight($this->shift->date)) {
                $this->info('Este empleado ha completado los días de horario nocturno en este mes.');
                return;
            }
        } else {
            if ($employee->hasCompletedTotalWorkDays($this->shift->date)) {
                $this->info('Este empleado ha completado el total de días laborables en esta esta semana.');
                return;
            }
        }

        // si es un objeto existente lo actualiza sino crea uno nuevo
        if ($this->shift->id) {
            $this->shift->save();

            $this->success('Registro actualizado correctamente.');
        } else {
            Shift::create([
                'date' => $this->shift->date,
                'employee_id' => $this->shift->employee_id,
                'schedule_id' => $this->shift->schedule_id,
                'area_id' => $this->shift->area_id,
                'recess_id' => $this->shift->recess_id,
            ]);

            $this->success('Registro creado correctamente.');
        }

        $this->openCreateModal = false; // cierra modal de creacion de turnos

        // renderiza el componente de livewire para actualizar la informacion agregada o modificada
        $this->render();
    }

    // abre modal de confirmacion para eliminar objeto seleccionado
    public function delete(Shift $shift)
    {
        $this->shift = $shift;
        $this->confirmingDeletion = true;
    }

    // elimina el objeto de la base de datos, envía el mensaje al usuario y cierra el modal.
    public function destroy()
    {
        $this->shift->delete();

        $this->success('Registro eliminado correctamente.');
        $this->render();

        $this->confirmingDeletion = false;
    }

    // Mensaje de confirmación de acción
    public function success($message)
    {
        $this->dispatch('success', message: $message);
    }

    // Mensaje de confirmación de acción
    public function info($message)
    {
        $this->dispatch('info', message: $message);
    }
}
