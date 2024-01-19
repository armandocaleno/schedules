<?php

namespace App\Livewire\Areas;

use App\Models\Area;
use App\Models\Shift;
use Livewire\Component;

class Index extends Component
{
    public $area, $openCreateModal, $confirmingDeletion, $name;

    //protected $rules = [
     //   'area.name' => 'required|unique:areas,name'
    //];

    public function rules(){
        return [
            'area.name' => 'required|unique:areas,name'
        ];
    }

    public function mount(Area $area)
    {
        $this->area = $area;
        $this->openCreateModal = false;
        $this->confirmingDeletion = false;
    }
    
    public function render()
    {
        $areas = Area::all();
        //dd($areas);
        return view('livewire.areas.index', compact('areas'));
    }

    public function create()
    {
        $this->area = new Area();

        $this->openCreateModal = true;
    }

    public function edit(Area $area)
    {
        $this->area = $area;

        $this->openCreateModal = true;
    }

    public function save()
    {
        //$rules = $this->rules;
        
        //if ($this->area->id) {

        //   $rules = [
        //        'name' => 'required|unique:areas,name,'. $this->area->id,
        //    ];
       // }

       
        $this->validate();
        //dd($rules);
        if ($this->area->id) {
            $this->area->save();

            $this->success('Registro actualizado correctamente.');
        } else {
            Area::create([
                'name' => $this->area->name
            ]);

            $this->success('Registro creado correctamente.');
        }

        $this->openCreateModal = false;
        $this->render();
    }

    public function delete(Area $area)
    {
        
        $this->area = $area;
    
        $this->confirmingDeletion = true;
    }

    public function destroy()
    {
        $shifts = Shift::where('area_id', $this->area->id)->get();

        if ($shifts->count()) {
            $this->info('No se puede eliminar este cargo porque tiene asociado un empleado.');
        }else {
            $this->area->delete();

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
