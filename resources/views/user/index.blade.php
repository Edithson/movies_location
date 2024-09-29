@extends('index')

@section('content')
<table class="table table-striped">
@forelse ($users as $user)
    <tr>
        <td><img class="image-commentaire" src="{{Storage::url($user->profil)}}" alt=""> </td>
        <td>{{$user->name}} du type {{$user->type->intitule}}</td>
        <td><a href="{{route('user.show', $user)}}"><button class="btn btn-primary">Voire plus</button></a></td>
    </tr>
@empty
    <tr>Aucun utilisateur trouvé</tr>
@endforelse
</table><br>
<a href="{{route('user.index-delete')}}"><button class="btn btn-warning">Voire les utilisateurs désactivés</button></a>
@endsection