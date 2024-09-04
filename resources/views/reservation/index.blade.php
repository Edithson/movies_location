@extends('index')

@section('content')
<h2>Retrouver toutes vos réservations ici</h2>
@forelse ($reservations as $reservation)
    <div>
        <h3><a href="{{route('reservation.edit', $reservation)}}">{{$reservation->seance->film->titre}} le {{$reservation->seance->date}} à {{$reservation->seance->date_heure_debut}}</a></h3>
    </div>
@empty
    <p>Aucune réservation trouvée</p>
@endforelse

@endsection