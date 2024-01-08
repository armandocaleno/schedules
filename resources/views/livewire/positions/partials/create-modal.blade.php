<x-dialog-modal wire:model="openCreateModal" maxWidth="sm">
    <x-slot name="title">
        Nuevo cargo
    </x-slot>

    <x-slot name="content">
        <div>
            <x-label value="Nombre"/>
            <x-input type="text" placeholder="Nombre del cargo" wire:model.defer="position.name" class="w-full"/>
            <x-input-error for="position.name" class="mt-2" />
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