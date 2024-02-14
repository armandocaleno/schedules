<?php

namespace App\Livewire\Schedules;

use Illuminate\Validation\Rule;
use App\Models\Period;
use App\Models\Schedule;
use App\Models\Shift;
use Livewire\Component;

class Index extends Component
{
    public $schedule, $name, $confirmingDeletion, $openCreateModal;

    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('schedules')->ignore($this->schedule)],
            'schedule.start' => 'required',
            'schedule.end' => 'required',
            'schedule.skip' => 'required',
            'schedule.period_id' => 'required'
        ];
    }

    function mount(Schedule $schedule)
    {
        $this->schedule = $schedule;
        $this->confirmingDeletion = false;
        $this->openCreateModal = false;
    }

    public function render()
    {
        $periods = Period::all();
        $schedules = Schedule::all();

        return view('livewire.schedules.index', compact('periods', 'schedules'));
    }

    public function create()
    {
        $this->schedule = new Schedule();
        $this->name = null;
        $this->schedule->skip = 0;
        $this->resetValidation();
        $this->openCreateModal = true;
    }

    public function edit(Schedule $schedule)
    {
        $this->resetValidation();
        $this->schedule = $schedule;
        $this->name = $this->schedule->name;
        $this->openCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->schedule->id) {
            $this->schedule->name = $this->name;
            $this->schedule->save();

            $this->success('Registro actualizado correctamente.');
        } else {
            Schedule::create([
                'name' => $this->name,
                'start' => $this->schedule->start,
                'end' => $this->schedule->end,
                'skip' => $this->schedule->skip,
                'period_id' => $this->schedule->period_id
            ]);

            $this->success('Registro creado correctamente.');
        }

        $this->name = null;
        $this->openCreateModal = false;
        $this->render();
    }

    public function delete(Schedule $schedule)
    {
        $this->schedule = $schedule;
        $this->confirmingDeletion = true;
    }

    public function destroy()
    {
        $shifts = Shift::where('schedule_id', $this->schedule->id)->get();

        if ($shifts->count()) {
            $this->info('No se puede eliminar este horario porque tiene turnos asociados.');
        } else {
            $this->schedule->delete();

            $this->success('Registro eliminado correctamente.');
            $this->render();
        }

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
