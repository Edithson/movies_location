@extends('index')

@section('content')
<h2>Retrouver toutes vos réservations ici</h2>
<table class="table table-striped">
    <tr>
        <th>Film</th>
        <th>Date</th>
        <th></th>
    </tr>
@forelse ($reservations as $reservation)
    <tr>
        <td>{{$reservation->seance->film->titre}}</td>
        <td>{{$reservation->seance->date_heure_debut->format('d/m/Y')}} à {{$reservation->seance->date_heure_debut->format('H:i')}}</td>
        <td><a href="{{route('reservation.edit', $reservation)}}"><button class="btn btn-primary">Editer</button></a></td>
    </tr>
@empty
    <tr>Aucune réservation trouvée</tr>
@endforelse
</table>

@endsection