@extends('index')

@section('content')
<ul>
@forelse ($users as $user)
    <li>
        <img class="image-commentaire" src="{{Storage::url($user->profil)}}" alt=""> 
        {{$user->name}} du titre {{$user->type->intitule}} <a href="{{route('user.restore', $user->id)}}"><button class="btn btn-warning">Réactiver</button></a>
    </li>
@empty
    <li>Aucun utilisateur trouvé</li>
@endforelse
</ul><br>
<a href="{{route('user.index')}}"><button class="btn btn-warning">Voire les utilisateurs actifs</button></a>
@endsection