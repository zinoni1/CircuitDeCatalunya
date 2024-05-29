<x-app-layout>
    <div class="mx-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div id="my-table"></div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('averiasAnonimas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripció</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tancar</button>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Pass the PHP data to JavaScript
        let averias = @json($averias);

        // Convert data to the format required by grid.js
        let data = averias.map(averia => [averia.id, averia.email, averia.descripcion]);

        let table = new gridjs.Grid({
            columns: [
                "ID",
                "Email", 
                "Descripció", 
                {
                    name: "Accions",
                    width: '100vh',
                    formatter: (cell, row) => {
                        let id = row.cells[0].data;
                        return gridjs.h('div', {}, [
                            gridjs.h('a', {
                                className: 'btn btn-primary',
                                onclick: (event) => {
                                    window.location.href = '/averiasAnonimas/' + row.cells[0].data;
                                }
                            }, [
                                gridjs.h('svg', {
                                    xmlns: "http://www.w3.org/2000/svg",
                                    fill: "none",
                                    viewBox: "0 0 24 24",
                                    stroke: "currentColor",
                                    class: "w-6 h-6"
                                }, [
                                    gridjs.h('path', {
                                        strokeLinecap: "round",
                                        strokeLinejoin: "round",
                                        strokeWidth: "2",
                                        d: "M15 12H9m0 0v3m0-3V9m6 3h.01M19 10v10a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V10m14-4h-3.6a2 2 0 0 1-1.95-1.5l-.5-2A2 2 0 0 0 9 2H7a2 2 0 0 0-1.95 1.5l-.5 2A2 2 0 0 1 2 6H2.6"
                                    })
                                ])
                            ]),
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
                server: false
            },
            language: {
                search: {
                    placeholder: 'Buscar...'
                },
                pagination: {
                    previous: 'Anterior',
                    next: 'Següent',
                    showing: 'Mostrant',
                    results: () => 'Resultats'
                }
            }
        }).render(document.getElementById("my-table"));

        // Function to delete a row from the table
        function deleteRow(id) {
            averias = averias.filter(averia => averia.id !== id);
            let data = averias.map(averia => [averia.id, averia.email, averia.descripcion]);
            table.updateConfig({ data }).forceRender();
        }
    </script>
</x-app-layout>
