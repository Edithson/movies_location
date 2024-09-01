@extends('index')

@section('content')
<h2>Mise à jour de la salle {{$salle->nom}}</h2>
<form action="{{route('salle.update', $salle)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
    <label for="exampleFormControlInput1" class="form-label">Nom : </label>
    <input type="text" name="nom" value="{{$salle->nom}}" class="form-control" id="exampleFormControlInput1" required><br>
    <label for="floatingTextarea2" class="form-label">Adresse : </label>
    <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px" name="adresse" required>{{$salle->adresse}}</textarea><br>
    <label for="exampleFormControlInput2" class="form-label">Taille : </label>
    <input type="number" name="taille" value="{{$salle->taille}}" min="20" max="200" class="form-control" id="exampleFormControlInput2" required><br>

    <input type="submit" value="Valider" name="Mettre à jour" class="btn btn-success">
</form>
@endsection