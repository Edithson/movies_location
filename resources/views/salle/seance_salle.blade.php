@extends('index')

@section('content')
<h2>Voici les séances de projection de la salle {{$salle->nom}}</h2>
@forelse ($seances as $seance)
    <div class="seance-index">
        <a href="{{route('seance.show', $seance)}}">
            <h3>{{$seance->film->titre}}</h3>
            <img src="{{Storage::url($seance->film->affiche)}}" alt="">
            <p><i> le {{$seance->date_heure_debut->format('d/m/Y')}} à {{$seance->date_heure_debut->format('H:i')}}</i></p>
        </a>
    </div>
@empty
    <p>Aucunes séance de projection pour cette salle</p>
@endforelse
@endsection