<x-guest-layout>
    <div class="content">
        <h1  class="title"><strong>Créer un compte</strong></h1>
            <link rel="stylesheet" href="{{asset('assets/css/register.css')}}">
        <form class="form" method="POST" action="{{ route('register') }}" >
            @csrf

            <div>
                <label for="role" class="role">Rôle</label>
                <select class="select_role" id="role" name="role" required >
                    <option value="2">Formateur</option>
                    <option value="3">Apprenant</option>
                </select>
            </div>

            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="input" 
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="prenom" :value="__('Prénom')" />
                <x-text-input id="prenom" class="input" 
                    type="text" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom" />
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="input" 
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
           
            <div>
                <x-input-label for="date_naissance_naissance" :value="__('date_naissance')" />
                <x-text-input id="date_naissance" class="input" 
                    type="date" name="date_naissance" :value="old('date_naissance')" required autocomplete="date_naissance" />
                <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="input" 
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-text-input id="password_confirmation" class="input" 
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="deja_inscrit" href="{{ route('login') }}">
                    Déjà inscrit ?
                </a>
                <x-primary-button class="btn">
                    {{ __('S’inscrire') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>