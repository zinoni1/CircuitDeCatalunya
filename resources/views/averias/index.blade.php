<x-app-layout>



    <div class="modul-fluid container-fluid p-3">
        <div class="row">
            <div class="col align-self-center">
                <h1>Incidencies</h1>
            </div>
            <div class="col text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Crear Incidencia</button>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="form-id" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myLargeModalLabel">Crear Averia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Add form elements for creating a new averia -->
                        @csrf
                        <input type="hidden" id="id" name="creator_id" value="{{ Auth::id() }}">
                        <div class="form-group">
                            <label for="Incidencia">Incidencia</label>
                            <input type="text" class="form-control" id="Incidencia" name="Incidencia" placeholder="Incidencia">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="data_inicio">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="prioridad">Prioridad</label>
                            <select class="form-control" id="prioridad" name="prioridad">
                                <option value="alta">Alta</option>
                                <option value="media">Media</option>
                                <option value="baja">Baja</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen">
                        </div>
                        <div class="form-group">
                            <label for="tecnico_asignado_id">Técnico Asignado ID</label>
                            <select class="form-control" id="tecnico_asignado_id" name="tecnico_asignado_id">
                                @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zona_id">Zona</label>
                            <select class="form-control" id="zona_id" name="zona_id">
                                @foreach($Zonas as $zona)
                                <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_averias_id">Tipo Averia</label>
                            <select class="form-control" id="tipo_averias_id" name="tipo_averias_id">
                                @foreach($tipoAverias as $tipoAveria)
                                <option value="{{ $tipoAveria->id }}">{{ $tipoAveria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div>
        <label for="filter-data-fin">Mostrar solo registros con fecha en data_fin</label>
        <input type="checkbox" id="filter-data-fin">
    </div>
    <div>
        <label for="filter-data-inici-start">Mostrar registros con data_inici después de</label>
        <input type="date" id="filter-data-inici-start">
    </div>
    <div>
        <label for="filter-data-inici-end">y antes de</label>
        <input type="date" id="filter-data-inici-end">
    </div>
    
    <div class="mx-3">
        <div id="my-table"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Pasar los datos de PHP a JavaScript
        let averias = @json($averias);
        // Convertir los datos al formato que necesita grid.js
        let data = averias.map(averia => [
            averia.id,
            averia.Incidencia,
            averia.tipo_averia ? averia.tipo_averia.nombre : '', // Asegúrate de que 'nombre' es la propiedad correcta
            averia.prioridad,
            averia.data_inicio,
            averia.data_fin === null ?
            gridjs.html(`<select class="form-select" data-id="${averia.id}">
    <option selected>Pendiente</option>
    <option>Finalizado</option>
    </select>`) :
            averia.data_fin,
            averia.tecnico ? averia.tecnico.name : '', // Cambiado 'nombre' a 'name'
            averia.zona ? averia.zona.nombre : '', // Asegúrate de que 'nombre' es la propiedad correcta
        ]);

        let table = new gridjs.Grid({
            columns: [
                "ID",
                "Incidencia",
                "Tipo Averia",
                "Prioridad",
                "Inicio",
                "Estado",
                "Tecnico",
                "Zona",
                {
                    name: "Acciones",
                    width: '100vh',
                    formatter: (cell, row) => {
                        return gridjs.h('div', {}, [
                            gridjs.h('button', {
                                className: 'more-info',
                                'data-id': row.cells[0].data,
                                onclick: (event) => {
                                    window.location.href = '/averias/' + row.cells[0].data;
                                }
                            }, [
                                gridjs.h('svg', { // Nuevo icono de edición
                                    xmlns: 'http://www.w3.org/2000/svg',
                                    viewBox: '0 0 24 24',
                                    fill: 'none',
                                    stroke: 'currentColor',
                                    strokeWidth: '1.5',
                                    className: 'w-6 h-6'
                                }, [
                                    gridjs.h('path', {
                                        strokeLinecap: 'round',
                                        strokeLinejoin: 'round',
                                        d: 'm11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z'
                                    })
                                ])
                            ]),
                            gridjs.h('button', {
                                className: 'delete-button text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500',
                                'data-id': row.cells[0].data,
                                onclick: (event) => {
                                    event.preventDefault();
                                    var id = event.currentTarget.getAttribute('data-id');

                                    $.ajax({
                                        url: '/averias/' + id,
                                        type: 'DELETE',
                                        data: {
                                            _token: "{{ csrf_token() }}",
                                        },
                                        success: function(response) {
                                            if (response.success) {
                                                deleteRow(id);
                                            } else {
                                                alert('Error al eliminar el registro');
                                            }
                                        }
                                    });
                                }
                            }, gridjs.h('svg', {
                                xmlns: "http://www.w3.org/2000/svg",
                                fill: "none",
                                viewBox: "0 0 24 24",
                                stroke: "currentColor",
                                class: "w-6 h-6"
                            }, gridjs.h('path', {
                                strokeLinecap: "round",
                                strokeLinejoin: "round",
                                d: "m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            })))
                        ]);
                    }
                }
            ],
            data: data,
            sort: true,
            search: true,
            className: {
                table: 'table'
            },
            pagination: {
                limit: 5,
                server: false // Desactivar la paginación del lado del servidor
            },
            language: {
                'search': {
                    'placeholder': 'Cerca...'
                },
                'pagination': {
                    'previous': 'Anterior',
                    'next': 'Següent',
                    'showing': 'Mostrant',
                    'results': () => 'Resultats'
                }
            }
        });
        // Agregar controlador de eventos después de que la tabla se haya renderizado
        $(document).on('change', '.form-select', function() {
            let select = $(this);
            let id = select.data('id');
            console.log(id);
            let estado = select.val();

            if (estado === 'Finalizado') {
                $.ajax({
                    url: '/averias/' + id + '/data_fin',
                    type: 'PUT',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data_fin: new Date().toISOString().slice(0, 10) // Fecha actual en formato YYYY-MM-DD
                    },
                    success: function(response) {
                        if (response.success) {
                            // Actualizar la celda para mostrar la fecha actual
                            select.replaceWith(new Date().toISOString().slice(0, 10));
                        } else {
                            alert('Error al actualizar el registro');
                        }
                    }
                });
            }
        });
        // Renderizar la tabla
        table.render(document.getElementById("my-table"));

        // Función para eliminar una fila
        function deleteRow(id) {
            // Aquí puedes agregar el código para eliminar la fila de la base de datos
            console.log('Eliminar fila con ID:', id);

            // Forzar a la tabla a volver a renderizarse
            table.forceRender();
        }
        $(document).ready(function() {
            $('#form-id').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '/averias',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        location.reload();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });

        // Función para eliminar una fila
        function deleteRow(id) {
            averias = averias.filter(averia => averia.id != id);
            data = averias.map(averia => [averia.id, averia.Incidencia, averia.Tipo_averias_id, averia.prioridad, averia.data_inicio, averia.data_fin, averia.tecnico_asignado_id, averia.zona_id]);
            table.updateConfig({
                data: data
            }).forceRender();
        }

        // Controlador de eventos para el formulario de creación
        $(document).ready(function() {
            // Obtener los datos iniciales de la tabla del servidor
            $.ajax({
                url: '/averias',
                type: 'GET',
                success: function(response) {
                    // Comprobar si response.averias es un array
                    if (response && Array.isArray(response.averias)) {
                        // Actualizar la tabla con los datos recibidos
                        const data = response.averias.map(averia => [averia.id, averia.Incidencia, averia.Tipo_averias_id, averia.prioridad, averia.data_inicio, averia.data_fin, averia.tecnico_asignado_id, averia.zona_id]);
                        table.updateConfig({
                            data
                        }).forceRender();
                    }
                }
            });
        });
    </script>
</x-app-layout>