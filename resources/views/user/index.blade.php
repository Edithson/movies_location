@extends('index')

@section('content')
<ul>
@forelse ($users as $user)
    <li>{{$user->name}} du titre {{$user->type->intitule}} <a href="{{route('user.show', $user)}}"><button class="btn bnt-primary">Voire plus</button></a></li>
@empty
    <li>Aucun utilisateur trouvé</li>
@endforelse
</ul><br>
<a href="{{route('user.index-delete')}}"><button class="btn btn-warning">Voire les utilisateurs désactivés</button></a>
@endsection