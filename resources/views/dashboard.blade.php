@extends('index')

@section('content')
@if (Auth::user() && Auth::user()->type_id > 1)
<a href="{{route('seance.create')}}"><button class="btn btn-primary">Nouvelle projection</button></a>
@endif
<h2>A ne surtout pas manqué</h2>
@forelse ($seances as $seance)
    <div class="seance-index">
        <a href="{{route('seance.show', $seance)}}">
            <h3>{{$seance->film->titre}}</h3>
            <img src="{{Storage::url($seance->film->affiche)}}" alt="">
            <p><i> le {{$seance->date_heure_debut->format('d/m/Y')}} à {{$seance->date_heure_debut->format('H:i')}}</i></p>
        </a>
    </div>
@empty
    <p>Aucun programmation trouvée</p>
@endforelse
@endsection