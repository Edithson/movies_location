@extends('index')

@section('content')

<p>Nombre de place encore disponible : <b>{{$place_dispo}}</b> à <b><span id="pu">{{$reservation->seance->prix}}</span> FCFA</b> la place</p>
<form action="{{route('reservation.update', $reservation)}}" method="post">
    @csrf
    @method('PUT')
    <label for="">Vous avez réservé </label>
    <input type="number" min="1" max="{{$place_dispo+$reservation->nbr_place}}" value="{{$reservation->nbr_place}}" name="nbr_place" id="nbr_place" required> place(s) <br>
    <label for="">Ce qui vous coutera <b><span id="total">{{$reservation->seance->prix*$reservation->nbr_place}}</span></b></label>
    <input type="submit" value="Mettre à jour ma réservation" class="btn btn-primary">
</form><br>
<form action="{{route('reservation.destroy', $reservation)}}" method="post">
    @csrf
    @method('DELETE')
    <input type="submit" value="Supprimé ma reservation" class="btn btn-danger">
</form>

<script>
    document.getElementById('nbr_place').addEventListener('change', function(){
        let pu = parseInt(document.getElementById('pu').innerText.trim())
        let nbr = parseInt(document.getElementById('nbr_place').value)
        let total = parseInt(pu*nbr)
        if (total >= 0) {
            document.getElementById('total').innerText = total
        }else{
            document.getElementById('total').innerText = "Valeure incorect!"
        }
    })
</script>
@endsection