<x-dialog-modal wire:model="openCreateModal" maxWidth="lg">
    <x-slot name="title">
        @if ($employee->id)
            Editar empleado
        @else
            Nuevo empleado
        @endif
    </x-slot>

    <x-slot name="content">
        <div class=" grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
                <x-label value="Nombres *"/>
                <x-input type="text" placeholder="Nombre(s) del empleado" wire:model.defer="employee.name" class="w-full"/>
                <x-input-error for="employee.name" class="mt-2" />
            </div>
            
            <div>
                <x-label value="Apellidos *"/>
                <x-input type="text" placeholder="Apellido(s) del empleado" wire:model.defer="employee.lastname" class="w-full"/>
                <x-input-error for="employee.lastname" class="mt-2" />
            </div>
            
            <div>
                <x-label value="Identificación *"/>
                <x-input type="text" placeholder="No. cédula" wire:model.defer="id_number" class="w-full" 
                onkeypress="return valideKey(event);"
                 maxlength="10"/>
                <x-input-error for="id_number" class="mt-2" />
            </div>

            <div>
                <x-label value="F. nacimiento"/>
                <x-input type="date" wire:model.defer="employee.birthdate" class="w-full"/>
                <x-input-error for="employee.birthdate" class="mt-2" />
            </div>

            <div>
                <x-label value="Email"/>
                <x-input type="email" placeholder="Correo electrónico" wire:model.defer="employee.email" class="w-full"/>
                <x-input-error for="employee.email" class="mt-2" />
            </div>

            <div>
                <x-label value="Cargo *"/>
                <select name="" id="" wire:model.defer="employee.position_id" class="select-input">
                    <option value="">Seleccione</option>
                    @foreach ($positions as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="employee.position_id" class="mt-2" />
            </div>

            <div>
                <x-label value="Config. de horarios *"/>
                <select name="" id="" wire:model.defer="employee.setting_id" class="select-input">
                    <option value="">Seleccione</option>
                    @foreach ($settings as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="employee.setting_id" class="mt-2" />
            </div>

            <div>
                <x-label value="Máx jornadas nocturnas *"/>
                <x-input type="number" min="0" max="30" value="0" wire:model.defer="employee.night_shift_days" class="w-full"/>
                <x-input-error for="employee.night_shift_days" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class=" space-x-4">
            <x-button wire:click="save">
                Aceptar
            </x-button>

            <x-secondary-button wire:click="$set('openCreateModal', false)">
                Cerrar
            </x-secondary-button>               
        </div>
    </x-slot>
</x-dialog-modal>