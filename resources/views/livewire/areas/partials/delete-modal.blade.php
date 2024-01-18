{{-- Delete conformation modal --}}
<x-dialog-modal wire:model="confirmingDeletion" maxWidth="lg">
    <x-slot name="title">
        Eliminar cargo
    </x-slot>

    <x-slot name="content">
        ¿Estás seguro de eliminar este cargo?
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
            Cancelar    
        </x-secondary-button>

        <x-danger-button class="ml-2" wire:click="destroy" wire:loading.attr="disabled">
            Eliminar
        </x-danger-button>
    </x-slot>
</x-dialog-modal> 