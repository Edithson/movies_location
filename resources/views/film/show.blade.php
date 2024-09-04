@extends('index')

@section('content')
<div>
    <h2>{{$film->titre}}</h2>
    @if ($film->affiche !== 'null')
        <img class="image-show" src="{{Storage::url($film->affiche)}}" alt="">
    @else
        <p>Aucune affiche trouvée</p>
    @endif
    <p>{{$film->description}}</p><br>
    <p>Durée : <b>{{$film->duree}}</b></p><br>
    <button class="btn btn-primary"><a href="{{route('film.edit', $film)}}">Modifier</a></button>
    <br>
    <hr>
    <div>
        <h3>Seance de projection</h3>
        @forelse ($seances as $seance)
            <div>
                <h3><a href="{{route('seance.show', $seance)}}">Le {{$seance->date}} à {{$seance->heure}} dans la salle {{$seance->salle->nom}} </a></h3>
            </div>
        @empty
            <p>Aucun programmation prévue pour ce film</p>
        @endforelse
    </div>
    <hr>
    <div>
        <h3>Commentaires</h3>
        @forelse ($commentaires as $commentaire)
            <div>
                <i>
                    <img class="image-commentaire" src="{{Storage::url($commentaire->user->profil)}}" alt=""> 
                    {{$commentaire->user->name}} le {{$commentaire->created_at}}
                </i>
                <h4>{{$commentaire->commentaire}}</h4>
                <form action="{{route('commentaire.destroy', $commentaire)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Supprimé le commentaire" class="btn btn-danger">
                </form>
            </div>
        @empty
            <p>Aucun commentaire pour l'instant</p>
        @endforelse
    </div>
    <form action="{{route('commentaire.store', $film)}}" method="post">
        @csrf
        <label for="floatingTextarea2" class="form-label">Commentaire : </label>
        <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px" name="commentaire" required></textarea><br>
        <input type="submit" value="Publier" class="btn btn-success">
    </form><br>
    <form action="{{route('film.destroy', $film)}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Supprimé le film" class="btn btn-danger">
    </form>
</div>
@endsection