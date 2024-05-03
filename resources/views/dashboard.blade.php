<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
            <a href="{{ route('tipo-averias.index') }}" class="btn btn-primary">Ver Tipo de Averías</a>
            <a href="{{ route('averias.index') }}" class="btn btn-primary">Ver Incidencias</a>
            <a href="{{ route('sector.index') }}" class="btn btn-primary">Ver Incidencias</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>