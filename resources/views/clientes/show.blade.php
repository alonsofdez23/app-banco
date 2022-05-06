<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cliente {{ $cliente->nombre }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex flex-col items-center">
                    <div class="flex flex-col items-center mt-4">
                        <div class="flex flex-col items-center md:flex-row md:max-w-xl">
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $cliente->nombre }}</h5>
                                <p class="mb-3 font-normal text-gray-700">{{ $cliente->dni }}</p>

                                {{-- @foreach ($monografia->articulos as $articulo)
                                <p class="mb-3 font-normal text-gray-700">{{ $articulo->titulo }}</p>
                                @endforeach

                                @if ($monografia->articulos->count() == 0)
                                    <p class="mb-3 font-normal text-gray-700">Esta monografía no contiene artículos</p>
                                @else
                                    <p class="mb-3 font-normal text-gray-700">Numero total de páginas de todos los artículos: <span class="font-bold">{{ $monografia->articulos_sum_num_paginas }}</span></p>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
