<?php

namespace App\Livewire\Employees;

use Illuminate\Validation\Rule;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Setting;
use App\Models\Shift;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search, $employee, $openCreateModal, $confirmingDeletion, $id_number;

    public function rules()
    {
        return [
            'id_number' => ['digits:10', Rule::unique('employees')->ignore($this->employee)],
            'employee.name' => 'required',
            'employee.lastname' => 'required',
            'employee.night_shift_days' => 'required',
            'employee.position_id' => 'required',
            'employee.setting_id' => 'required',
            'employee.birthdate' => 'nullable',
            'employee.email' => 'nullable|email',
        ];
    }

    function mount(Employee $employee) {
        $this->employee = $employee;
        $this->search = "";
        $this->openCreateModal = false;
        $this->confirmingDeletion = false;
    }

    public function render()
    {
        $positions = Position::all();
        $settings = Setting::all();

        $employees = Employee::where(function ($query){
            $query->where('id_number', 'LIKE', $this->search . '%')
                    ->orWhere('lastname', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('name', 'LIKE', '%' . $this->search . '%');
        })->paginate(10);

        return view('livewire.employees.index', compact('employees', 'positions', 'settings'));
    }

    public function create()
    {
        $this->employee = new Employee();
        $this->id_number = null;
        $this->openCreateModal = true;
    }

    public function edit(Employee $employee)
    {
        $this->employee = $employee;
        $this->id_number = $this->employee->id_number;
        $this->openCreateModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->employee->id) {

            $this->employee->save();

            $this->success('Registro actualizado correctamente.');
        } else {
            Employee::create([
                'name' => $this->employee->name,
                'lastname' => $this->employee->lastname,
                'id_number' => $this->id_number,
                'position_id' => $this->employee->position_id,
                'setting_id' => $this->employee->setting_id,
                'night_shift_days' => $this->employee->night_shift_days,
            ]);

            $this->success('Registro creado correctamente.');
        }

        $this->id_number = null;
        $this->openCreateModal = false;
        $this->render();
    }

    public function delete(Employee $employee)
    {
        
        $this->employee = $employee;
    
        $this->confirmingDeletion = true;
    }

    public function destroy()
    {
        $shifts = Shift::where('employee_id', $this->employee->id)->get();

        if ($shifts->count()) {
            $this->info('No se puede eliminar este empleado porque tiene horarios asociados.');
        }else {
            $this->employee->delete();

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
