@extends('index')

@section('content')

    <div class="">
        @include('profile.partials.update-profile-photo-form')
    </div>
        
    <div class="">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="">
        @include('profile.partials.update-password-form')
    </div>

    <div class="">
        @include('profile.partials.delete-user-form')
    </div>

@endsection