<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Turnos
        </h2>
    </x-slot>

    <div class="pt-4 pb-28 sm:pb-4">
        <div class="mx-auto sm:px-6 md:pl-20">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('shifts.index')
            </div>
        </div>
    </div>
</x-app-layout>