<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nuevo usuario
        </h2>
    </x-slot>

    <div class="py-4 mx-auto sm:px-6 md:pl-20">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-4 grid grid-cols-1 md:grid-cols-3">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <x-label value="Nombre" />
                        <x-input type="text" name="name" class="mt-1 block w-full" :value="old('name')" autofocus />
                        <x-input-error for="name" class="mt-2" />
                    </div>
        
                    <!-- Email -->
                    <div class="mb-4">
                        <x-label value="Correo electrónico" />
                        <x-input type="email" name="email" class="mt-1 block w-full" :value="old('email')" />
                        <x-input-error for="email" class="mt-2" />
                    </div>
        
                    <!-- Password -->
                    <div class="mb-4">
                        <x-label value="Contraseña" />
                        <x-input type="password" name="password" class="mt-1 block w-full" />
                        <x-input-error for="password" class="mt-2" />
                    </div>
        
                    {{-- password_confirmation --}}
                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input class="block mt-1 w-full" type="password" name="password_confirmation" />
                        <x-input-error for="password_confirmation" class="mt-2" />
                    </div>
        
                    {{-- Rol --}}
                    <div class="mt-4">
                        <x-label value="Roles" />
                        <div class="my-2">
                            @foreach ($roles as $item)
                                <label class="block font-medium text-sm text-gray-700">
                                    <input type="checkbox" class="mr-2" name="roles[]" value="{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
        
                    <div class="mt-4 text-right">
                        <x-button type="submit">
                            Aceptar
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
