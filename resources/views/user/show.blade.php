@extends('index')

@section('content')
<div class="mini_conteneur">
    <img class="profil_photo" src="{{Storage::url($user->profil)}}" alt="">
    <table class="table table-striped info-user">
        <tr>
            <th>Email</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Nom</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>
            @if (Auth::user()->type_id > 2 && Auth::user()->id != $user->id)
                <form action="{{route('user.update',$user)}}" method="post">
                    @csrf
                    @method('PUT')
                    <select name="type" id="">
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" 
                        @if ($type->id == $user->type_id) selected @endif
                        >{{$type->intitule}}</option>
                    @endforeach
                    </select>
                    <input type="submit" value="Changer le grade" class="btn btn-primary">
                @else
                    <b>{{$user->type->intitule}}</b>
                @endif
                </form>
            </td>
        </tr>
        
    </table>
    <br>
    @if (Auth::user()->type_id > 2 && Auth::user()->id != $user->id)
    <form action="{{route('user.destroy', $user)}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Suspendre l'utilisateur" class="btn btn-warning">
    </form>
    @endif
</div>
@endsection