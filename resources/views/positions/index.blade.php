<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cargos
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-6 md:pl-20">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('positions.index')
            </div>
        </div>
    </div>
</x-app-layout>