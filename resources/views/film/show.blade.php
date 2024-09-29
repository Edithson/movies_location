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
    @if (Auth::user() && Auth::user()->type_id > 1)
    <a href="{{route('film.edit', $film)}}"><button class="btn btn-primary">Modifier</button></a>
    @endif
    <br>
    <hr>
    <div>
        <h3>Seance de projection</h3>
        @forelse ($seances as $seance)
            <div>
                <h3><a href="{{route('seance.show', $seance)}}">Le {{$seance->date_heure_debut->format('d/m/Y')}} à {{$seance->date_heure_debut->format('H:i')}} dans la salle {{$seance->salle->nom}} </a></h3>
            </div>
        @empty
            <p>Aucun programmation prévue pour ce film</p>
        @endforelse
    </div>
    <hr>
    <div>
        <h3>Commentaires</h3>
        @forelse ($commentaires as $commentaire)
            <div class="commentaire">
                <i style="color:black">
                    <img class="image-commentaire" src="{{Storage::url($commentaire->user->profil)}}" alt="">
                    @if (Auth::user() && Auth::user()->id == $commentaire->user_id)
                    <b>Vous-meme le {{$commentaire->created_at->format('d/m/Y')}} à {{$commentaire->created_at->format('H:i')}}</b>
                    @else
                    <b>{{$commentaire->user->name}} le {{$commentaire->created_at->format('d/m/Y')}} à {{$commentaire->created_at->format('H:i')}}</b>
                    @endif
                </i>
                <p>{{$commentaire->commentaire}}</p>
                @if (Auth::user() && Auth::user()->id == $commentaire->user_id)
                <form action="{{route('commentaire.destroy', $commentaire)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <a class="commentaire-link" href="route('commentaire.destroy', $commentaire)"
                            onclick="event.preventDefault();
                            this.closest('form').submit();">
                        Supprimé le commentaire
                    </a>
                </form>
                @endif
            </div>
        @empty
            <p>Aucun commentaire pour l'instant</p>
        @endforelse
    </div>
    @auth
    <form action="{{route('commentaire.store', $film)}}" method="post">
        @csrf
        <label for="floatingTextarea2" class="form-label">Commentaire : </label>
        <textarea class="form-control" placeholder="" id="floatingTextarea2" style="height: 100px" name="commentaire" required></textarea><br>
        <input type="submit" value="Publier" class="btn btn-success">
    </form><br>
    @else
        <a href="{{route('login')}}"><button class="btn btn-primary">Connectez vous pour commenter</button></a>
    @endauth
    @if (Auth::user() && Auth::user()->type_id > 1)
    <form action="{{route('film.destroy', $film)}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Supprimé le film" class="btn btn-danger">
    </form>
    @endif
</div>
@endsection