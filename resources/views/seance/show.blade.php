@extends('index')

@section('content')
<div>
    <h2>Rdv le {{$seance->date_heure_debut->format('d/m/Y')}} à {{$seance->date_heure_debut->format('H:i')}} dans la salle {{$seance->salle->nom}}</h2>
    @if ($seance->film->affiche !== 'null')
        <img class="image-show" src="{{Storage::url($seance->film->affiche)}}" alt="">
    @else
        <p>Aucune affiche trouvée</p>
    @endif
    <p>{{$seance->film->description}}</p><br>
    <p>Nombre de place encore disponible : <b>{{$place_dispo}}</b> à <b><span id="pu">{{$seance->prix}}</span> FCFA</b> la place</p>
    @auth    
        @if ($reservation)
            <a href="{{route('reservation.edit', $reservation)}}"><button class="btn btn-primary">Affichez ma réservation</button></a>
        @elseif ($place_dispo > 0)
            <form action="{{route('reservation.store', $seance)}}" method="post">
                @csrf
                <label for="">Vous voulez réservé </label>
                <input type="number" min="1" max="{{$place_dispo}}" value=1 name="nbr_place" id="nbr_place" required> place(s) <br>
                <label for="">Ce qui vous coutera <b><span id="total">{{$seance->prix}}</span></b></label>
                <input type="submit" value="Réservé maintenant" class="btn btn-primary">
            </form>
        @else
            <p class="danger">Vous ne pouvez plus réservé</p>
        @endif
    @else
        <a href="{{ route('login') }}"><button class="btn btn-primary">connectez vous pour réserver</button></a>
    @endauth
    @if (Auth::user() && Auth::user()->type_id > 2)
    <br><br><a style="float:left; margin-right:5px" href="{{route('seance.edit', $seance)}}"><button class="btn btn-primary">Modifier la projection</button></a>
    <form action="{{route('seance.destroy', $seance)}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Supprimé la projection" class="btn btn-danger">
    </form>
    @endif
</div>

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