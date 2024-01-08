<?php

namespace App\Livewire\Positions;

use App\Models\Employee;
use App\Models\Position;
use Livewire\Component;

class Index extends Component
{
    public $position, $openCreateModal, $confirmingDeletion, $name;

    protected $rules = [
        'position.name' => 'required|unique:positions,name'
    ];

    public function mount(Position $position)
    {
        $this->position = $position;
        $this->openCreateModal = false;
        $this->confirmingDeletion = false;
    }

    public function render()
    {
        $positions = Position::all();

        return view('livewire.positions.index', compact('positions'));
    }

    public function create()
    {
        $this->position = new Position();

        $this->openCreateModal = true;
    }

    public function edit(Position $position)
    {
        $this->position = $position;

        $this->openCreateModal = true;
    }

    public function save()
    {
        $rules = $this->rules;

        if ($this->position->id) {

            $rules = [
                'name' => 'required|unique:positions,name,'. $this->position->id,
            ];
        }

        $this->validate($rules);

        if ($this->position->id) {
            $this->position->save();

            $this->success('Registro actualizado correctamente.');
        } else {
            Position::create([
                'name' => $this->position->name
            ]);

            $this->success('Registro creado correctamente.');
        }

        $this->openCreateModal = false;
        $this->render();
    }

    public function delete(Position $position)
    {
        
        $this->position = $position;
    
        $this->confirmingDeletion = true;
    }

    public function destroy()
    {
        $employees = Employee::where('position_id', $this->position->id)->get();

        if ($employees->count()) {
            $this->info('No se puede eliminar este cargo porque tiene asociado un empleado.');
        }else {
            $this->position->delete();

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
