@extends('index')
@section('content')
<section class="auth_conteneur">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label class="form-label" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 form-label" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="form-label" for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 form-label" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label class="form-label" for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 form-label" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="btn btn-warning">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</section>
@endsection