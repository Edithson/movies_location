@extends('index')
@section('content')
<section class="auth_conteneur">

    <div class="mb-4 text-sm text-gray-600">
        Vous avez oublié votre mot de passe ? Aucun problème. Communiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label class="form-label" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 form-label" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="btn btn-success">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</section>
@endsection