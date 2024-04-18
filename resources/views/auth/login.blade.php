<x-guest-layout>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div id="first-column" class="col-md-12 h-100 bg-login d-flex align-items-center justify-content-center position-relative" style="background-image: url('{{ asset("images/login-bg.jpeg") }}');">
                <div class="overlay"></div>
                <img src="{{ asset("images/logo.png") }}" alt="Circuit de Catalunya" size="10px" class="img-fluid logo_bg">
            </div>

            <div id="second-column" class="col-md-5 h-100 d-flex flex-column align-items-center justify-content-center d-none">
                <h1 class="mb-4">Iniciar Sessió</h1>

                <div class="w-100">
                    <x-validation-errors class="mb-4" />

                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="mx-3">
                        @csrf

                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>

                        <div class="mt-4">
                            <x-label for="password" value="{{ __('Password') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>

                        <x-button class="w-100 mt-3">
                            {{ __('Iniciar Sessió') }}
                        </x-button>

                        <div class="block mt-4 d-flex justify-content-center">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-center mt-4">
                            @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Has oblidat la teva contrasenya?') }}
                            </a>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Agrega la clase d-none a la segunda columna al inicio
        document.getElementById("second-column").classList.add("d-none");
        // Espera 7 segundos antes de mostrar la segunda columna
        setTimeout(function() {
            document.getElementById("second-column").classList.remove("d-none");
        }, 4000);
    });
</script>
