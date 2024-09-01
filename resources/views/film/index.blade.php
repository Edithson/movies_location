@extends('index')

@section('content')
<h2>Retrouver tout vos films</h2>
<button class="btn btn-primary"><a href="{{route('film.create')}}">Ajouter un film</a></button>
@forelse ($films as $film)
    <div>
        <h3><a href="{{route('film.show', $film)}}">{{$film->titre}}</a></h3>
    </div>
@empty
    <p>Aucun film trouvé</p>
@endforelse

@endsection