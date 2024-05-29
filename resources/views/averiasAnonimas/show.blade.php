<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles de la Avería Anónima') }}
            </h2>

            <div class="col text-right">
                <a href="{{ route('averiasAnonimas.index') }}" class="btn btn-primary">Tornar</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative p-6 bg-white border-b border-gray-200">
                    <div class="flex">
                        <div class="w-1/3">
                            <div class="rounded overflow-hidden shadow-lg h-100" style="max-width: 400px; max-height:300px;">
                                @if(isset($averia->imagen))
                                <img src="{{ asset('images/' . $averia->imagen) }}" height="100%" alt="Imagen de la avería">
                                @else
                                <img src="{{ asset('images/NONEPHOTO.png') }}" alt="No hay imagen disponible" style="height: inherit;width: auto;">
                                @endif
                            </div>
                        </div>
                        <div class="w-100 pl-4 relative">
                            <div class="rounded overflow-hidden shadow-lg p-4">
                                <h3 class="font-bold text-xl mb-2">Avís de la incidència: {{ $averia->id }}</h3>
                                <div class="px-6 pt-4 pb-2">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Email: {{ $averia->email }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Data d'inici: {{ $averia->created_at->format('Y-m-d') }}</span>
                                <div class="px-6 pt-4 pb-2">
                                    <h2 class="font-bold text-2xl mb-2 text-blue-600">Descripció:</h2>
                                    <p>{{ $averia->descripcion }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        img {
            max-width: 100% !important;
            height: 100% !important;
        }
    </style>

</x-app-layout>