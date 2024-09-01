@extends('index')

@section('content')
<h2>Nouvelle diffusion</h2>
<form action="{{route('seance.store')}}" method="post" enctype="multipart/form-data">
@csrf
    <label for="exampleFormControlInput1" class="form-label">Date et heure: </label>
    <input type="datetime-local" name="datetime" class="form-control" id="exampleFormControlInput1" required><br>
    <label for="exampleFormControlInput2" class="form-label">Prix : </label>
    <input type="number" name="prix" class="form-control" id="exampleFormControlInput2" required><br>
    <label for="exampleFormControlInput2" class="form-label">Film : </label>
    <select name="film" class="form-select" aria-label="Default select example">
        @forelse ($films as $film)
            <option value="{{$film->id}}">{{$film->titre}}</option>
        @empty
            <option value="">Aucun film trouvé</option>
        @endforelse
    </select><br>
    <label for="exampleFormControlInput2" class="form-label">Salle de diffusion : </label>
    <select name="salle" class="form-select" aria-label="Default select example">
        @forelse ($salles as $salle)
            <option value="{{$salle->id}}">{{$salle->nom}}</option>
        @empty
            <option value="">Aucune salle trouvée</option>
        @endforelse
    </select><br>
    <input type="submit" value="Validate" name="Validate" class="btn btn-success">
</form>
@endsection