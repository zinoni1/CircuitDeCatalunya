<x-app-layout>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

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
                        <form id="form-id" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="data_inicio">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="data_inicio">
                            </div>
                            <div class="form-group">
                                <label for="data_fin">Fecha de Fin</label>
                                <input type="date" class="form-control" id="data_fin">
                            </div>
                            <div class="form-group">
                                <label for="prioridad">Prioridad</label>
                                <select class="form-control" id="prioridad">
                                    <option value="alta">Alta</option>
                                    <option value="media">Media</option>
                                    <option value="baja">Baja</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen</label>
                                <input type="file" class="form-control-file" id="imagen">
                            </div>
                            <!-- Add form elements for the remaining foreign keys -->
                            <div class="form-group">
                                <label for="creator_id">Creator ID</label>
                                <input type="text" class="form-control" id="creator_id" placeholder="Creator ID">
                            </div>
                            <div class="form-group">
                                <label for="tecnico_asignado_id">Técnico Asignado ID</label>
                                <input type="text" class="form-control" id="tecnico_asignado_id" placeholder="Técnico Asignado ID">
                            </div>
                            <div class="form-group">
                                <label for="asignador">Asignador</label>
                                <input type="text" class="form-control" id="asignador" placeholder="Asignador">
                            </div>
                            <div class="form-group">
                                <label for="zona_id">Zona ID</label>
                                <input type="text" class="form-control" id="zona_id" placeholder="Zona ID">
                            </div>
                            <div class="form-group">
                                <label for="tipo_averias_id">Tipo Averias ID</label>
                                <input type="text" class="form-control" id="tipo_averias_id" placeholder="Tipo Averias ID">
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

    <div class="modul-lg mt-3">
        <div class="container">
            <h1>Tipus d'Averies</h1>
        </div>
        <table class="table" id="miTabla">
            <thead>
                <tr>
                    <th>
                        ID
                        <button class="btn btn-link" data-column-index="0" onclick="sortTable(0)"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 sort-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </th>
                    <th>
                        Nom
                        <button class="btn btn-link" data-column-index="1" onclick="sortTable(1)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 sort-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </th>
                    <!-- Add table headers for the missing fields -->
                    <th>Descripción</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Fin</th>
                    <th>Prioridad</th>
                    <th>Imagen</th>
                    <!-- Add table headers for the remaining foreign keys -->
                    <th>Creator ID</th>
                    <th>Técnico Asignado ID</th>
                    <th>Asignador</th>
                    <th>Zona ID</th>
                    <th>Tipo Averias ID</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Aquí se mostrarán los datos -->
                @foreach($averias as $averia)
                <tr id="row-{{ $averia->id }}">
                    <td>{{ $averia->id }}</td>
                    <td>{{ $averia->nombre }}</td>
                    <!-- Add table cells for the missing fields -->
                    <td>{{ $averia->descripcion }}</td>
                    <td>{{ $averia->data_inicio }}</td>
                    <td>{{ $averia->data_fin }}</td>
                    <td>{{ $averia->prioridad }}</td>
                    <td>{{ $averia->imagen }}</td>
                    <!-- Add table cells for the remaining foreign keys -->
                    <td>{{ $averia->creator_id }}</td>
                    <td>{{ $averia->tecnico_asignado_id }}</td>
                    <td>{{ $averia->asignador }}</td>
                    <td>{{ $averia->zona_id }}</td>
                    <td>{{ $averia->tipo_averias_id }}</td>
                    <!-- Botón de eliminar con icono de Tailwind CSS de Heroicons -->
                    <td>
                        <button type="button" class="delete-button text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500" data-id="{{ $averia->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#form-id').on('submit', function(e) {
                e.preventDefault();

                var nombre = $('#nombre').val();
                var descripcion = $('#descripcion').val();
                var data_inicio = $('#data_inicio').val();
                var data_fin = $('#data_fin').val();
                var prioridad = $('#prioridad').val();
                var imagen = $('#imagen').val();
                var creator_id = $('#creator_id').val();
                var tecnico_asignado_id = $('#tecnico_asignado_id').val();
                var asignador = $('#asignador').val();
                var zona_id = $('#zona_id').val();
                var tipo_averias_id = $('#tipo_averias_id').val();

                $.ajax({
                    url: '/averias',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nombre: nombre,
                        descripcion: descripcion,
                        data_inicio: data_inicio,
                        data_fin: data_fin,
                        prioridad: prioridad,
                        imagen: imagen,
                        creator_id: creator_id,
                        tecnico_asignado_id: tecnico_asignado_id,
                        asignador: asignador,
                        zona_id: zona_id,
                        tipo_averias_id: tipo_averias_id
                    },
                    success: function(response) {
                        if (response.success) {
                            var newRow = '<tr id="row-' + response.averia.id + '">' +
                                '<td>' + response.averia.id + '</td>' +
                                '<td>' + response.averia.nombre + '</td>' +
                                '<td>' + response.averia.descripcion + '</td>' +
                                '<td>' + response.averia.data_inicio + '</td>' +
                                '<td>' + response.averia.data_fin + '</td>' +
                                '<td>' + response.averia.prioridad + '</td>' +
                                '<td>' + response.averia.imagen + '</td>' +
                                '<td>' + response.averia.creator_id + '</td>' +
                                '<td>' + response.averia.tecnico_asignado_id + '</td>' +
                                '<td>' + response.averia.asignador + '</td>' +
                                '<td>' + response.averia.zona_id + '</td>' +
                                '<td>' + response.averia.tipo_averias_id + '</td>' +
                                '<td>' +
                                '<button type="button" class="delete-button text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500" data-id="' + response.averia.id + '">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">' +
                                '<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />' +
                                '</svg>' +
                                '</button>' +
                                '</td>' +
                                '</tr>';

                            $('#table-body').append(newRow);
                            $('#nombre').val('');
                            $('#descripcion').val('');
                            $('#data_inicio').val('');
                            $('#data_fin').val('');
                            $('#prioridad').val('');
                            $('#imagen').val('');
                            $('#creator_id').val('');
                            $('#tecnico_asignado_id').val('');
                            $('#asignador').val('');
                            $('#zona_id').val('');
                            $('#tipo_averias_id').val('');

                            // Cierra el modal
                            $('#myModal').modal('hide');
                        } else {
                            alert('Error al crear el registro');
                        }
                    }
                });
            });
        });
        // Controlador de eventos para los botones de eliminar
        $('#table-body').on('click', '.delete-button', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '/averias/' + id,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        $('#row-' + id).remove();
                    } else {
                        alert('Error al eliminar el registro');
                    }
                }
            })
        })

        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("miTable");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</x-app-layout>