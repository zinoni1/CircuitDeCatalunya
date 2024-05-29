<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalles del Registro') }}
            </h2>

            <div class="col text-right">
                <a href="{{ route('averias.index') }}" class="btn btn-primary">Tornar</a>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Editar</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative p-6 bg-white border-b border-gray-200">
                    <div class="absolute top-0 right-0 px-3 py-1 rounded-bl-md" style="border-radius: 3vh;margin: 1vh;color: white; background-color: {{ is_null($averia->data_fin) ? '#ed8936' : '#48BB78' }};">
                        @if(is_null($averia->data_fin))
                        Pendent
                        @else
                        Finalitzada
                        @endif
                    </div>
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
                        <div class="w-2/3 pl-4 relative">
                            <div style="position: absolute; top: 0; right: 0; padding: 0.4rem 1rem; border-bottom-left-radius: 0.75rem; color: white; background-color: {{ $averia->prioridad == 'alta' ? '#fd0000' : ($averia->prioridad == 'media' ? '#ed8936' : '#48bb78') }};">
                                Prioritat: {{ ucfirst($averia->prioridad) }}
                            </div>
                            <div class="rounded overflow-hidden shadow-lg p-4">
                                <h3 class="font-bold text-xl mb-2">Codi de la Incidència: {{ $averia->id }}</h3>
                                <div class="px-6 mt-2">
                                    <h2 class="font-bold text-2xl mb-2">INCIDÈNCIA: {{ $averia->Incidencia }}</h2>
                                </div>

                                <div class="px-6 pt-4 pb-2">
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Data d'inici: {{ $averia->data_inicio }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Data de fi: {{ $averia->data_fin }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Creador: {{ $averia->creator->name }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Tècnic assignat: {{ $averia->tecnico->name }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Zona: {{ $averia->zona->nombre }}</span>
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Tipus d'avaria: {{ $averia->tipo_averia->nombre }}</span>
                                </div>
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

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="form-id" method="post" action="{{ route('averias.update', $averia->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Editar Avaria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="creator_id" value="{{ Auth::id() }}">
                        <div class="form-group">
                            <label for="Incidencia">Incidència</label>
                            <input type="text" class="form-control" id="Incidencia" name="Incidencia" placeholder="Incidencia" value="{{ $averia->Incidencia }}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripció</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $averia->descripcion }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="data_inicio">Data d'inici</label>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="{{ $averia->data_inicio }}">
                        </div>
                        <div class="form-group">
                            <label for="data_fin">Data de fi</label>
                            <input type="date" class="form-control" id="data_fin" name="data_fin" value="{{ $averia->data_fin }}">
                        </div>
                        <div class="form-group">
                            <label for="prioridad">Prioritat</label>
                            <select class="form-control" id="prioridad" name="prioridad">
                                <option value="alta" {{ $averia->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
                                <option value="media" {{ $averia->prioridad == 'media' ? 'selected' : '' }}>Mitja</option>
                                <option value="baja" {{ $averia->prioridad == 'baja' ? 'selected' : '' }}>Baixa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imatge</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                        </div>
                        <div class="form-group">
                            <label for="tecnico_asignado_id">Tècnic Assignat ID</label>
                            <select class="form-control" id="tecnico_asignado_id" name="tecnico_asignado_id">
                                @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $averia->tecnico_asignado_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zona_id">Zona</label>
                            <select class="form-control" id="zona_id" name="zona_id">
                                @foreach($Zonas as $zona)
                                <option value="{{ $zona->id }}" {{ $averia->zona_id == $zona->id ? 'selected' : '' }}>{{ $zona->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_averias_id">Tipus Avaria</label>
                            <select class="form-control" id="tipo_averias_id" name="tipo_averias_id">
                                @foreach($tipoAverias as $tipoAveria)
                                <option value="{{ $tipoAveria->id }}" {{ $averia->tipo_averias_id == $tipoAveria->id ? 'selected' : '' }}>{{ $tipoAveria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel·lar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
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