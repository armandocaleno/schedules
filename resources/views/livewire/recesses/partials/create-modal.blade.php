<x-dialog-modal wire:model="openCreateModal" maxWidth="lg">
    <x-slot name="title">
        @if ($recess->id)
            Editar descanso
        @else
            Nuevo descanso
        @endif
    </x-slot>

    <x-slot name="content">
        <div class=" grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
                <x-label value="Nombre *"/>
                <x-input type="text" placeholder="Nombre del descanso" wire:model.defer="name" class="w-full"/>
                <x-input-error for="name" class="mt-2" />
            </div>
            
            <div>
                <x-label value="Inicio *"/>
                <x-input type="time"  wire:model.lazy="recess.start" class="w-full"/>
                <x-input-error for="recess.start" class="mt-2" />
            </div>

            <div>
                <x-label value="Fin *"/>
                <x-input type="time" wire:model.lazy="recess.end" class="w-full"/>
                <x-input-error for="recess.end" class="mt-2" />
            </div>

            <div>
                <x-label value="Duración (minutos - máx: {{ $max_time_recess }} )"/>
                <x-input type="number" min="0" max="60" value="0" disabled wire:model.live="duration" class="w-full"/>
                <x-input-error for="duration" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class=" space-x-4">
            <button type="button" wire:click="save" {{ $can_submit ? '' : 'disabled' }}
                            class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >Aceptar
            </button>
   
            <x-secondary-button wire:click="$set('openCreateModal', false)">
                Cerrar
            </x-secondary-button>               
        </div>
    </x-slot>
</x-dialog-modal>