<x-dialog-modal wire:model="openCreateModal" maxWidth="sm">
    <x-slot name="title">
        Nuevo turno
    </x-slot>

    <x-slot name="content">
        <div class="grid grid-cols-1 gap-4">
            <div>
                <x-label value="Fecha *" />
                <x-input type="date" placeholder="Nombre del cargo" wire:model.change="shift.date" class="w-full" />
                <x-input-error for="shift.date" class="mt-2" />
            </div>

            <div>
                <x-label value="Empleado *" />
                <select name="" id="" wire:model.change="shift.employee_id"
                    class=" w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Seleccione</option>
                    @foreach ($employees as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->lastname }}</option>
                    @endforeach
                </select>
                <x-input-error for="shift.employee_id" class="mt-2" />
            </div>

            <div>
                <x-label value="Horario *" />
                <select name="" id="" wire:model.change="shift.schedule_id"
                    class=" w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Seleccione</option>
                    @foreach ($schedules as $item)
                        <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->start }} -
                            {{ $item->end }})</option>
                    @endforeach
                </select>
                <x-input-error for="shift.schedule_id" class="mt-2" />
            </div>

            <div>
                <x-label value="Area" />
                <select name="" id="" wire:model.change="shift.area_id"
                    class=" w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Seleccione</option>
                    @foreach ($areas as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="shift.area_id" class="mt-2" />
            </div>

            <div>
                <x-label value="Descanso" />
                <select name="" id="" wire:model.change="shift.recess_id"
                    class=" w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="">Seleccione</option>
                    @if (!is_null($recesses))
                        @foreach ($recesses as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->start }} -
                                {{ $item->end }})</option>
                        @endforeach
                    @endif
                </select>
                <x-input-error for="shift.recess_id" class="mt-2" />
            </div>
            <div>
                <span>( * ) Obligatorio</span>
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
