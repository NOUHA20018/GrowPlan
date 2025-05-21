<x-guest-layout>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h2>Connexion</h2>
                <p>Bienvenue sur Smart Growth</p>
            </div>
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- Email  -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="form-input"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="input-error" />
                </div>

                <!-- Remember Me -->
                <div class="remember-me">
                    <label for="remember_me" class="remember-label">
                        <input id="remember_me" type="checkbox" class="remember-checkbox" name="remember">
                        <span>{{ __('Se souvenir de moi') }}</span>
                    </label>
                </div>

                <div class="form-footer">
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    @endif

                    <x-primary-button class="login-button">
                        {{ __('Se connecter') }}
                    </x-primary-button>
                </div>

                <div class="register-redirect">
                    <p>Pas encore de compte? <a href="{{ route('register') }}" class="register-link">S'inscrire</a></p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>