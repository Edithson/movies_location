@extends('index')

@section('content')
<h2>Ajouter un nouveau film</h2>
<form action="{{route('film.store')}}" method="post" enctype="multipart/form-data">
@csrf
    <label for="exampleFormControlInput1" class="form-label">Titre : </label>
    <input type="text" name="titre" class="form-control" placeholder="" id="exampleFormControlInput1" required><br>
    <label for="floatingTextarea2" class="form-label">Description : </label>
    <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px" name="description" required></textarea><br>
    <label for="formFile" class="form-label">Affiche </label>
    <input class="form-control" type="file" id="formFile" name="affiche"><br>
    <label for="exampleFormControlInput4" class="form-label">Durée du film : </label>
    <input type="time" step="1" name="duree" value="01:30:00" min="00:30:00" max="10:00:00" class="form-control" id="exampleFormControlInput4" required><br><br>
    <input type="submit" value="Validate" name="Validate" class="btn btn-success">
</form>
<button class="btn btn-danger"><a href="{{route('film.index')}}">Retour</a></button>
@endsection