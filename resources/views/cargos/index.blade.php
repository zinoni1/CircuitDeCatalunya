<x-app-layout>
    <div class="modul container p-3">
        <div class="row w-100">
            <div class="col-auto d-flex align-items-center">
                <h1>Zonas</h1>
            </div>
            <div class="col text-right">
                <form id="create-form" action="{{ route('cargos.store') }}" method="post" class="row">
                    @csrf
                    <div class="col">
                        <input type="text" class="create-input h-100 form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <button type="submit" class="w-100 btn btn-primary">Crear Cargo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mx-5">
        <div id="my-table"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Pasar los datos de PHP a JavaScript
        let cargos = @json($cargos);

        // Convertir los datos al formato que necesita grid.js
        let data = cargos.map(cargo => [cargo.id, cargo.nombre]);

        let table = new gridjs.Grid({
            columns: ["ID", "Nombre", {
                name: "Acciones",
                width: '10vh',
                formatter: (cell, row) => {
                    return gridjs.h('button', {
                        className: 'delete-button text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500',
                        'data-id': row.cells[0].data,
                        onclick: (event) => {
                            event.preventDefault();
                            var id = event.currentTarget.getAttribute('data-id');

                            $.ajax({
                                url: '/cargos/' + id,
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
                    })));
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
            data.push([id, nombre]);
            table.updateConfig({
                data
            }).forceRender();
        }

        // Función para eliminar una fila
        function deleteRow(id) {
            cargos = cargos.filter(cargo => cargo.id != id);
            data = cargos.map(cargo => [cargo.id, cargo.nombre]);
            table.updateConfig({
                data: data
            }).forceRender();
        }

        // Controlador de eventos para el formulario de creación
        $(document).ready(function() {
            // Obtener los datos iniciales de la tabla del servidor
            $.ajax({
                url: '/cargos',
                type: 'GET',
                success: function(response) {
                    // Comprobar si response.zonas es un array
                    if (response && Array.isArray(response.cargos)) {
                        // Actualizar la tabla con los datos recibidos
                        const data = response.zonas.map(cargo => [cargos.id, cargos.nombre]);
                        table.updateConfig({
                            data
                        }).forceRender();
                    }
                }
            });
        });
    </script>
</x-app-layout>