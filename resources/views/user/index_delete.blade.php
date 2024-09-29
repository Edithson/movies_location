@extends('index')

@section('content')
<table class="table table-striped">
@forelse ($users as $user)
    <tr>
        <td><img class="image-commentaire" src="{{Storage::url($user->profil)}}" alt=""> </td>
        <td>{{$user->name}} du type {{$user->type->intitule}}</td>
        @if (Auth::user()->type_id > 2)
        <td><a href="{{route('user.restore', $user->id)}}"><button class="btn btn-warning">Restaurer</button></a></td>
        @endif
    </tr>
@empty
    <tr>Aucun utilisateur trouvé</tr>
@endforelse
</table><br>

<a href="{{route('user.index')}}"><button class="btn btn-warning">Voire les utilisateurs actifs</button></a>
@endsection