<x-app-layout>

    <div class="modul text-right">
        <form action="{{ route('tipo-averias.store') }}" method="post" class="d-inline-block">
            @csrf
            <input type="text" class="create-input" id="nombre" name="nombre" required>
            <button type="submit" class="btn btn-primary">Crear Tipo de Avería</button>
        </form>
    </div>

    <div class="modul">
        <table class="table">
            <thead>
                <tr>
                    <th>ID <button class="btn btn-link" onclick="sortTable(0)"><i class="fas fa-chevron-up"></i></button></th>
                    <th>Nombre <button class="btn btn-link" onclick="sortTable(1)"><i class="fas fa-chevron-up"></i></button></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Aquí se mostrarán los datos -->
                @foreach($tipoAverias as $tipoAveria)
                <tr>
                    <td>{{ $tipoAveria->id }}</td>
                    <td>{{ $tipoAveria->nombre }}</td>
                    <td>
                        <!-- Botón de eliminar con icono de Tailwind CSS de Heroicons -->
                        <button onclick="deleteRow(this)" class="text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5.293 5.293a1 1 0 011.414 0L10 8.586l3.293-3.293a1 1 0 111.414 1.414L11.414 10l3.293 3.293a1 1 0 11-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
                            shouldSwitch= true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch= true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* Si se encuentra un cambio, haz el cambio y marca que se ha hecho */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Aumenta el contador en 1
                    switchcount ++;
                } else {
                    /* Si no se realizaron cambios y la dirección es 'asc', establece la dirección a 'desc' y ejecuta el bucle while nuevamente */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }

        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
</x-app-layout>
