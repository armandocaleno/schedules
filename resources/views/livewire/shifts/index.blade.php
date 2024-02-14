<div class=" p-4">
    <div class="flex justify-between  mb-4">

        {{-- @can('accounting.banks.create')  --}}
        <x-button class="" wire:click="create">Nuevo</x-button>
        {{-- @endcan --}}

        {{-- Per page combobox --}}
        <div class=" flex items-center space-x-2">
            <x-label value="Mostrar " />
            <select name="" class="block border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" wire:model.live="per_page">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
            <x-label value="registros " />
        </div>
    </div>

    {{-- Table --}}
    <div class="flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                <table class="min-w-full border table-auto">
                    <thead>
                        <tr>
                            <th class="thead">Fecha</th>
                            <th class="thead">Empleado</th>
                            <th class="thead min-w-60">Horario</th>
                            <th class="thead">Area</th>
                            <th class="thead">Descanso</th>
                            <th class="thead text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <tr>
                            <td class="trow">
                                <x-input type="date" wire:model.lazy="date" />
                            </td>
                            <td class="trow">
                                <x-input type="text" wire:model.live="employee" />
                            </td>
                            <td class="trow">
                                <select name="" id="" wire:model.live="schedule"
                                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Todos</option>
                                    @foreach ($schedules as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="trow"></td>
                            <td class="trow"></td>
                            <td class="trow"></td>
                        </tr>
                        @if ($shifts->count())
                            @foreach ($shifts as $item)
                                <tr>
                                    <td class="trow">
                                        {{ \Carbon\Carbon::parse($item->date)->locale('es')->translatedFormat('D d M Y') }}
                                    </td>
                                    <td class="trow">
                                        <a href="{{ route('employees.show',  $item->employee) }}">
                                            {{ $item->employee->fullname() }}
                                        </a>
                                    </td>
                                    <td class=" whitespace-nowrap trow">
                                        <div class="grid grid-cols-2 px-6 ">
                                            <div class=" font-bold flex items-center  px-2"><span>{{ $item->schedule->name }}</span></div>
                                            <div class=" text-left">
                                                <table>
                                                    <tr class=" font-medium">
                                                        <td class="px-2">Inicio</td>
                                                        <td class="px-2">Fin</td>
                                                    </tr>
                                                    <tr class=" text-gray-500">
                                                        <td class="px-2">{{ \Carbon\Carbon::parse($item->schedule->start)->format('H:i') }}</td>
                                                        <td class="px-2">{{ \Carbon\Carbon::parse($item->schedule->end)->format('H:i') }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="trow">
                                        @if ($item->area)
                                            {{ $item->area->name }}
                                        @endif
                                    </td>
                                    <td class="trow whitespace-nowrap">
                                        @if ($item->recess)
                                            <ul>
                                                <li class="font-medium">{{ $item->recess->name }}</li>
                                                <li class="text-sm text-gray-500">
                                                    ({{ \Carbon\Carbon::parse($item->recess->start)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($item->recess->end)->format('H:i') }})
                                                </li>
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="trow text-right ">
                                        <button wire:click="edit({{ $item->id }})" class="action-button">
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

    {{-- Pagination --}}
    @if ($shifts->hasPages())
        <div class="px-4 py-4 bg-white border border-gray-200 mt-2 rounded-md shadow-lg">
            {{ $shifts->links() }}
        </div>
    @endif

    {{-- create modal --}}
    @include('livewire.shifts.partials.create-modal')

    {{-- create modal --}}
    @include('livewire.shifts.partials.delete-modal')
</div>
