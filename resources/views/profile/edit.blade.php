@extends('index')

@section('content')

    <div class="">
        @include('profile.partials.update-profile-photo-form')
    </div>
    <br><hr>
    <div class="">
        @include('profile.partials.update-profile-information-form')
    </div>
    <br><hr>
    <div class="">
        @include('profile.partials.update-password-form')
    </div>
    <!-- <br><hr>
    <div class="">
        @include('profile.partials.delete-user-form')
    </div> -->
    <br><hr>
    <div class="">
        @include('profile.partials.delete-user-compte')
    </div>

@endsection