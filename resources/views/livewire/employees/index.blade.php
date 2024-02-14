<div class=" p-4">
    <div class="flex space-x-2 mb-4 ">
        {{-- Search --}}
        <x-input type="text" class="flex-1" wire:model.live="search" placeholder="Buscar por nombre..." />

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
                            <th class="thead">Identificacion</th>
                            <th class="thead">Cargo</th>
                            <th class="thead">Mail</th>
                            <th class="thead">Fecha nac.</th>
                            <th class="thead">Edad</th>
                            <th class="thead">Jornadas nocturnas</th>
                            <th class="thead text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @if ($employees->count())
                            @foreach ($employees as $item)
                                <tr>
                                    <td class="trow">
                                        <a href="{{ route('employees.show', $item) }}" class=" text-indigo-500">
                                            {{ $item->fullname() }}
                                        </a>
                                    </td>
                                    <td class="trow">{{ $item->id_number }}</td>
                                    <td class="trow">{{ $item->position->name }}</td>
                                    <td class="trow">{{ $item->email }}</td>
                                    <td class="trow">
                                        @if ($item->birthdate)
                                            {{ \Carbon\Carbon::parse($item->birthdate)->format('d-m-Y') }}
                                        @endif
                                    </td>
                                    <td class="trow">{{ $item->age() }}</td>
                                    <td class="trow text-center">{{ $item->night_shift_days }}</td>
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
                                <td colspan="8" class="text-center text-gray-400">No hay registros</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- create modal --}}
    @include('livewire.employees.partials.create-modal')

    {{-- create modal --}}
    @include('livewire.employees.partials.delete-modal')

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
