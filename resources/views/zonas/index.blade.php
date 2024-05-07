<x-app-layout>
    <div class="modul container p-3">
        <div class="row w-100">
            <div class="col-auto d-flex align-items-center">
                <h1>Zonas</h1>
            </div>
            <div class="col text-right">
                <form id="create-form" action="{{ route('zonas.store') }}" method="post" class="row">
                    @csrf
                    <div class="col">
                        <input type="text" class="create-input h-100 form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <button type="submit" class="w-100 btn btn-primary">Crear Zona</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modul">
        <table class="table">
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
                    <th></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Aquí se mostrarán los datos -->
                @foreach($zonas as $zona)
                <tr id="row-{{ $zona->id }}">
                    <td>{{ $zona->id }}</td>
                    <td>{{ $zona->nombre }}</td>

                    <!-- Botón de eliminar con icono de Tailwind CSS de Heroicons -->
                    <td>
                        <button type="button" class="delete-button text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500" data-id="{{ $zona->id }}">
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
    <div class="modul container p-3">
        <nav aria-label="Page navigation example" class="d-flex justify-content-center">
            <ul id="pagination-container" class="pagination">
                <li class="page-item">
                    <button id="previous-page" class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </button>
                </li>
                <!-- Aquí se insertarán los botones de paginación -->
                <li class="page-item">
                    <button id="next-page" class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function sortTable(columnIndex) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.querySelector('.table');
            switching = true;
            // Establece la dirección inicial como ascendente
            dir = "asc";
            /* Haz un bucle que continuará hasta que no se realicen cambios */
            while (switching) {
                switching = false;
                rows = table.rows;
                /* Bucle a través de todas las filas, excepto la primera (encabezados de columna) */
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    /* Obtén el contenido de las celdas que deseas comparar */
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];
                    /* Comprueba si las dos filas deben cambiarse de posición */
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
                    /* Si se encuentra un cambio, haz el cambio y marca que se ha hecho */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Aumenta el contador en 1
                    switchcount++;
                } else {
                    /* Si no se realizaron cambios y la dirección es 'asc', establece la dirección a 'desc' y ejecuta el bucle while nuevamente */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
            // Remover clases de los botones de filtro
            var buttons = document.querySelectorAll('.btn-link');
            buttons.forEach(function(button) {
                button.classList.remove('active');
            });
            // Agregar clase activa al botón de filtro seleccionado
            var selectedButton = document.querySelector('.btn-link[data-column-index="' + columnIndex + '"]');
            selectedButton.classList.add('active');

            // Obtén todos los íconos de flecha
            var icons = document.querySelectorAll('.sort-icon');
            // Restablece todos los íconos a la flecha bidireccional
            icons.forEach(function(icon) {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>';
            });

            // Obtén el ícono de flecha para la columna actual
            var icon = selectedButton.querySelector('.sort-icon');

            if (dir == 'asc') {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>'; // flecha hacia arriba
            } else {
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>'; // flecha hacia abajo
            }
        }

        $(document).ready(function() {
            $('#create-form').on('submit', function(e) {
                e.preventDefault();

                var nombre = $('#nombre').val();

                $.ajax({
                    url: '/zonas',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nombre: nombre
                    },
                    success: function(response) {
                        if (response.success) {
                            var newRow = '<tr id="row-' + response.zonas.id + '">' +
                                '<td>' + response.zonas.id + '</td>' +
                                '<td>' + response.zonas.nombre + '</td>' +
                                '<td>' +
                                '<button type="button" class="delete-button text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500" data-id="' + response.zonas.id + '">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">' +
                                '<path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />' +
                                '</svg>' +
                                '</button>' +
                                '</td>' +
                                '</tr>';

                            $('#table-body').append(newRow);
                            $('#nombre').val('');
                        } else {
                            alert('Error al crear el registro');
                        }
                    }
                });
            });

            // Controlador de eventos para los botones de eliminar
            $('#table-body').on('click', '.delete-button', function() {
                var id = $(this).data('id');

                $.ajax({
                    url: '/zonas/' + id,
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
                });
            });
        });

        let currentPage = 1;
        const rowsPerPage = 6;
        
        function updateTable() {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
        
            const rows = document.querySelectorAll('#table-body tr');
            rows.forEach((row, index) => {
                row.style.display = (start <= index && index < end) ? 'table-row' : 'none';
            });
        
            const totalRows = rows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);
        
            const paginationContainer = document.querySelector('#pagination-container');
            // Elimina todos los elementos de paginación actuales, excepto los botones "Anterior" y "Siguiente"
            paginationContainer.querySelectorAll('.page-item:not(:first-child):not(:last-child)').forEach(item => item.remove());
        
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
        
                const a = document.createElement('a');
                a.textContent = i;
                a.classList.add('page-link');
                a.href = '#';
                a.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    updateTable();
                });
        
                li.appendChild(a);
                // Inserta el nuevo elemento de paginación antes del botón "Siguiente"
                paginationContainer.insertBefore(li, paginationContainer.lastElementChild);
            }
        
            document.querySelector('#previous-page').addEventListener('click', (e) => {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            });
            
            document.querySelector('#next-page').addEventListener('click', (e) => {
                e.preventDefault();
                const totalRows = document.querySelectorAll('#table-body tr').length;
                const totalPages = Math.ceil(totalRows / rowsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    updateTable();
                }
            });
        }
        
        updateTable();
    </script>
</x-app-layout>