<?php

namespace App\Livewire\Recesses;

use Illuminate\Validation\Rule;
use App\Models\Recess;
use App\Models\Shift;
use Livewire\Component;

class Index extends Component
{
    public $recess, $name, $duration, $confirmingDeletion, $openCreateModal, $can_submit;
    public $max_time_recess = 60;

    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('recesses')->ignore($this->recess)],
            'recess.start' => 'required',
            'recess.end' => 'required',
            'duration' => 'required',
        ];
    }

    function mount(Recess $recess)
    {
        $this->recess = $recess;
        $this->confirmingDeletion = false;
        $this->openCreateModal = false;
        $this->can_submit = false;
    }

    public function render()
    {
        $recesses = Recess::all();
        return view('livewire.recesses.index', compact('recesses'));
    }

    function updatedRecessStart()
    {
        $this->duration = 0;
        if ($this->recess->end) {
            $this->enableButton();
        }
    }

    function updatedRecessEnd()
    {
        $this->duration = 0;
        if ($this->recess->start) {
           $this->enableButton();
        }
    }

    function enableButton(){
        if ($this->recess->start < $this->recess->end) {
            $star = \Carbon\Carbon::create($this->recess->start);
            $end = \Carbon\Carbon::create($this->recess->end);
            $diff = $star->diffInMinutes($end);
            $this->duration = $diff;

            if ($this->duration > $this->max_time_recess) {
                $this->info('El tiempo máximo de descanso es de' . $this->max_time_recess . ' minutos.');
            }
            
        } else {
            $this->info("La hora de inicio debe ser menor a la hora final.");
        }

        if ($this->duration > 0 && $this->duration <= $this->max_time_recess) {
            $this->can_submit = true;
        } else {
            $this->can_submit = false;
        }
    }

    public function create()
    {
        $this->recess = new Recess();
        $this->name = null;
        $this->duration = 0;
        $this->resetValidation();
        $this->openCreateModal = true;
    }

    public function edit(Recess $recess)
    {
        $this->recess = $recess;
        $this->name = $this->recess->name;
        $this->duration = $this->recess->duration;
        $this->openCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->recess->id) {
            $this->recess->name = $this->name;
            $this->recess->duration = $this->duration;
            $this->recess->save();

            $this->success('Registro actualizado correctamente.');
        } else {
            Recess::create([
                'name' => $this->name,
                'start' => $this->recess->start,
                'end' => $this->recess->end,
                'duration' => $this->duration
            ]);

            $this->success('Registro creado correctamente.');
        }

        $this->name = null;
        $this->duration = 0;
        $this->openCreateModal = false;
        $this->render();
    }

    public function delete(Recess $recess)
    {
        $this->recess = $recess;
        $this->confirmingDeletion = true;
    }

    public function destroy()
    {
        $shifts = Shift::where('recess_id', $this->recess->id)->get();

        if ($shifts->count()) {
            $this->info('No se puede eliminar este descanso porque tiene horarios asociados.');
        } else {
            $this->recess->delete();

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
