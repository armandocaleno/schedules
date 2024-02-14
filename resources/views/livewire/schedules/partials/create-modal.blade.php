<x-dialog-modal wire:model="openCreateModal" maxWidth="lg">
    <x-slot name="title">
        @if ($schedule->id)
            Editar horario
        @else
            Nuevo horario
        @endif
    </x-slot>

    <x-slot name="content">
        <div class=" grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
                <x-label value="Nombre *"/>
                <x-input type="text" placeholder="Nombre del horario" wire:model.defer="name" class="w-full"/>
                <x-input-error for="name" class="mt-2" />
            </div>
            
            <div>
                <x-label value="Inicio *"/>
                <x-input type="time"  wire:model.lazy="schedule.start" class="w-full"/>
                <x-input-error for="recess.start" class="mt-2" />
            </div>

            <div>
                <x-label value="Fin *"/>
                <x-input type="time" wire:model.lazy="schedule.end" class="w-full"/>
                <x-input-error for="schedule.end" class="mt-2" />
            </div>

            <div>
                <x-label value="Salto de día"/>
                <select name="" id="" wire:model="schedule.skip">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
                <x-input-error for="schedule.skip" class="mt-2" />
            </div>

            <div>
                <x-label value="Periodo"/>
                <select name="" id="" wire:model="schedule.period_id">
                    <option value="">Seleccione</option>
                    @foreach ($periods as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <x-input-error for="schedule.period_id" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class=" space-x-4">
            <button type="button" wire:click="save"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >Aceptar
            </button>
   
            <x-secondary-button wire:click="$set('openCreateModal', false)">
                Cerrar
            </x-secondary-button>               
        </div>
    </x-slot>
</x-dialog-modal>