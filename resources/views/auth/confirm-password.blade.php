@extends('index')
@section('content')
<section class="auth_conteneur">
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label class="form-label" for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full form-control"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 form-label" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="btn btn-primary">
                {{ __('Confirmer') }}
            </x-primary-button>
        </div>
    </form>
</section>
@endsection
