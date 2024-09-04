@extends('index')

@section('content')
<h2>Voici les séances de projection de la salle {{$salle->nom}}</h2>
@forelse ($seances as $seance)
    <div>
        <h3><a href="{{route('seance.show', $seance)}}">{{$seance->film->titre}} le {{$seance->date_heure_debut}}</a></h3>
    </div>
@empty
    <p>Aucunes séance de projection pour cette salle</p>
@endforelse
@endsection