@extends('index')

@section('content')
<h2>A ne surtout pas manqué</h2>
@forelse ($seances as $seance)
    <div>
        <h3><a href="{{route('seance.show', $seance)}}">{{$seance->film->titre}} le {{$seance->date_heure_debut}}</a></h3>
    </div>
@empty
    <p>Aucun programmation trouvée</p>
@endforelse
@endsection