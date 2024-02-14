<div class=" p-4">
    <div class=" mb-4">
        {{-- @can('accounting.banks.create')  --}}
            <x-button class="" wire:click="create">Nuevo</x-button>
        {{-- @endcan --}}
    </div>

     {{-- Table --}}
     <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto lg:-mx-8 lg:px-8">       
            <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>                            
                            <th class="thead">Nombre</th>                            
                            <th class="thead text-right">Acciones</th>
                        </tr>                        
                    </thead>
                    <tbody class="bg-white">               
                        @if ($areas->count())                                                                                
                            @foreach ($areas as $item)
                                <tr>
                                    <td class="trow">{{ $item->name }}</td>
                                    <td class="trow text-right ">
                                        <button wire:click="edit({{ $item }})" class="action-button">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <button wire:click="delete({{ $item }})" class="action-button">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>   
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center text-gray-400">No hay registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>                
            </div>
        </div>
    </div>

    {{-- create modal --}}
    @include('livewire.areas.partials.create-modal')

    {{-- create modal --}}
    @include('livewire.areas.partials.delete-modal')
</div>

