@extends('index')

@section('content')
@if (Auth::user()->type_id > 2)
<h2>Ajouter une salle</h2>
<form action="{{route('salle.store')}}" method="post" enctype="multipart/form-data">
@csrf
    <label for="exampleFormControlInput1" class="form-label">Nom : </label>
    <input type="text" name="nom" class="form-control" id="exampleFormControlInput1" required><br>
    <label for="floatingTextarea2" class="form-label">Adresse : </label>
    <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 50px" name="adresse" required></textarea><br>
    <label for="exampleFormControlInput2" class="form-label">Taille : </label>
    <input type="number" name="taille" min="20" max="200" class="form-control" id="exampleFormControlInput2" required><br>

    <input type="submit" value="Valider" name="Validate" class="btn btn-success">
</form><br><hr>
@endif
<h2>Nos salles</h2>
<table class="table table-striped table-salle">
    <tr>
        <th>Nom</th>
        <th>Adresse</th>
    </tr>
    @forelse ($salles as $salle)
    <tr>
    
        <td><a href="{{route('seance.salle', $salle)}}">{{$salle->nom}}</a></td>
        <td>Situé à {{$salle->adresse}}</td>
        @if (Auth::user()->type_id > 2)
        <td><a href="{{route('salle.edit', $salle)}}"><button class="btn btn-primary">Modifier</button></a></td>
        <td>
            <form action="{{route('salle.destroy', $salle)}}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" value="Supprimer" class="btn btn-danger">
        </td>
        @endif
    </tr>        
        
    </form>
    @empty
        <p>Aucune salle trouvée</p>
    @endforelse
</table>
@endsection