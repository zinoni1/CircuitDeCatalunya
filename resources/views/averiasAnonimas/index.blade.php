<x-guest-layout>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div id="first-column" class="col-md-12 h-100 bg-login d-flex align-items-center justify-content-center position-relative" style="background-image: url('{{ asset("images/login-bg.jpeg") }}');">
                <div class="overlay"></div>
                <img src="{{ asset("images/login-logo.png") }}" alt="Circuit de Catalunya" size="10px" class="img-fluid logo_bg">

                <a href="{{ route('login') }}">
                    <div class="modul" style="width:25px !important; position:absolute; top:0; left:10; border-radius:5px; background-color:var(--primary-color);">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                </a>

            </div>

            <div id="second-column" class="col-md-5 h-100 d-flex flex-column align-items-center justify-content-center d-none">
                <h1 class="mb-4">Avisar incidencia</h1>

                <div class="w-100">
                    <x-validation-errors class="mb-4" />


                    <div class="form-group">
                        <label for="problema">Problema:</label>
                        <input type="text" class="form-control" id="problema" placeholder="Ingrese el problema">
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Ingrese su email">
                    </div>

                    <x-button class="w-100 mt-3">
                        {{ __('Enviar incidencia') }}
                    </x-button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Agrega la clase d-none a la segunda columna al inicio
            document.getElementById("second-column").classList.add("d-none");
            // Obtiene el elemento de la primera columna
            var firstColumn = document.getElementById("first-column");
            // Obtiene el tiempo de duración de la animación de la primera columna
            var animationDuration = parseFloat(getComputedStyle(firstColumn).animationDuration) * 1000;
            // Espera a que termine la animación de la primera columna antes de mostrar la segunda columna
            setTimeout(function() {
                document.getElementById("second-column").classList.remove("d-none");
            }, animationDuration);
        });
    </script>
</x-guest-layout>