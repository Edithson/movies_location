@extends('index')

@section('content')
<h2>Ajouter une salle</h2>
<form action="{{route('salle.store')}}" method="post" enctype="multipart/form-data">
@csrf
    <label for="exampleFormControlInput1" class="form-label">Nom : </label>
    <input type="text" name="nom" class="form-control" id="exampleFormControlInput1" required><br>
    <label for="floatingTextarea2" class="form-label">Adresse : </label>
    <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px" name="adresse" required></textarea><br>
    <label for="exampleFormControlInput2" class="form-label">Taille : </label>
    <input type="number" name="taille" min="20" max="200" class="form-control" id="exampleFormControlInput2" required><br>

    <input type="submit" value="Valider" name="Validate" class="btn btn-success">
</form><br><hr>
<h2>Nos salles</h2>
<div>
    @forelse ($salles as $salle)
        <p>{{$salle->nom}}</p>
        <button class="btn btn-primary"><a href="{{route('salle.edit', $salle)}}">Modifier</a></button>
        <form action="{{route('salle.destroy', $salle)}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Supprimé la salle" class="btn btn-danger">
    </form>
    @empty
        <p>Aucune salle trouvée</p>
    @endforelse
</div>
@endsection