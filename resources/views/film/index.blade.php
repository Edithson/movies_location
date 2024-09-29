@extends('index')

@section('content')
@if (Auth::user() && Auth::user()->type_id > 1)
<a href="{{route('film.create')}}"><button class="btn btn-primary">Ajouter un film</button></a>
<input type="search" style="width:70%" name="search" id="search" class="form-control champ_float" oninput="filtrerEtTrierParagraphes()" placeholder="Recherchez un film">
@endif
<h2>Retrouvez tout vos films</h2>
@forelse ($films as $film)
    <div class="seance-index film" data-id="{{$film->id}}"  data-nom="{{$film->titre}}"  data-description="{{$film->description}}">
        <a href="{{route('film.show', $film)}}">
            <h3>{{$film->titre}}</h3>
            <img src="{{Storage::url($film->affiche)}}" alt="">
            <p><i> Durée : {{$film->duree}}</i></p>
        </a>
    </div>
    <div style="color:red" id="message"></div>
@empty
    <p>Aucun film trouvé</p>
@endforelse

<script>
    
function filtrerEtTrierParagraphes() {
    var inputNom = document.getElementById('search').value.trim().toLowerCase();
    var paragraphes = document.getElementsByClassName('film');
    var aucunResultat = true;
    
    for (var i = 0; i < paragraphes.length; i++) {
        var filterNom = paragraphes[i].getAttribute('data-nom').toLowerCase();
        var filterDescription = paragraphes[i].getAttribute('data-description').toLowerCase();
        var filterNumber = paragraphes[i].getAttribute('data-id').toLowerCase();
        
        var show = true;
        
        // Vérifier si la recherche par nom est présente et si elle correspond
        if (inputNom && !(filterNom.includes(inputNom) || filterDescription.includes(inputNom))) {
            show = false;
        }

        // Afficher ou masquer le paragraphe en fonction des critères
        paragraphes[i].style.display = show ? '' : 'none';
        
        // Mettre à jour le statut "aucun résultat trouvé"
        if (show) {
            aucunResultat = false;
        }
    }
    
    // Afficher "Aucun résultat trouvé" si aucun élément ne correspond aux critères
    var messageInfo = document.getElementById('no-result-message');
    if (aucunResultat) {
        if (!messageInfo) {
            var table = document.getElementById('message');
            var message = document.createElement('p');
            message.setAttribute('id', 'no-result-message');
            message.innerHTML = 'Aucun résultat trouvé';
            table.appendChild(message);
        }
    } else {
        // Supprimer le message s'il existe
        if (messageInfo) {
            messageInfo.remove();
        }
    }
}

</script>
@endsection