@extends('index')

@section('content')
<h2>Mise à jour du film {{$film->titre}} </h2>
<form action="{{route('film.update', $film)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
    <label for="exampleFormControlInput1" class="form-label">Titre : </label>
    <input type="text" value="{{$film->titre}}" name="titre" class="form-control" placeholder="" id="exampleFormControlInput1" required><br>
    <label for="floatingTextarea2" class="form-label">Description : </label>
    <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px" name="description" required>{{$film->description}}</textarea><br>
    <label for="formFile" class="form-label">Affiche </label>
    <input class="form-control" type="file" id="formFile" name="affiche"><br>
    <label for="exampleFormControlInput4" class="form-label">Durée du film : </label>
    <input type="time" step="1" name="duree" value="{{$film->duree}}" class="form-control" id="exampleFormControlInput4" required><br><br>
    <input type="submit" value="Mettre à jour" name="Validate" class="btn btn-success">
</form><br>
<a href="{{route('film.show', $film)}}"><button class="btn btn-danger">Retour</button></a>
@endsection