@extends('index')
@section('content')
<section class="auth_conteneur">
    <h2>Inscription</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label class="form-label" for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 form-label" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label class="form-label" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 form-label" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="form-label" for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full form-control"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 form-control" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label class="form-label" for="password_confirmation" :value="__('Confirmation du Mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 form-label" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>

            <x-primary-button class="ms-4 btn btn-success">
                {{ __('Inscription') }}
            </x-primary-button>
        </div>
    </form>
</section>
@endsection