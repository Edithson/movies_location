@extends('index')

@section('content')
<div>
    <h4>Attention!</h4>
    <p>Vous etes sur le point d'effectuer une réservation à une date et dans un intervalle de temps (entre le <b>{{$seance->date_heure_debut}}</b> et le <b>{{$seance->date_heure_fin}}</b>) qui entre en conflit avec une autre de vos réservations</p>
    @foreach ($seances as $reservation)
        <p>En effet, vous avez effectué une reservation le <b>{{$reservation->date_heure_debut}}</b> pour le film <b>{{$reservation->film->titre}}</b> qui s'achèvera le <b>{{$reservation->date_heure_fin}}</b> </p>
    @endforeach
    <p>Voullez vous quand meme validé cette réservation ? </p>
    <form action="{{route('reservation.validate', $seance)}}" method="post">
        @csrf
        <label for="place">Nombre de place : </label>
        <input type="number" name="nbr_place" value="{{$nbr_place}}" readonly><br>
        <input type="submit" value="Oui, je valide" class="btn btn-success">
    </form>
    <a href="{{route('seance.index')}}"><button class="btn btn-danger">Non, j'annule</button></a>
</div>
@endsection