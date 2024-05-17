<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Registro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative p-6 bg-white border-b border-gray-200">
                    <div class="absolute top-0 right-0 px-3 py-1 rounded-bl-md" style="border-radius: 3vh;margin: 1vh;color: white; background-color: {{ is_null($averia->data_fin) ? '#48BB78' : '#E53E3E' }};">
                        @if(is_null($averia->data_fin))
                        Pendiente
                        @else
                        Finalizada
                        @endif
                    </div>
                    <div class="flex">
                        <div class="w-1/3">
                            <div class="rounded overflow-hidden shadow-lg h-100">
                                @if(isset($averia->imagen))
                                <img class="w-full" src="{{ $averia->imagen }}" alt="Imagen de la avería">
                                @else
                                <img src="https://via.placeholder.com/400" alt="No hay imagen disponible" style="height: inherit;width: auto;"> @endif
                            </div>
                        </div>
                        <div class="w-2/3 pl-4 relative">
                            <div style="position: absolute; top: 0; right: 0; padding: 0.4rem 1rem; border-bottom-left-radius: 0.75rem; color: white; background-color: {{ $averia->prioridad == 'alta' ? '#fd0000' : ($averia->prioridad == 'media' ? '#ed8936' : '#48bb78') }};">
                                Prioridad: {{ ucfirst($averia->prioridad) }}
                            </div>
                            <div class="rounded overflow-hidden shadow-lg p-4">
                                <h3 class="font-bold text-xl mb-2">Código de la Incidencia: {{ $averia->id }}</h3>
                                <div class="px-6 mt-2">
                                    <h2 class="font-bold text-2xl mb-2">INCIDENCIA: {{ $averia->Incidencia }}</h2>
                                </div>

                                <div class="px-6 pt-4 pb-2">
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Fecha de inicio: {{ $averia->data_inicio }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Fecha de fin: {{ $averia->data_fin }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">ID del creador: {{ $averia->creator_id }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">ID del técnico asignado: {{ $averia->tecnico_asignado_id }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">ID de la zona: {{ $averia->zona_id }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">ID del tipo de avería: {{ $averia->tipo_averias_id }}</span>
                                </div>
                                <div class="px-6 pt-4 pb-2">
                                    <h2 class="font-bold text-2xl mb-2 text-blue-600">Descripción:</h2>
                                    <p>{{ $averia->descripcion }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>