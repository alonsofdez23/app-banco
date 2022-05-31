<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear cliente
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col items-center">
                    <div class="flex flex-col items-center mt-4">
                        <form method="POST" action="{{ route('clientes.update', $cliente) }}">
                            @csrf
                            @method('PUT')

                            <div>
                                <x-label for="dni" value="DNI" />

                                <x-input
                                id="dni"
                                class="block mt-1 w-full"
                                type="text"
                                name="dni"
                                placeholder="12345678A"
                                value="{{ old('dni', $cliente->dni) }}"
                                autofocus />
                                @error('dni')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <x-label for="nombre" value="Nombre" />

                                <x-input
                                id="nombre"
                                class="block mt-1 w-full"
                                type="text"
                                name="nombre"
                                placeholder="Nombre"
                                value="{{ old('nombre', $cliente->nombre) }}" />
                                @error('nombre')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <x-label for="fnacimiento" value="Fecha Nacimiento" />

                                <x-input
                                id="fnacimiento"
                                class="block mt-1 w-full"
                                type="date"
                                name="fnacimiento"
                                value="{{ old('fnacimiento', $cliente->fnacimiento) }}" />
                                @error('fnacimiento')
                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="flex justify-center mt-4">
                                <x-button>
                                    Submit
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
