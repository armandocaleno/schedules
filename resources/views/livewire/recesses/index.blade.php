<div class=" p-4">
    <div class="flex space-x-2 mb-4 ">
        {{-- New input button --}}
        {{-- @can('payables.payments.create') --}}
        <x-button wire:click="create">Nuevo</x-button>
        {{-- @endcan --}}
    </div>

    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="thead">Nombre</th>
                            <th class="thead">Inicio</th>
                            <th class="thead">Fin</th>
                            <th class="thead">Duración</th>
                            <th class="thead text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if ($recesses->count())
                            @foreach ($recesses as $item)
                                <tr>
                                    <td class="trow">{{ $item->name }}</td>
                                    <td class="trow">{{ $item->start }}</td>
                                    <td class="trow">{{ $item->end }}</td>
                                    <td class="trow">{{ $item->duration }}</td>
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
                                <td colspan="5" class="text-center text-gray-400">No hay registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- create modal --}}
    @include('livewire.recesses.partials.create-modal')

    {{-- create modal --}}
    @include('livewire.recesses.partials.delete-modal')

    @push('js')
        <script>
            function valideKey(evt) {

                // code is the decimal ASCII representation of the pressed key.
                var code = (evt.which) ? evt.which : evt.keyCode;

                if (code == 8) { // backspace.
                    return true;
                } else if (code >= 48 && code <= 57) { // is a number.
                    return true;
                } else { // other keys.
                    return false;
                }
            }
        </script>
    @endpush
</div>
