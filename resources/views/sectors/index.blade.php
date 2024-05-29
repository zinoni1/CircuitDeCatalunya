<x-app-layout>
    <div class="modul container p-3">
        <div class="row w-100">
            <div class="col-auto d-flex align-items-center">
                <h1>sectors</h1>
            </div>
            <div class="col text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target=".bd-example-modal-lg">Crear Sector</button>
            </div>
        </div>
    </div>

    <div class="mx-5">
        <div id="my-table"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Sector</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="form-group">
                            <label for="editNombre">Nombre del Sector</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" required>
                            <select class="form-control" id="zona_id" name="zona_id">
                                @foreach($zonas as $zona)
                                    <option value="{{ $zona->id }}">
                                        {{ $zona->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="editId" name="id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                    <button type="button" class="btn btn-primary" id="saveButton">Guardar canvis</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('sectors.store') }}" method="POST">
                    @csrf
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                    <label for="zona_id">Zona:</label>
                    <select id="zona_id" name="zona_id">
                        @foreach ($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nombre }}</option>
                        @endforeach
                    </select>
                    <label for="">
                        <div class="col-auto d-flex align-items-center">
                            <button type="submit" class="w-100 btn btn-primary">Crear</button>
                        </div>
                    </label>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Pasar los datos de PHP a JavaScript
        let sectors = @json($sectors);

        // Convertir los datos al formato que necesita grid.js
        let data = sectors.map(sector => [sector.id, sector.nombre, sector.zona.nombre]);

        let table = new gridjs.Grid({
            columns: ["ID", "Nombre", "Zona ID", {
                name: "Acciones",
                width: '60vh',
                formatter: (cell, row) => {
                    return gridjs.h('div', {}, [
                        gridjs.h('button', {
                            className: 'edit-button',
                            'data-id': row.cells[0].data,
                            'data-toggle': 'modal',
                            'data-target': '#editModal',
                            onclick: (event) => {
                                event.preventDefault();
                                var id = event.currentTarget.getAttribute('data-id');
                                var name = row.cells[1].data;

                                // Establece el ID y el nombre del sector en el modal
                                document.getElementById('editNombre').value = name;
                                document.getElementById('editId').value = id;
                            }
                        }, [
                            gridjs.h('svg', { // Nuevo icono de edición
                                xmlns: 'http://www.w3.org/2000/svg',
                                viewBox: '0 0 20 20',
                                fill: 'currentColor',
                                className: 'w-5 h-5'
                            }, [
                                gridjs.h('path', {
                                    d: 'm5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z'
                                }),
                                gridjs.h('path', {
                                    d: 'M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z'
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
                                    url: '/sectors/' + id,
                                    type: 'DELETE',
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                    },
                                    success: function (response) {
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
            }],
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

        // Renderizar la tabla
        table.render(document.getElementById("my-table"));

        // Función para eliminar una fila
        function deleteRow(id) {
            // Aquí puedes agregar el código para eliminar la fila de la base de datos
            console.log('Eliminar fila con ID:', id);

            // Forzar a la tabla a volver a renderizarse
            table.forceRender();
        }

        // Función para agregar una fila
        function addRow(id, nombre) {
            const data = table.config.data;
            data.push([id, nombre, sector.zona.nombre]);
            table.updateConfig({
                data
            }).forceRender();
        }

        // Función para eliminar una fila
        function deleteRow(id) {
            sectors = sectors.filter(sector => sector.id != id);
            data = sectors.map(sector => [sector.id, sector.nombre, sector.zona.nombre]);
            table.updateConfig({
                data: data
            }).forceRender();
        }

        // Controlador de eventos para el formulario de creación
        $(document).ready(function () {
            // Obtener los datos iniciales de la tabla del servidor
            $.ajax({
                url: '/sectors',
                type: 'GET',
                success: function (response) {
                    // Comprobar si response.zonas es un array
                    if (response && Array.isArray(response.sectors)) {
                        // Actualizar la tabla con los datos recibidos
                        const data = response.zonas.map(sector => [sectors.id, sectors.nombre, sector.zona.nombre]);
                        table.updateConfig({
                            data
                        }).forceRender();
                    }
                }
            });
        });

        $('#saveButton').click(function (event) {
            event.preventDefault();

            var id = $('#editId').val();
            var nombre = $('#editNombre').val();
            var zona_id = $('#zona_id').val();


            $.ajax({
                url: '/sectors/' + id,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: 'PUT',
                    nombre: nombre,
                    zona: zona_id,
                    id: id
                },
                success: function (response) {
                    if (response.success) {
                        location.reload();

                    } else {
                        alert('Error al actualizar el registro');
                    }
                }
            });
        });

        onclick: (event) => {
            event.preventDefault();
            var id = event.currentTarget.getAttribute('data-id');
            var name = row.cells[1].data;

            // Establece el ID y el nombre del sector en el modal
            document.getElementById('editNombre').value = name;
            document.getElementById('editId').value = id;

            // Muestra el modal
            var myModal = new bootstrap.Modal(document.getElementById('editModal'), {});
            myModal.show();
        }

        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var id = button.data('id'); // Extrae el ID del sector del atributo data-id

            // Establece el ID y el nombre del sector en el modal
            var name = document.getElementById('editNombre').value;
            var id = document.getElementById('editId').value;

            document.getElementById('editNombre').value = name;
            document.getElementById('editId').value = id;
        });
    </script>
</x-app-layout>