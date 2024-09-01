@extends('index')

@section('content')
<h2>Nouvelle diffusion</h2>
<form action="{{route('seance.update', $seance)}}" method="post" enctype="multipart/form-data">
@csrf
@method('PUT')
    <label for="exampleFormControlInput1" class="form-label">Date et heure : </label>
    <input type="datetime-local" name="datetime" value="{{$seance->date_heure_debut}}" class="form-control" id="exampleFormControlInput1" required><br>
    <label for="exampleFormControlInput2" class="form-label">Prix : </label>
    <input type="number" name="prix" value="{{$seance->prix}}" class="form-control" id="exampleFormControlInput2" required><br>
    <label for="exampleFormControlInput2" class="form-label">Film : </label>
    <select name="film" class="form-select" aria-label="Default select example">
        @forelse ($films as $film)
            <option 
            @if($seance->film->id==$film->id) selected @endif
            value="{{$film->id}}">{{$film->titre}}</option>
        @empty
            <option value="">Aucun film trouvé</option>
        @endforelse
    </select><br>
    <label for="exampleFormControlInput2" class="form-label">Salle de diffusion : </label>
    <select name="salle" class="form-select" aria-label="Default select example">
        @forelse ($salles as $salle)
            <option 
            @if($seance->salle->id==$salle->id) selected @endif
            value="{{$salle->id}}">{{$salle->nom}}</option>
        @empty
            <option value="">Aucune salle trouvée</option>
        @endforelse
    </select><br>
    <input type="submit" value="Mettre à jour" name="Validate" class="btn btn-success">
</form>
@endsection